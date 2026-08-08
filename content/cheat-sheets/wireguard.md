+++
title = "WireGuard"
date = "2025-02-14"
[taxonomies]
tags = ["linux", "ubuntu", "networking"]
+++

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

### Generate Key Pair

```bash
wg genkey > privatekey
```

```bash
wg pubkey < privatekey > publickey
```

```bash
wg genkey | tee privatekey | wg pubkey > publickey
```

### Generate Pre-shared Key

```bash
openssl rand 32 | base64
```
