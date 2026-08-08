# www.rosskelso.com

The content and configuration for [www.rosskelso.com](https://www.rosskelso.com),
a static site built with [Zola](https://www.getzola.org/) and the
[Apollo](https://github.com/not-matthias/apollo) theme.

```
config.toml     site config + Apollo menu/theme settings
content/         the markdown — sections (guides, cheat-sheets, blog) + pages (cv, downloads)
static/          static assets (e.g. downloadable files)
```

The theme is not vendored here; the NixOS host that serves this site supplies it
at build time. For local preview: `git submodule add https://github.com/not-matthias/apollo themes/apollo`
then `zola serve`.

The previous Grav (PHP CMS) install is archived on the `archive/full-install` branch.
