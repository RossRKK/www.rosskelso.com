+++
title = "Grav"
date = "2025-02-14"
[taxonomies]
tags = ["linux", "ubuntu", "networking"]
+++

# Grav

## Set Folder Permissions

```bash
sudo chgrp -R www-data .
find . -type f | sudo xargs chmod 664
find . /bin -type f | sudo xargs chmod 775
find . -type d | sudo xargs chmod 775
find . -type d | sudo xargs chmod +s
umask 0002
```
