#!/usr/bin/env bash
# deploy.sh — publish www.rosskelso.com.
#
# styx builds the site itself: features/website.nix in chaos.nix runs a
# `website-update` unit that clones this repo's main branch, builds it with
# zola and swaps the result in atomically. A timer runs that every 5 minutes,
# so pushing to main is already a deploy — this script just does the push and
# then kicks the unit so you don't wait for the tick.
#
#   ./deploy.sh          push main, trigger the build on styx, show the log
#   ./deploy.sh --status what's live right now, no push
set -euo pipefail
cd "$(dirname "$0")"

TARGET="${STYX:-root@styx.rosskelso.com}"
SSH=(ssh -o StrictHostKeyChecking=accept-new "$TARGET")

if [ "${1:-}" = "--status" ]; then
  "${SSH[@]}" 'cat /var/lib/website/deployed; systemctl status website-update --no-pager -n 20'
  exit
fi

branch=$(git rev-parse --abbrev-ref HEAD)
[ "$branch" = "main" ] || { echo "on branch '$branch' — styx deploys main"; exit 1; }

echo ">> pushing main"
git push origin main

echo ">> building on styx"
# --wait: exit status follows the build, so a broken commit fails here. The
# previous build stays live either way; the unit only moves the symlink on success.
"${SSH[@]}" 'systemctl start --wait website-update.service' \
  || { "${SSH[@]}" 'journalctl -u website-update -n 40 --no-pager'; exit 1; }
"${SSH[@]}" 'journalctl -u website-update -n 5 --no-pager -o cat'
