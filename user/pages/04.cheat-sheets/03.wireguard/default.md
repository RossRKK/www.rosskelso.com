---
title: 'WireGuard'
taxonomy:
    category:
        - cheatsheet
    tag:
        - linux
        - ubuntu
        - networking
---

# WireGuard

## Config Location

Typically
```
/etc/wireguard/wg0.conf
```

## Service

### Restart
```bash
sudo systemctl restart wg-quick@wg0
```

### Status
```bash
sudo systemctl status wg-quick@wg0
```

### Enable
```bash
sudo systemctl enable wg-quick@wg0
```
