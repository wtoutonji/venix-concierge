#!/usr/bin/env bash
set -u

if command -v pwsh >/dev/null 2>&1; then
  exec pwsh -NoProfile -File "$(dirname "$0")/validate.ps1"
fi

if command -v powershell.exe >/dev/null 2>&1; then
  exec powershell.exe -NoProfile -ExecutionPolicy Bypass -File "$(dirname "$0")/validate.ps1"
fi

printf '[SKIPPED] Generated project validation - PowerShell is unavailable; use scripts/validate.ps1 on the supported Windows workflow.\n'
exit 2
