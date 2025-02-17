---
title: 'Mac OS'
taxonomy:
    category:
        - cheatsheet
    tag:
        - macos
        - networking
---

# Mac OS

## Flush DNS

```bash
sudo dscacheutil -flushcache; sudo killall -HUP mDNSResponder
```