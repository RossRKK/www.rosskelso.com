+++
title = "IP Tables"
date = "2025-02-14"
[taxonomies]
tags = ["linux", "ubuntu", "networking"]
+++

# IP Tables

## DNAT

### Create a new DNAT rule
```bash
sudo iptables -t nat -A PREROUTING -i <source-interface> -p tcp --dport <external-port> -j DNAT --to-destination <local-ip>:<local-port>
```

### List DNAT Rules

```bash
sudo iptables -t nat -L PREROUTING --line-numbers
```

### Delete DNAT Rule by line number

```bash
sudo iptables -t nat -D PREROUTING <line-number>
```
