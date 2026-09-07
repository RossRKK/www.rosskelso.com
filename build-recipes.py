#!/usr/bin/env python3
"""Compile recipes/ into the recipe posts in content/blog/.

Recipe posts are written in the Recipe Grid description language
(https://mossblaser.github.io/recipe_grid/) rather than as hand-merged HTML
tables: the nesting of the steps is the shape of the table, and recipe-grid
works out the rowspans. A source file in recipes/ is Zola front matter, then
markdown, with the recipes themselves in ```recipe fenced blocks.

Only those blocks are compiled. recipe-grid renders a whole markdown document
if you let it, but its markdown is not Zola's: footnotes, shortcodes and
smart punctuation would all quietly stop working. So the rendered tables are
spliced back into the source markdown in place of their fences and everything
around them reaches Zola untouched.

The generated posts are gitignored — recipes/ is the source of truth. Run via
./dev.sh, which brings recipe-grid in from recipe-grid.nix.
"""

import re
import sys
from pathlib import Path

from recipe_grid.markdown import compile_markdown

ROOT = Path(__file__).parent
SOURCES = ROOT / "recipes"
OUTPUT = ROOT / "content" / "blog"

BANNER = "<!-- Generated from recipes/{name} by build-recipes.py — do not edit. -->"

# A recipe fence in the source. recipe-grid also treats plain indented code
# blocks as recipes, but a fence cannot be confused with the indented
# continuation lines of a footnote definition. ```new-recipe starts a fresh
# namespace, for a table that is an aside rather than part of the main flow.
FENCE = re.compile(r"^```(?:new-)?recipe\n.*?^```[ \t]*$", re.MULTILINE | re.DOTALL)

# One rendered recipe, as render() emits it. The block holds tables and
# nothing else, so it needs no nesting-aware match.
BLOCK = re.compile(r'<div class="rg-recipe-block">.*?</div>', re.DOTALL)


def split_front_matter(text: str, path: Path) -> tuple[str, str]:
    """Split a `+++ ... +++` TOML front matter block off the top of a file."""
    if not text.startswith("+++\n"):
        sys.exit(f"{path}: expected TOML front matter (+++) at the top of the file")
    end = text.find("\n+++\n", 3)
    if end == -1:
        sys.exit(f"{path}: front matter is never closed with +++")
    return text[: end + 5], text[end + 5 :]


def main() -> None:
    for source in sorted(SOURCES.glob("*.md")):
        front_matter, body = split_front_matter(
            source.read_text(encoding="utf-8"), source
        )
        # The post's <h1> comes from the front matter title via the Zola
        # template, so the recipe source carries no markdown title and
        # render() emits the tables alone.
        rendered = compile_markdown(body).render()
        tables = BLOCK.findall(rendered)
        fences = list(FENCE.finditer(body))
        if len(tables) != len(fences):
            sys.exit(
                f"{source}: {len(fences)} recipe blocks in the source but "
                f"{len(tables)} rendered — is a fence unclosed?"
            )

        # Splice each rendered table back over the fence it came from, leaving
        # the markdown around it for Zola.
        out, end = [], 0
        for fence, table in zip(fences, tables):
            out.append(body[end : fence.start()])
            out.append(table)
            end = fence.end()
        out.append(body[end:])

        post = f"{front_matter}\n{BANNER.format(name=source.name)}{''.join(out)}"
        (OUTPUT / source.name).write_text(post, encoding="utf-8")
        print(f"recipes/{source.name} -> content/blog/{source.name}")


if __name__ == "__main__":
    main()
