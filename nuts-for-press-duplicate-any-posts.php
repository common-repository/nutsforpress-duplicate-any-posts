<?php
/*
Plugin Name: 	NutsForPress Duplicate Any Posts
Plugin URI:		https://www.nutsforpress.com/
Description: 	NutsForPress Duplicate Any Posts is the perfect solution for duplicating post, the ones created with Elementor too. 
Version:     	1.2
Author:			Christian Gatti
Author URI:		https://profiles.wordpress.org/christian-gatti/
License:		GPL-2.0+
License URI:	http://www.gnu.org/licenses/gpl-2.0.txt
Text Domain:	nutsforpress-duplicate-any-posts
*/

//if this file is called directly, die.
if(!defined('ABSPATH')) die('please, do not call this page directly');


//DEFINITIONS

if(!defined('NFPROOT_BASE_RELATIVE')) {define('NFPROOT_BASE_RELATIVE', dirname(plugin_basename( __FILE__ )).'/root');}
define('NFPDAP_BASE_PATH', plugin_dir_path( __FILE__ ));
define('NFPDAP_BASE_URL', plugins_url().'/'.plugin_basename( __DIR__ ).'/');
define('NFPDAP_BASE_RELATIVE', dirname( plugin_basename( __FILE__ )));
define('NFPDAP_DEBUG', false);


//NUTSFORPRESS ROOT CONTENT
		
//add NutsForPress parent menu page
require_once NFPDAP_BASE_PATH.'root/nfproot-settings.php';
add_action('admin_menu', 'nfproot_settings');

//add NutsForPress save settings function and make it available through ajax
require_once NFPDAP_BASE_PATH.'root/nfproot-save-settings.php';
add_action('wp_ajax_nfproot_save_settings', 'nfproot_save_settings');

//add NutsForPress saved settings and make them available through the global varibales $nfproot_current_language_settings and $nfproot_options_name
require_once NFPDAP_BASE_PATH.'root/nfproot-saved-settings.php';
add_action('plugins_loaded', 'nfproot_saved_settings');

//register NutsForPress styles and scripts
require_once NFPDAP_BASE_PATH.'root/nfproot-styles-and-scripts.php';
add_action('admin_enqueue_scripts', 'nfproot_styles_and_scripts');
	
//add NutsForPress settings structure that contains nfproot_options_structure function invoked by plugin settings
require_once NFPDAP_BASE_PATH.'root/nfproot-settings-structure.php';


//PLUGIN INCLUDES

//add activate actions
require_once NFPDAP_BASE_PATH.'includes/nfpdap-plugin-activate.php';
register_activation_hook(__FILE__, 'nfpdap_plugin_activate');

//add deactivate actions
require_once NFPDAP_BASE_PATH.'includes/nfpdap-plugin-deactivate.php';
register_deactivation_hook(__FILE__, 'nfpdap_plugin_deactivate');

//add uninstall actions
require_once NFPDAP_BASE_PATH.'includes/nfpdap-plugin-uninstall.php';
register_uninstall_hook(__FILE__, 'nfpdap_plugin_uninstall');


//PLUGIN SETTINGS

//add plugin settings
require_once NFPDAP_BASE_PATH.'admin/nfpdap-settings.php';
add_action('admin_menu', 'nfpdap_settings');


//ADMIN INCLUDES CONDITIONALLY

//load duplicate function into backend
require_once NFPDAP_BASE_PATH.'admin/includes/nfpdap-add-duplication-link.php';
add_filter('post_row_actions', 'nfpdap_add_duplication_link', 10, 2);
add_filter('page_row_actions', 'nfpdap_add_duplication_link', 10, 2);

//load duplicate function into backend
require_once NFPDAP_BASE_PATH.'admin/includes/nfpdap-duplication.php';
add_action('admin_init', 'nfpdap_duplication');