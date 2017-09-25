<?php
/*
Plugin Name: DWP Slice Menu
Plugin URI: https://plugin.uri
Description: DWP Slice Menu - helper plugin for Wordpress
Version: 1.0.1
Author: Leo Vujanić
Author URI: http://www.degordian.com/
License: GPLv3
Copyright: Degordian (http://www.degordian.com/)
*/


define('DWP_SLICE_MENU_ROOT', __DIR__);
define('DWP_SLICE_MENU_DIRSLUG', basename(__DIR__));
define('DWP_SLICE_MENU_VERSION', '1.0.1');

define('DWP_SLICE_MENU_OPTION_INSTALLED', 'dwp_slice_plugin_active');


require_once DWP_SLICE_MENU_ROOT . '/app/functions.php';


if (is_admin()) {
    register_activation_hook(__FILE__, 'dwpSliceMenuPluginInstall');
    
    register_deactivation_hook(__FILE__, 'dwpSliceMenuPluginUninstall');
} else {
    if (dwpSliceMenuIsActive()) {
        add_action('admin_bar_menu', 'dwpSliceMenuAddSliceToolbar', 100);
    }
}

