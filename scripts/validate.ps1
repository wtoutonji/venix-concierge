$ErrorActionPreference = "Stop"
$Root = Split-Path -Parent $PSScriptRoot
$FailureCount = 0
$Project = $null
$PhpExecutable = $null
$PhpReason = ""

function Write-StageResult {
    param(
        [ValidateSet("PASS", "FAIL", "SKIPPED")][string] $Status,
        [string] $Stage,
        [string] $Detail
    )

    $Color = switch ($Status) {
        "PASS" { "Green" }
        "FAIL" { "Red" }
        default { "Yellow" }
    }
    Write-Host "[$Status] $Stage - $Detail" -ForegroundColor $Color
    if ($Status -eq "FAIL") {
        $script:FailureCount++
    }
}

function Get-EnvironmentValue {
    param([Parameter(Mandatory = $true)][string] $Name)

    $EnvironmentPath = Join-Path $Root "PROJECT-ENV.md"
    if (-not (Test-Path -LiteralPath $EnvironmentPath -PathType Leaf)) {
        return $null
    }

    $Prefix = "^" + [regex]::Escape($Name) + "=(.*)$"
    $Match = Get-Content -LiteralPath $EnvironmentPath | Where-Object { $_ -match $Prefix } | Select-Object -First 1
    if (-not $Match) {
        return $null
    }
    return ($Match -replace ("^" + [regex]::Escape($Name) + "="), "").Trim()
}

function Get-ProjectFiles {
    param([string[]] $Roots, [string] $Filter = "*")

    $Files = @()
    foreach ($RelativeRoot in $Roots) {
        $Path = Join-Path $Root $RelativeRoot
        if (Test-Path -LiteralPath $Path -PathType Container) {
            $Files += Get-ChildItem -LiteralPath $Path -Recurse -File -Filter $Filter
        }
    }
    return $Files
}

function Test-PathWithin {
    param([Parameter(Mandatory = $true)][string] $Path, [Parameter(Mandatory = $true)][string] $RootPath)

    $FullPath = [System.IO.Path]::GetFullPath($Path)
    $Prefix = [System.IO.Path]::GetFullPath($RootPath).TrimEnd([System.IO.Path]::DirectorySeparatorChar, [System.IO.Path]::AltDirectorySeparatorChar) + [System.IO.Path]::DirectorySeparatorChar
    return $FullPath.StartsWith($Prefix, [System.StringComparison]::OrdinalIgnoreCase)
}

function Get-CompletionReportField {
    param([Parameter(Mandatory = $true)][string] $Report, [Parameter(Mandatory = $true)][string] $Label)

    $ExpectedLabel = $Label.Trim().ToLowerInvariant()
    foreach ($RawLine in ($Report -split "`r?`n")) {
        $Line = $RawLine.Trim() -replace '\*\*', ''
        if ($Line.StartsWith('|')) {
            $Cells = @($Line.Trim('|').Split('|') | ForEach-Object { $_.Trim() })
            if ($Cells.Count -ge 2 -and $Cells[0].ToLowerInvariant() -eq $ExpectedLabel) { return $Cells[1] }
            continue
        }
        $Match = [regex]::Match($Line, '^(?:[-*]\s*)?(?<label>[^:]+):\s*(?<value>.+)$')
        if ($Match.Success -and $Match.Groups['label'].Value.Trim().ToLowerInvariant() -eq $ExpectedLabel) { return $Match.Groups['value'].Value.Trim() }
    }
    return $null
}

function Test-CompletionReportValue {
    param([AllowNull()][string] $Value, [Parameter(Mandatory = $true)][string[]] $Values)

    if ([string]::IsNullOrWhiteSpace($Value)) { return $false }
    $Normalized = ($Value -replace '\*\*', '').Trim().ToUpperInvariant()
    return $Values | Where-Object { $Normalized -match ('^' + [regex]::Escape($_) + '(?:\b|\s|—|-)') } | Select-Object -First 1
}

