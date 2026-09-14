param(
    [string] $WpCliPath = ""
)

$ErrorActionPreference = "Stop"
$Root = Split-Path -Parent $PSScriptRoot
$EnvironmentPath = Join-Path $Root "PROJECT-ENV.md"

function Get-EnvironmentValue {
    param([Parameter(Mandatory = $true)][string] $Name)

    if (-not (Test-Path -LiteralPath $EnvironmentPath -PathType Leaf)) {
        throw "PROJECT-ENV.md is missing."
    }
    $Prefix = "^" + [regex]::Escape($Name) + "=(.*)$"
    $Match = Get-Content -LiteralPath $EnvironmentPath | Where-Object { $_ -match $Prefix } | Select-Object -First 1
    if (-not $Match) { throw "$Name is missing from PROJECT-ENV.md." }
    return ($Match -replace ("^" + [regex]::Escape($Name) + "="), "").Trim()
}

$WpRoot = Get-EnvironmentValue "WP_ROOT"
$LocalUrl = Get-EnvironmentValue "LOCAL_URL"
$ConfiguredPhp = Get-EnvironmentValue "PHP_PATH"
$ConfiguredWpCli = Get-EnvironmentValue "WP_CLI_PATH"

if (-not (Test-Path -LiteralPath $WpRoot -PathType Container)) {
    throw "WP_ROOT does not exist: $WpRoot"
}

$PhpExecutable = $null
if ($ConfiguredPhp -and (Test-Path -LiteralPath $ConfiguredPhp -PathType Leaf)) {
    $PhpExecutable = $ConfiguredPhp
} else {
    $SystemPhp = Get-Command php -ErrorAction SilentlyContinue
    if ($SystemPhp) { $PhpExecutable = $SystemPhp.Source }
}

$ResolvedWpCliPath = $null
if (-not [string]::IsNullOrWhiteSpace($WpCliPath)) {
    if (-not (Test-Path -LiteralPath $WpCliPath -PathType Leaf)) {
        throw "Explicit -WpCliPath does not exist or is not a file: $WpCliPath"
    }
    $ResolvedWpCliPath = $WpCliPath
} elseif (-not [string]::IsNullOrWhiteSpace($ConfiguredWpCli)) {
    if (-not (Test-Path -LiteralPath $ConfiguredWpCli -PathType Leaf)) {
        throw "WP_CLI_PATH from PROJECT-ENV.md does not exist or is not a file: $ConfiguredWpCli"
    }
    $ResolvedWpCliPath = $ConfiguredWpCli
} else {
    $WpCommand = Get-Command wp -ErrorAction SilentlyContinue
    if ($WpCommand) { $ResolvedWpCliPath = $WpCommand.Source }
}
if (-not $ResolvedWpCliPath) {
    throw "WP-CLI is unavailable. Pass -WpCliPath, set WP_CLI_PATH in PROJECT-ENV.md, or add wp to PATH."
}

Push-Location $WpRoot
try {
    if ([System.IO.Path]::GetExtension($ResolvedWpCliPath) -eq ".phar") {
        if (-not $PhpExecutable) { throw "PHP is required to execute the configured WP-CLI PHAR." }
        $SiteHome = & $PhpExecutable $ResolvedWpCliPath option get home 2>&1
    } else {
        $SiteHome = & $ResolvedWpCliPath option get home 2>&1
    }
    if (0 -ne $LASTEXITCODE) { throw "wp option get home failed: $($SiteHome -join ' ')" }
    $ResolvedHome = ($SiteHome | Select-Object -Last 1).ToString().Trim()
    if ($ResolvedHome -cne $LocalUrl) { throw "LocalWP target mismatch. Expected '$LocalUrl', received '$ResolvedHome'." }
    Write-Host "[PASS] LocalWP target verified exactly: $ResolvedHome" -ForegroundColor Green
} finally {
    Pop-Location
}
