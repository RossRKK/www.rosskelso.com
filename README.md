# www.rosskelso.com

The content and configuration for [www.rosskelso.com](https://www.rosskelso.com),
a static site built with [Zola](https://www.getzola.org/) and the
[Apollo](https://github.com/not-matthias/apollo) theme.

```
config.toml     site config + Apollo menu/theme settings
content/        the markdown — sections (guides, starfinder) + pages (cv, downloads)
static/         static assets (e.g. downloadable files)
dev.sh          local preview: materialises the generated bits, then runs zola
```

## Local preview

```sh
./dev.sh          # serve on http://127.0.0.1:1111 with live reload
./dev.sh build    # one-off build into public/
```

`dev.sh` shells out to `nix shell`, so nothing needs to be installed first.

The repo holds only content and config. Two things the site needs are
generated rather than committed, and are gitignored:

- `themes/apollo` — cloned at a pinned commit.
- `static/fonts/*.woff2` — 0xProto, compressed from the nixpkgs font package.
  `static/custom.css` declares the `@font-face` rules that point at them.

`dev.sh` produces both exactly the way `modules/features/website.nix` in
[chaos.nix](https://github.com/RossRKK/chaos.nix) does at deploy time, so a
local build matches what the NixOS host serves.

### Keeping the theme pin in sync

`APOLLO_REV` at the top of `dev.sh` and the `apollo` flake input in chaos.nix
should name the same commit; bump them together. Note that upstream Apollo past
`d452869` ("upgrade to zola 0.23") needs Zola 0.23, which nixpkgs doesn't
package yet — hence the pin to `5d3ffce`. Override for a one-off with
`APOLLO_REV=<sha> ./dev.sh`.

The previous Grav (PHP CMS) install is archived on the `archive/full-install` branch.
