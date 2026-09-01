+++
title = "Drafts"
sort_by = "date"
template = "section.html"
page_template = "page.html"
in_search_index = false

# Unlisted, not private. Everything under /drafts/ is built and served, but
# kept out of the sitemap, the atom feed, the search index, robots.txt and the
# homepage listing, so it is only reachable by someone who has the URL.
#
# Every page in here must carry `in_search_index = false` in its own front
# matter — Zola has no way to set that for a whole section. Copy the shape of
# an existing draft rather than writing the front matter from scratch, and
# leave `[taxonomies]` off so the post stays out of /tags.
#
# To publish: move the file to content/blog/, drop `in_search_index`, add tags,
# set the date to the publication date.
+++