try {
    $ProjectPath = Join-Path $Root "project.json"
    $EnvironmentPath = Join-Path $Root "PROJECT-ENV.md"
    $EnvironmentProblems = @()

    if (-not (Test-Path -LiteralPath $ProjectPath -PathType Leaf)) {
        $EnvironmentProblems += "project.json is missing"
    } else {
        try {
            $Project = Get-Content -Raw -LiteralPath $ProjectPath | ConvertFrom-Json
        } catch {
            $EnvironmentProblems += "project.json is invalid: $($_.Exception.Message)"
        }
    }

    if (-not (Test-Path -LiteralPath $EnvironmentPath -PathType Leaf)) {
        $EnvironmentProblems += "PROJECT-ENV.md is missing"
    } else {
        foreach ($Name in @("PROJECT_NAME", "PROJECT_SLUG", "PROJECT_ROOT", "PHP_PATH", "WP_CLI_PATH", "WP_ROOT", "THEME_PATH", "PROJECT_CORE_PATH", "LOCAL_URL")) {
            $HasLine = Select-String -Quiet -LiteralPath $EnvironmentPath -Pattern ("^" + [regex]::Escape($Name) + "=")
            if (-not $HasLine) {
                $EnvironmentProblems += "$Name is missing"
            }
        }
    }

    $ConfiguredPhp = Get-EnvironmentValue -Name "PHP_PATH"
    if ($ConfiguredPhp -and (Test-Path -LiteralPath $ConfiguredPhp -PathType Leaf)) {
        $PhpExecutable = $ConfiguredPhp
        $PhpReason = "using configured PHP_PATH"
    } else {
        $SystemPhp = Get-Command php -ErrorAction SilentlyContinue
        if ($SystemPhp) {
            $PhpExecutable = $SystemPhp.Source
            $PhpReason = if ($ConfiguredPhp) { "configured PHP_PATH is unavailable; using system PHP" } else { "using system PHP" }
        } else {
            $PhpReason = if ($ConfiguredPhp) { "configured PHP_PATH is unavailable and system PHP was not found" } else { "PHP_PATH is empty and system PHP was not found" }
        }
    }

    if ($EnvironmentProblems.Count -gt 0) {
        Write-StageResult "FAIL" "Environment prerequisites" ($EnvironmentProblems -join "; ")
    } else {
        Write-StageResult "PASS" "Environment prerequisites" ("required configuration is present; " + $PhpReason)
    }

    $PhpFiles = Get-ProjectFiles -Roots @("theme", "project-core") -Filter "*.php"
    if (-not $PhpExecutable) {
        Write-StageResult "SKIPPED" "PHP syntax" $PhpReason
    } elseif ($PhpFiles.Count -eq 0) {
        Write-StageResult "FAIL" "PHP syntax" "no theme/project-core PHP files were found"
    } else {
        $PhpFailures = @()
        foreach ($File in $PhpFiles) {
            $Output = & $PhpExecutable -l $File.FullName 2>&1
            if (0 -ne $LASTEXITCODE) {
                $PhpFailures += "$($File.FullName): $($Output -join ' ')"
            }
        }
        if ($PhpFailures.Count -gt 0) {
            Write-StageResult "FAIL" "PHP syntax" ($PhpFailures -join "; ")
        } else {
            Write-StageResult "PASS" "PHP syntax" "$($PhpFiles.Count) theme/project-core files passed"
        }
    }

    $PhpcsBat = Join-Path $Root "vendor\bin\phpcs.bat"
    $PhpcsPhp = Join-Path $Root "vendor\bin\phpcs"
    if (-not $PhpExecutable) {
        Write-StageResult "SKIPPED" "PHPCS/WPCS" $PhpReason
    } elseif (Test-Path -LiteralPath $PhpcsBat -PathType Leaf) {
        $Output = & $PhpcsBat --standard=(Join-Path $Root "phpcs.xml.dist") 2>&1
        if (0 -eq $LASTEXITCODE) { Write-StageResult "PASS" "PHPCS/WPCS" "configured ruleset passed" } else { Write-StageResult "FAIL" "PHPCS/WPCS" ($Output -join " ") }
    } elseif (Test-Path -LiteralPath $PhpcsPhp -PathType Leaf) {
        $Output = & $PhpExecutable $PhpcsPhp --standard=(Join-Path $Root "phpcs.xml.dist") 2>&1
        if (0 -eq $LASTEXITCODE) { Write-StageResult "PASS" "PHPCS/WPCS" "configured ruleset passed" } else { Write-StageResult "FAIL" "PHPCS/WPCS" ($Output -join " ") }
    } else {
        Write-StageResult "SKIPPED" "PHPCS/WPCS" "Composer dependencies are not installed"
    }

    $JsonFiles = Get-ChildItem -LiteralPath $Root -Recurse -File -Filter *.json | Where-Object { $_.FullName -notmatch '[\\/](node_modules|vendor|\.git)[\\/]' }
    $JsonFailures = @()
    foreach ($File in $JsonFiles) {
        try { Get-Content -Raw -LiteralPath $File.FullName | ConvertFrom-Json | Out-Null } catch { $JsonFailures += "$($File.FullName): $($_.Exception.Message)" }
    }
    if ($JsonFailures.Count -gt 0) { Write-StageResult "FAIL" "JSON validity" ($JsonFailures -join "; ") } else { Write-StageResult "PASS" "JSON validity" "$($JsonFiles.Count) JSON files parsed" }

    $DesignSystemRoot = Join-Path $Root "handoff\design-system"
    $DesignSystemSignals = @(
        "styles.css",
        "COMPLETION-REPORT.md",
        "index.js",
        "tokens",
        "components",
        "preview",
        "ui_kits",
        "assets",
        "MIGRATION-MAP.md"
    ) | Where-Object { Test-Path -LiteralPath (Join-Path $DesignSystemRoot $_) }
    if ($DesignSystemSignals.Count -eq 0) {
        Write-StageResult "SKIPPED" "Design System handoff" "no approved Design System package installed"
    } else {
        $DesignSystemProblems = @()
        foreach ($RequiredPath in @("styles.css", "README.md", "COMPLETION-REPORT.md", "index.js", "tokens", "tokens\layout.css")) {
            if (-not (Test-Path -LiteralPath (Join-Path $DesignSystemRoot $RequiredPath))) { $DesignSystemProblems += "missing $RequiredPath" }
        }
        $CompletionReport = Join-Path $DesignSystemRoot "COMPLETION-REPORT.md"
        if (Test-Path -LiteralPath $CompletionReport -PathType Leaf) {
            $ReportText = Get-Content -Raw -LiteralPath $CompletionReport
            $Mode = Get-CompletionReportField -Report $ReportText -Label "Mode"
            $FinalResult = Get-CompletionReportField -Report $ReportText -Label "Final Result"
            $Intake = Get-CompletionReportField -Report $ReportText -Label "Teelya Agency Framework intake"
            if (Test-CompletionReportValue -Value $FinalResult -Values @("FAIL")) { $DesignSystemProblems += "COMPLETION-REPORT.md declares Final Result: FAIL" }
            if (Test-CompletionReportValue -Value $Intake -Values @("BLOCKED", "NOT READY")) { $DesignSystemProblems += "COMPLETION-REPORT.md declares Teelya Agency Framework intake BLOCKED or NOT READY" }
            if ((Test-CompletionReportValue -Value $Mode -Values @("REFACTOR")) -and -not (Test-Path -LiteralPath (Join-Path $DesignSystemRoot "MIGRATION-MAP.md") -PathType Leaf)) { $DesignSystemProblems += "Mode: REFACTOR requires MIGRATION-MAP.md" }
        }
        if ($DesignSystemProblems.Count -gt 0) { Write-StageResult "FAIL" "Design System handoff" ($DesignSystemProblems -join "; ") } else { Write-StageResult "PASS" "Design System handoff" "approved package has the required intake files and a ready completion report" }
    }

    $JavaScriptFiles = Get-ProjectFiles -Roots @("theme") -Filter "*.js"
    $Node = Get-Command node -ErrorAction SilentlyContinue
    if ($JavaScriptFiles.Count -eq 0) {
        Write-StageResult "SKIPPED" "JavaScript syntax" "no JavaScript files exist"
    } elseif (-not $Node) {
        Write-StageResult "SKIPPED" "JavaScript syntax" "Node.js is unavailable"
    } else {
        $JsFailures = @()
        foreach ($File in $JavaScriptFiles) {
            $Output = & $Node.Source --check $File.FullName 2>&1
            if (0 -ne $LASTEXITCODE) { $JsFailures += "$($File.FullName): $($Output -join ' ')" }
        }
        if ($JsFailures.Count -gt 0) { Write-StageResult "FAIL" "JavaScript syntax" ($JsFailures -join "; ") } else { Write-StageResult "PASS" "JavaScript syntax" "$($JavaScriptFiles.Count) files passed node --check" }
    }

    $ForbiddenFse = Get-ChildItem -LiteralPath (Join-Path $Root "theme") -Recurse -File -Filter *.html -ErrorAction SilentlyContinue | Where-Object { $_.FullName -match '[\\/](templates|parts)[\\/]' }
    if ($ForbiddenFse) { Write-StageResult "FAIL" "FSE boundary" (($ForbiddenFse | ForEach-Object FullName) -join "; ") } else { Write-StageResult "PASS" "FSE boundary" "no structural templates/*.html or parts/*.html files" }

    $DcBoundaryProblems = @()
    $DcFiles = Get-ChildItem -LiteralPath $Root -Recurse -File -Filter *.dc.html -ErrorAction SilentlyContinue | Where-Object { $_.FullName -notmatch '[\/](node_modules|vendor|\.git)[\/]' }
    $DcPagesRoot = [System.IO.Path]::GetFullPath((Join-Path $Root "handoff\pages")).TrimEnd([System.IO.Path]::DirectorySeparatorChar, [System.IO.Path]::AltDirectorySeparatorChar) + [System.IO.Path]::DirectorySeparatorChar
    foreach ($DcFile in $DcFiles) {
        $DcFull = [System.IO.Path]::GetFullPath($DcFile.FullName)
        if (-not $DcFull.StartsWith($DcPagesRoot, [System.StringComparison]::OrdinalIgnoreCase)) {
            $DcBoundaryProblems += "DC file outside handoff/pages: $($DcFile.FullName)"
        }
    }
    $RuntimeFiles = Get-ProjectFiles -Roots @("theme", "project-core", "store-core") | Where-Object { $_.Extension -in @(".php", ".js", ".css", ".html") }
    $DcRuntimeHits = $RuntimeFiles | Select-String -Pattern '<sc-(if|for)\b|<image-slot\b|style-(hover|focus)=|support\.js|image-slot\.js'
    if ($DcRuntimeHits) {
        $DcBoundaryProblems += "DC runtime/support constructs remain in production code"
    }
    if ($DcBoundaryProblems.Count -gt 0) { Write-StageResult "FAIL" "DC production boundary" ($DcBoundaryProblems -join "; ") } else { Write-StageResult "PASS" "DC production boundary" "DC files stay in handoff/pages and no DC runtime constructs ship in production code" }

    $JsxBoundaryProblems = @()
    $JsxFiles = Get-ChildItem -LiteralPath $Root -Recurse -File -Filter *.jsx -ErrorAction SilentlyContinue | Where-Object { $_.FullName -notmatch '[\\/](node_modules|vendor|\.git)[\\/]' }
    foreach ($JsxFile in $JsxFiles) {
        if (-not (Test-PathWithin -Path $JsxFile.FullName -RootPath $DesignSystemRoot)) { $JsxBoundaryProblems += "JSX is only allowed as Design System reference material: $($JsxFile.FullName)" }
    }
    if ($JsxBoundaryProblems.Count -gt 0) { Write-StageResult "FAIL" "JSX production boundary" ($JsxBoundaryProblems -join "; ") } else { Write-StageResult "PASS" "JSX production boundary" "no JSX appears outside handoff/design-system" }

    $DesignSystemRuntimeProblems = @()
    $RuntimeRoots = @("theme", "project-core", "store-core")
    $ForbiddenDesignSystemFiles = @("_ds_manifest.json", "_ds_bundle.js", "_adherence.oxlintrc.json", ".thumbnail", "COMPLETION-REPORT.md", "MIGRATION-MAP.md")
    foreach ($RuntimeRoot in $RuntimeRoots) {
        $RuntimeRootPath = Join-Path $Root $RuntimeRoot
        if (-not (Test-Path -LiteralPath $RuntimeRootPath -PathType Container)) { continue }
        Get-ChildItem -LiteralPath $RuntimeRootPath -Recurse -Force | ForEach-Object {
            $PathParts = $_.FullName.Substring($RuntimeRootPath.Length + 1) -split '[\\/]'
            if ($_.Extension -eq ".jsx" -or $_.Name -in $ForbiddenDesignSystemFiles -or $PathParts -contains "preview" -or $PathParts -contains "ui_kits") { $DesignSystemRuntimeProblems += $_.FullName }
        }
    }
    if ($DesignSystemRuntimeProblems.Count -gt 0) { Write-StageResult "FAIL" "Design System production boundary" (($DesignSystemRuntimeProblems | Sort-Object -Unique) -join "; ") } else { Write-StageResult "PASS" "Design System production boundary" "no Design System development artifacts exist in runtime roots" }

    $EmptyAssets = Get-ProjectFiles -Roots @("theme") | Where-Object { $_.Length -eq 0 -and $_.Extension -in @(".css", ".js") }
    if ($EmptyAssets) { Write-StageResult "FAIL" "Empty assets" (($EmptyAssets | ForEach-Object FullName) -join "; ") } else { Write-StageResult "PASS" "Empty assets" "no empty CSS or JavaScript assets" }

    $ScannableFiles = Get-ChildItem -LiteralPath $Root -Recurse -File | Where-Object { $_.FullName -notmatch '[\\/](\.git|node_modules|vendor)[\\/]' }
    $PlaceholderHits = $ScannableFiles | Select-String -Pattern '\{\{[A-Z0-9_]+\}\}'
    if ($PlaceholderHits) { Write-StageResult "FAIL" "Stale identity/placeholders" (($PlaceholderHits | ForEach-Object { "$($_.Path):$($_.LineNumber)" }) -join "; ") } else { Write-StageResult "PASS" "Stale identity/placeholders" "no unresolved template placeholders" }

    $IdentityProblems = @()
    if ($Project) {
        $Slug = [string] $Project.slug
        $ThemeStyle = Join-Path $Root ("theme\" + $Slug + "\style.css")
        if (-not (Test-Path -LiteralPath $ThemeStyle)) {
            $IdentityProblems += "theme style.css is missing"
        } else {
            $Style = Get-Content -Raw -LiteralPath $ThemeStyle
            if ($Style -notmatch ("(?m)^Theme Name:\s*" + [regex]::Escape([string] $Project.project_name) + "\s*$")) { $IdentityProblems += "Theme Name does not match project.json" }
            if ($Style -notmatch ("(?m)^Text Domain:\s*" + [regex]::Escape($Slug) + "\s*$")) { $IdentityProblems += "theme text domain does not match project.json" }
        }

        $RuntimePhp = Get-ProjectFiles -Roots @("theme", "project-core", "store-core") -Filter "*.php"
        $StaleRuntime = $RuntimePhp | Select-String -Pattern 'teelya_|["'']teelya["'']|Plugin Name:\s*(Project Core|Store Core)'
        if ($StaleRuntime) { $IdentityProblems += "stale runtime identity remains in generated PHP" }
    } else {
        $IdentityProblems += "project metadata was unavailable"
    }
    if ($IdentityProblems.Count -gt 0) { Write-StageResult "FAIL" "Theme/plugin metadata" ($IdentityProblems -join "; ") } else { Write-StageResult "PASS" "Theme/plugin metadata" "rendered client metadata and runtime identifiers match project.json" }

    $TrackedFiles = @()
    $Git = Get-Command git -ErrorAction SilentlyContinue
    if ($Git -and (Test-Path -LiteralPath (Join-Path $Root ".git"))) {
        $TrackedRelative = & $Git.Source -C $Root ls-files
        $TrackedFiles = $TrackedRelative | ForEach-Object { Join-Path $Root $_ } | Where-Object { Test-Path -LiteralPath $_ -PathType Leaf }
    } else {
        $TrackedFiles = $ScannableFiles | Where-Object { $_.Name -ne "PROJECT-ENV.md" } | ForEach-Object FullName
    }
    $SensitiveHits = $TrackedFiles | Select-String -Pattern '(?i)(password|secret|api[_-]?key)\s*[:=]\s*[^\s<]+|[A-Z]:\\Users\\[^<\r\n]+'
    if ($SensitiveHits) { Write-StageResult "FAIL" "Secrets/local paths" (($SensitiveHits | ForEach-Object { "$($_.Path):$($_.LineNumber)" }) -join "; ") } else { Write-StageResult "PASS" "Secrets/local paths" "no credential assignments or tracked user-profile paths detected" }

    $TypeProblems = @()
    if ($Project) {
        $IsWoo = $Project.project_type -eq "woocommerce"
        $StoreRootExists = Test-Path -LiteralPath (Join-Path $Root "store-core")
        $WooDocExists = Test-Path -LiteralPath (Join-Path $Root "docs\WOOCOMMERCE.md")
        if ($IsWoo -and (-not $StoreRootExists -or -not $WooDocExists)) { $TypeProblems += "WooCommerce project is missing store-core or WooCommerce documentation" }
        if (-not $IsWoo -and ($StoreRootExists -or $WooDocExists)) { $TypeProblems += "standard project contains active WooCommerce-only project resources" }

        if (-not $IsWoo) {
            foreach ($Path in @(".agents\skills\woocommerce-theme", ".claude\skills\woocommerce-theme", ".claude\agents\woocommerce-reviewer.md")) {
                if (Test-Path -LiteralPath (Join-Path $Root $Path)) { $TypeProblems += "standard project contains $Path" }
            }
        }
    }
    if ($TypeProblems.Count -gt 0) { Write-StageResult "FAIL" "Project-type consistency" ($TypeProblems -join "; ") } else { Write-StageResult "PASS" "Project-type consistency" "runtime, docs and assistant resources match project type" }

    if ($Project -and $Project.project_type -eq "woocommerce") {
        $StoreFiles = Get-ProjectFiles -Roots @("store-core") -Filter "*.php"
        if (-not $PhpExecutable) {
            Write-StageResult "SKIPPED" "Store Core validation" $PhpReason
        } else {
            $StoreFailures = @()
            foreach ($File in $StoreFiles) {
                $Output = & $PhpExecutable -l $File.FullName 2>&1
                if (0 -ne $LASTEXITCODE) { $StoreFailures += "$($File.FullName): $($Output -join ' ')" }
            }
            if ($StoreFailures.Count -gt 0) { Write-StageResult "FAIL" "Store Core validation" ($StoreFailures -join "; ") } else { Write-StageResult "PASS" "Store Core validation" "$($StoreFiles.Count) files passed PHP lint" }
        }
    } else {
        Write-StageResult "SKIPPED" "Store Core validation" "not applicable to a standard project"
    }

    if (-not $Git) {
        Write-StageResult "SKIPPED" "Git diff hygiene" "Git is unavailable"
    } elseif (-not (Test-Path -LiteralPath (Join-Path $Root ".git"))) {
        Write-StageResult "SKIPPED" "Git diff hygiene" "project is not initialized as a Git repository"
    } else {
        $Output = & $Git.Source -C $Root diff --check 2>&1
        if (0 -ne $LASTEXITCODE -or $Output) { Write-StageResult "FAIL" "Git diff hygiene" ($Output -join " ") } else { Write-StageResult "PASS" "Git diff hygiene" "git diff --check passed" }
    }
} catch {
    Write-StageResult "FAIL" "Validation runtime" $_.Exception.Message
}

if ($FailureCount -gt 0) {
    Write-Host "Validation completed with $FailureCount failed stage(s)." -ForegroundColor Red
    exit 1
}

Write-Host "Validation completed with no failed stages." -ForegroundColor Green
exit 0
