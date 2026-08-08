+++
title = "Apache 2"
date = "2025-02-14"
[taxonomies]
tags = ["linux", "ubuntu", "networking"]
+++

# Apache 2

## Config Location

```
/etc/apache2/
```

## Sites

```
/etc/apache2/sites-enabled/
```

```bash
sudo a2ensite <site-name>
```

```bash
sudo a2dissite <site-name>
```

## Modules

```bash
sudo a2enmod <site-name>
```

```bash
sudo a2dismod <site-name>
```

## Test Configuration

```bash
sudo apachectl configtest
```

## Reload Config

```bash
sudo apachectl -k graceful
```

```bash
sudo service apache2 reload
```

## Certbot

### Install

```bash
sudo apt install certbot python3-certbot-apache
```

### Run

```bash
sudo certbot --apache
```
