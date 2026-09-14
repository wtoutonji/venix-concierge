# LocalWP Development

The repository is the source project and LocalWP runs WordPress. Keep
machine-specific values in ignored `PROJECT-ENV.md`; commit only the rendered
`PROJECT-ENV.example.md` guidance.

Required fields include `PROJECT_ROOT`, `PHP_PATH`, `WP_CLI_PATH`, `WP_ROOT`, `THEME_PATH`,
`PROJECT_CORE_PATH`, and `LOCAL_URL`. WooCommerce projects also include
`STORE_CORE_PATH`.

Connect the generated theme and plugins to the matching LocalWP `wp-content`
directories using reviewed junctions/symlinks or another explicit local
workflow. Junction creation remains manual so the target paths are visible.

## PHP resolution

Validation uses a valid configured `PHP_PATH` first, then system PHP. If
neither exists, PHP-dependent stages report `SKIPPED` with the prerequisite
reason.

## WP-CLI resolution

`scripts/verify-localwp.ps1` resolves WP-CLI in this order: explicit
`-WpCliPath`, `WP_CLI_PATH` from `PROJECT-ENV.md`, then `wp` from `PATH`. It
reports a clear error when none is available. Use an unquoted `KEY=value` line;
Windows paths containing spaces are preserved as one executable path.

## WP-CLI safety

Before mutation:

1. Read `PROJECT-ENV.md`.
2. Use its `WP_ROOT`.
3. Run `wp option get home`.
4. Verify the result exactly equals `LOCAL_URL`.
5. Only then mutate.

Run `scripts/verify-localwp.ps1` for the smallest automated verification.
Never run destructive database/site commands without an explicit request.
