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

## WP-CLI without a mysqli-enabled php.ini

Local's bundled CLI PHP can be started without a `php.ini`, so `mysqli` is not
loaded and WP-CLI fails with a database extension error even while the site
runs in Local. Do not change Local's own files. Instead use a scratch `php.ini`
kept **outside the repository** (for example in a temporary directory) that:

- sets `extension_dir` to the `ext` folder of the PHP build named by `PHP_PATH`;
- enables `mysqli` (plus `mbstring`, `openssl`, `curl`, `gd`, `fileinfo` and
  `exif` for media work);
- points `mysqli.default_host` / `mysqli.default_port` at the site's MySQL
  listener when `DB_HOST` is `localhost`. Read the port from the site's Local
  configuration or the running `mysqld` process; do not commit it.

Then call PHP directly with that file and the WP-CLI phar shipped with Local,
from `WP_ROOT`:

```powershell
& $PhpPath -c <scratch-php.ini> <path-to-wp-cli.phar> option get home
```

Complete the normal WP-CLI safety check first: the returned `home` value must
exactly equal `LOCAL_URL` before any mutation. For multi-line logic prefer
`wp eval-file <script.php>` with the script in a temporary directory over
inline `wp eval`, which is fragile through PowerShell quoting. The scratch
`php.ini`, ports, usernames and passwords are machine-specific: never commit
them or copy them into `PROJECT-ENV.md`.

Run `scripts/verify-localwp.ps1` for the smallest automated verification.
Never run destructive database/site commands without an explicit request.
