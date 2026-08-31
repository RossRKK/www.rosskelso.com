#!/usr/bin/env bash
# Local preview for www.rosskelso.com.
#
# The repo is only content + config: the Apollo theme and the 0xProto webfonts
# are generated, not committed (see .gitignore). features/website.nix on the
# NixOS host materialises both at build time; this script does the same thing
# locally so `zola serve` sees the tree the deployment builds from.
#
#   ./dev.sh          set up themes/ + static/fonts/, then `zola serve`
#   ./dev.sh build    set up, then `zola build` into public/
#
# Everything runs through `nix shell`, so no tools need to be installed.
set -euo pipefail
cd "$(dirname "$0")"

# Apollo commit to check out. Upstream past d452869 requires zola 0.23, which
# nixpkgs doesn't have yet; 5d3ffce is the last commit that builds with 0.22.
# Bump this together with the `apollo` input in chaos.nix's flake.lock.
APOLLO_REV="${APOLLO_REV:-5d3ffce}"

nix shell nixpkgs#git nixpkgs#zola nixpkgs#woff2 --command bash -euo pipefail -c '
  rev="$1"; cmd="$2"

  if [ ! -d themes/apollo/.git ]; then
    git clone https://github.com/not-matthias/apollo themes/apollo
  fi
  git -C themes/apollo fetch -q origin
  git -C themes/apollo checkout -q "$rev"

  # 0xProto webfonts, built from the nixpkgs font rather than committed as
  # binaries — static/custom.css points its @font-face at these. Mirrors the
  # woff2_compress step in features/website.nix.
  mkdir -p static/fonts
  font=$(nix build --no-link --print-out-paths nixpkgs#_0xproto)
  for w in Regular Bold Italic; do
    [ -f "static/fonts/0xProto-$w.woff2" ] && continue
    cp "$font/share/fonts/truetype/0xProto-$w.ttf" static/fonts/
    woff2_compress "static/fonts/0xProto-$w.ttf"
    rm "static/fonts/0xProto-$w.ttf"
  done

  zola "$cmd"
' -- "$APOLLO_REV" "${1:-serve}"
