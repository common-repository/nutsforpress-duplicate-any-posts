<?php
 //if this file is called directly, abort.
if(!defined('ABSPATH')) die('please, do not call this page directly');

//DEACTIVATE

//plugin deactivate function
if(!function_exists('nfpdap_plugin_deactivate')){

	function nfpdap_plugin_deactivate() {
				
		require_once NFPDAP_BASE_PATH.'root/nfproot-saved-settings.php';
		nfproot_saved_settings();
		
		global $nfproot_plugins_settings;
		global $nfproot_plugins_settings_option_name;	

		if(!empty($nfproot_plugins_settings['nfpdap'])) {		
					
			//unset plugin root settings
			unset($nfproot_plugins_settings['nfpdap']);
						
		}

		//if, after cleaning nfpdap settings, root settings is empty, delete it (no more NutsForPress plugin is activated)
		if(empty($nfproot_plugins_settings)) {

			//delete root settings
			delete_option($nfproot_plugins_settings_option_name);			
			
		} else {
			
			//update root settings
			update_option($nfproot_plugins_settings_option_name, $nfproot_plugins_settings, false);
			
		}	
	
	}
		
}  else {
	
	error_log('NUTSFORPRESS ERROR: function "nfpdap_plugin_deactivate" already exists');
	
}