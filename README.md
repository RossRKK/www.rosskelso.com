# www.rosskelso.com

The content and configuration for [www.rosskelso.com](https://www.rosskelso.com),
a static site built with [Zola](https://www.getzola.org/) and the
[Apollo](https://github.com/not-matthias/apollo) theme.

```
config.toml       site config + Apollo menu/theme settings
content/          the markdown — the blog section + pages (cv, downloads)
recipes/          recipe sources, compiled into content/blog/ at build time
templates/        site-level template overrides (homepage)
static/           static assets (e.g. downloadable files)
build-recipes.py  compiles recipes/ into the recipe posts in content/blog/
recipe-grid.nix   the recipe-grid compiler, built from its PyPI sdists
dev.sh            local preview: materialises the generated bits, runs zola
```

## Recipes

Posts tagged `recipes` are written as
[recipe tables](https://recipetables.com/) — the merge-table layout from
Cooking for Engineers. Ingredients are rows, ordered by first use; each step is
a column whose cell spans exactly the rows it acts on, so separate components
stay apart until the column where they join and the last cell spans everything.
The shape of the merges is the shape of the recipe.

The tables are not written by hand. A recipe lives in `recipes/<slug>.md` as
Zola front matter followed by the
[Recipe Grid](https://mossblaser.github.io/recipe_grid/tutorial.html)
description language, where the recipe is a tree of steps and their inputs:

```
"Fry a small ladleful at a time in a frying pan"(
    "Mix together in a large mixing bowl"(
        1 egg,
        100g "plain flour",
        300ml milk,
    ),
    "butter, for frying",
)
```

The nesting *is* the table: `build-recipes.py` hands the block to recipe-grid,
which works out the columns and row spans and writes the HTML into
`content/blog/<slug>.md`. Those generated posts are gitignored — the file in
`recipes/` is the source of truth, and **a new recipe needs its generated post
adding to `.gitignore`** or it gets committed alongside its source.

A few things worth knowing when writing one:

- The recipe goes in a ```` ```recipe ```` fenced block. Everything outside the
  fences is ordinary markdown and is passed straight through to Zola, so
  footnotes, links and shortcodes all work as they do in any other post — only
  the fenced blocks are compiled. (recipe-grid will also read a plain indented
  code block as a recipe, which is why the fences are worth the noise: an
  indented block is indistinguishable from a footnote's continuation lines.)
- Give no `#` heading: the title comes from the front matter, via the theme.
- A step name containing a comma, a bracket or an apostrophe has to be quoted,
  and so does an ingredient whose name has a comma in it —
  `1 "large onion, chopped finely"`. Unquoted, the comma reads as an argument
  separator and the preparation lands on its own row.
- Leave the quantity outside the quotes (`100g "plain flour"`) so recipe-grid
  recognises the unit and offers the conversions on hover. A quantity it
  cannot parse — a range like `4–5 cloves` — goes inside the quotes and is
  shown verbatim.
- Keep the step names to a word or two — `peel`, `skim`, `dry fry 3–4 min a
  side` — and split a compound instruction into a column each rather than
  writing a sentence in a cell. Passive waits (`cool`, `rest`) and steps the
  merge already implies are better left out entirely. Anything the cell can't
  carry goes in the notes.
- A recipe with enough steps makes a table too wide for the column. Split it
  into named stages rather than letting it scroll: end a block with
  `dough := "mix in"(...)`, then an HTML comment between the fences, then start
  the next block from `dough`. That renders as two stacked tables — the first captioned
  `dough`, the second opening with a `dough` cell linking back to it — and the
  name gives the intermediate the recipe never bothered to name out loud. The
  comment is load-bearing and invisible: with nothing between them the two
  blocks merge back into one wide table, because recipe-grid inlines a
  sub-recipe that is only used once.
- A table that is an aside rather than part of the recipe — the chilli's dried
  beans, say — goes in a ```` ```new-recipe ```` fence instead. That starts a
  fresh namespace, so its names cannot collide with the main recipe's and it
  will not try to merge into it.
- Under the tables, a `**Method**` list carries the instructions in full
  sentences. The table is the shape of the recipe and the method is the prose
  of it; the cells stay terse because the method says the rest. The method text
  is the original prose from before these were tables — worth keeping verbatim
  rather than re-editing it to match the cells.

Anything that will not compress into a cell — a variation, a warning, an
ingredient substitution — goes in a `**Notes**` list under the table.

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
- `content/blog/<recipe>.md` — compiled from `recipes/` by `build-recipes.py`.
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

`features/website.nix` has to run `build-recipes.py` before `zola build`, with
`recipe-grid.nix` on its path, exactly as `dev.sh` does — otherwise the recipe
posts simply are not there, since they are not committed.

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
