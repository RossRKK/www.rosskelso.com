+++
title = "Mac OS"
date = "2025-02-14"
[taxonomies]
tags = ["macos", "networking"]
+++

# Mac OS

## Flush DNS

```bash
sudo dscacheutil -flushcache; sudo killall -HUP mDNSResponder
```
