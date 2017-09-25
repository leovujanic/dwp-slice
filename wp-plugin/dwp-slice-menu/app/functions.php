<?php
/**
 * Created by PhpStorm.
 * User: leonardvujanic
 * Date: 25/09/2017
 * Time: 10:14
 */


/**
 * @return bool
 */
function dwpSliceMenuPluginInstall()
{
    return update_option(DWP_SLICE_MENU_OPTION_INSTALLED, 'true', true);
}

/**
 * @return bool
 */
function dwpSliceMenuPluginUninstall()
{
    return delete_option(DWP_SLICE_MENU_OPTION_INSTALLED);
}


/**
 * @return bool
 */
function dwpSliceMenuIsActive()
{
    return get_option(DWP_SLICE_MENU_OPTION_INSTALLED) === 'true';
}

/**
 * @param $toolbar \WP_Admin_Bar
 */
function dwpSliceMenuAddSliceToolbar($toolbar)
{
    $sliceUrl = null;
    $theme = wp_get_theme();
    
    $sliceIndexPath = $theme->get_template_directory() . '/slice/index.php';
    
    if (file_exists($sliceIndexPath) && is_readable($sliceIndexPath)) {
        $sliceUrl = get_home_url() . '/wp-content/themes/' . $theme->get_template() . '/slice/index.php';
    }
    
    if ($sliceUrl !== null) {
        $toolbar->add_menu([
            'id'    => 'dwp-slice-menu-item',
            'title' => 'DWP Slice',
            'href'  => $sliceUrl,
            'meta'  => [
                'title'  => __('DWP Slice'),
                'target' => 'blank',
            ],
        ]);
    }
}