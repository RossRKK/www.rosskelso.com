#!/usr/bin/env bash
# Local preview for www.rosskelso.com.
#
# The repo is only content + config: the Apollo theme and the 0xProto webfonts
# are generated, not committed (see .gitignore). The website-update unit on
# styx (features/website.nix) materialises both before building; this script
# does the same thing locally so `zola serve` sees the tree styx builds from.
#
#   ./dev.sh          set up themes/ + static/fonts/, then `zola serve --drafts`
#   ./dev.sh build    set up, then `zola build` into public/
#
# Everything runs through `nix shell`, so no tools need to be installed.
set -euo pipefail
cd "$(dirname "$0")"

# The package set styx builds with: chaos.nix pins nixpkgs to nixos-26.05, so
# that is where `zola` (0.22.1), woff2 and the 0xProto font come from here too.
# Pinned rather than following the local flake registry because zola 0.23
# replaced Tera with an incompatible template engine — an unpinned nixpkgs
# eventually hands you 0.23, which cannot parse these templates, and the
# failure looks like the site being broken rather than the toolchain moving.
# Bump this together with the `nixpkgs` input in chaos.nix's flake.nix.
NIXPKGS="${NIXPKGS:-github:nixos/nixpkgs/nixos-26.05}"

# Apollo commit to check out. Upstream past d452869 ("upgrade to zola 0.23")
# uses template syntax zola 0.22 cannot parse; 5d3ffce is the last commit that
# builds with 0.22. Bump this together with the `apollo` input in chaos.nix's
# flake.nix — and only alongside a zola that can parse the newer theme.
APOLLO_REV="${APOLLO_REV:-5d3ffce}"

nix shell "$NIXPKGS#git" "$NIXPKGS#zola" "$NIXPKGS#woff2" --command bash -euo pipefail -c '
  rev="$1"; cmd="$2"; nixpkgs="$3"

  if [ ! -d themes/apollo/.git ]; then
    git clone https://github.com/not-matthias/apollo themes/apollo
  fi
  git -C themes/apollo fetch -q origin
  git -C themes/apollo checkout -q "$rev"

  # 0xProto webfonts, built from the nixpkgs font rather than committed as
  # binaries — static/custom.css points its @font-face at these. Mirrors the
  # woff2_compress step in features/website.nix.
  mkdir -p static/fonts
  font=$(nix build --no-link --print-out-paths "$nixpkgs#_0xproto")
  for w in Regular Bold Italic; do
    [ -f "static/fonts/0xProto-$w.woff2" ] && continue
    cp "$font/share/fonts/truetype/0xProto-$w.ttf" static/fonts/
    woff2_compress "static/fonts/0xProto-$w.ttf"
    rm "static/fonts/0xProto-$w.ttf"
  done

  # Posts marked draft = true are never built for the live site; serve them
  # locally so a work in progress is previewable.
  if [ "$cmd" = serve ]; then
    zola serve --drafts
  else
    zola "$cmd"
  fi
' -- "$APOLLO_REV" "${1:-serve}" "$NIXPKGS"
