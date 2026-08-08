+++
title = "AI Acceleration"
date = "2025-02-14"
[taxonomies]
tags = ["windows", "ai"]
+++

# AI Acceleration

## NVidia Tesla T4 GPU

Install the latest nvidia drivers ('game ready' will work).

Switch the T4s into MCDM mode to get them working in WSL and showing in task manager.


From an administrator terminal:
```powershell
nvidia-smi -dm 2
```

To switch them back to TCC mode (untested, not sure why I'd do this):
```powershell
nvidia-smi -dm TCC
```
