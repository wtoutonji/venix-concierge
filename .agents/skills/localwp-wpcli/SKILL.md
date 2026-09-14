# LocalWP and WP-CLI

Read `PROJECT-ENV.md` if present.

Use configured `PHP_PATH` first, then system PHP. Report a clear prerequisite
skip/failure if neither is available.

Before mutation:
1. cd to WP_ROOT
2. `wp option get home`
3. compare with LOCAL_URL
4. only then mutate

Never run destructive WP-CLI database/site commands unless explicitly requested.
