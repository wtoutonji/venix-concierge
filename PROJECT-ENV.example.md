# Client LocalWP Environment

PROJECT_NAME=Venix Concierge
PROJECT_SLUG=venix-concierge
PROJECT_TYPE=standard

PROJECT_ROOT=<CONFIGURE_PROJECT_ROOT>
PHP_PATH=<CONFIGURE_PHP_PATH_OR_LEAVE_EMPTY>
WP_CLI_PATH=<CONFIGURE_WP_CLI_PATH_OR_LEAVE_EMPTY>
WP_ROOT=<CONFIGURE_WP_ROOT>
LOCAL_URL=http://venix-concierge.local

THEME_PATH=<CONFIGURE_WP_ROOT>\wp-content\themes\venix-concierge
PROJECT_CORE_PATH=<CONFIGURE_WP_ROOT>\wp-content\plugins\venix-concierge-core


ENVIRONMENT=development

Before any WP-CLI mutation:

1. Read this environment file.
2. Change to `WP_ROOT`.
3. Run `wp option get home`.
4. Verify the returned URL exactly equals `LOCAL_URL`.
5. Only then perform the mutation.
