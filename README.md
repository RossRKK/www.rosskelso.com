# www.rosskelso.com — content

The **content** of www.rosskelso.com: Grav flat-file pages, and nothing else.

The Grav framework (core, `vendor/`, plugins, the stock `quark` theme) is
provided by the NixOS host that serves this site, not committed here. Site
configuration lives in the host's Grav module; secrets (admin account, security
salt) live in the host's secrets store. This repo is *only* the pages.

```
pages/            Grav user/pages tree — the site content
```

The previous full-install layout (framework + config + everything committed) is
archived on the `archive/full-install` branch.
