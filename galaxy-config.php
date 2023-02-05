<?php

// Your paths might be different.
// This example works with the Pro plugin.
$typerocket = __DIR__ . '/wp-content/mu-plugins/vendor/typerocket';
$overrides = __DIR__ . '/wp-content/mu-plugins/vendor/typerocket';

define('TYPEROCKET_GALAXY_PATH', $typerocket);
define('TYPEROCKET_CORE_CONFIG_PATH', $overrides . '/config' );
define('TYPEROCKET_ROOT_WP', __DIR__);

define('TYPEROCKET_APP_ROOT_PATH', $overrides);
define('TYPEROCKET_ALT_PATH', $overrides);

// Here we include the app folder
define('TYPEROCKET_AUTOLOAD_APP', [
    'prefix' => 'App',
    'folder' => $overrides . '/app',
]);