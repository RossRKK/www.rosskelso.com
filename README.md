# www.rosskelso.com

The content and configuration for [www.rosskelso.com](https://www.rosskelso.com),
a static site built with [Zola](https://www.getzola.org/) and the
[Apollo](https://github.com/not-matthias/apollo) theme.

```
config.toml     site config + Apollo menu/theme settings
content/        the markdown — the blog section + pages (cv, downloads)
templates/      site-level template overrides (homepage)
static/         static assets (e.g. downloadable files)
dev.sh          local preview: materialises the generated bits, then runs zola
```

## Drafts

An unfinished post lives in `content/blog/` like any other, with
`draft = true` in its front matter. Zola skips draft pages entirely: they are
not built, so they cannot appear in the homepage listing, `/tags`,
`sitemap.xml`, `atom.xml` or the search index, and there is no URL to leak.

`./dev.sh` serves drafts locally (it passes `--drafts` to `zola serve`), so a
draft is visible while writing and nowhere else. To publish, delete the
`draft = true` line and set the date to the publication date.

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
[chaos.nix](https://github.com/RossRKK/chaos.nix) does on styx, so a local
build matches what the host serves.

### Keeping the theme pin in sync

`APOLLO_REV` at the top of `dev.sh` and the `apollo` flake input in chaos.nix
should name the same commit; bump them together. Note that upstream Apollo past
`d452869` ("upgrade to zola 0.23") needs Zola 0.23, which nixpkgs doesn't
package yet — hence the pin to `5d3ffce`. Override for a one-off with
`APOLLO_REV=<sha> ./dev.sh`.

## Deploying

Push to `main`. styx builds the site itself: `features/website.nix` in
[chaos.nix](https://github.com/RossRKK/chaos.nix) defines a `website-update`
unit that clones this repo, runs `zola build`, and swaps the result in
atomically; a timer runs it every five minutes.

```sh
./deploy.sh           # push main, then trigger the build on styx and tail it
./deploy.sh --status  # what's live right now
```

Nothing here is in the NixOS closure any more, so no `nix flake update` and no
`nixos-rebuild` — a typo fix is a push. What *is* still pinned in chaos.nix is
what the site is built *with*: zola, the apollo theme and the 0xProto font.
Bumping those needs a normal `scripts/deploy-styx.sh`; the updater notices the
new build inputs and rebuilds the site on its next run without a content push.

A failed build leaves the previous one serving — the symlink nginx follows only
moves after zola exits 0. `./deploy.sh` surfaces the failure, and the state
lives in `/var/lib/website` on styx (`src/` the checkout, `a/` and `b/` the two
build slots, `current` the symlink).

The previous Grav (PHP CMS) install is archived on the `archive/full-install` branch.
