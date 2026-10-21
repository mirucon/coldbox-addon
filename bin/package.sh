#!/usr/bin/env bash
set -euo pipefail
mkdir -p dist/inc
cp inc/*.php inc/amp-style.css dist/inc/
cp coldbox-addon.php readme.txt dist/
if [ -d languages ]; then cp -R languages dist/; fi
