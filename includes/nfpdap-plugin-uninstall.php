<?php
 //if this file is called directly, abort.
if(!defined('ABSPATH')) die('please, do not call this page directly');

//UNINSTALL

//plugin uninstall function
if(!function_exists('nfpdap_plugin_uninstall')){

	function nfpdap_plugin_uninstall() {
		
		require_once NFPDAP_BASE_PATH.'root/nfproot-saved-settings.php';
		nfproot_saved_settings();
				
		global $nfproot_root_settings;
		global $nfproot_root_settings_name;
		
		if(!empty($nfproot_root_settings['nfpdap'])) {
			
			//unset plugin installaton
			unset($nfproot_root_settings['nfpdap']);
			
		}

		//if, after cleaning nfpdap settings, base settings is empty, delete it (no more NutsForPress plugins are installed)
		if(empty($nfproot_root_settings)) {

			//delete base settings
			delete_option($nfproot_root_settings_name);			
			
		} else {
			
			//update base settings
			update_option($nfproot_root_settings_name, $nfproot_root_settings, false);
			
		}

		//get all WPML active languages
		$nfpdap_get_wpml_active_languages = apply_filters('wpml_active_languages', false);

		//if WPML has active languages
		if(!empty($nfpdap_get_wpml_active_languages)) {
		  
			//loop into languages
			foreach($nfpdap_get_wpml_active_languages as $nfpdap_wpml_language) {

				$nfpdap_wpml_language_code = $nfpdap_wpml_language['language_code'];

				$nfproot_current_language_settings_name = '_nfproot_settings_'.$nfpdap_wpml_language_code;
				$nfproot_current_language_settings = get_option($nfproot_current_language_settings_name, false);
				
				if(!empty($nfproot_current_language_settings['nfpdap'])) {
					
					//unset plugin installaton
					unset($nfproot_current_language_settings['nfpdap']);
					
				}	
				
				//if, after cleaning nfpdap settings, language settings is empty, delete it (no more NutsForPress plugins are installed)
				if(empty($nfproot_current_language_settings)) {

					//delete language settings
					delete_option($nfproot_current_language_settings_name);			
					
				} else {
					
					//update language settings
					update_option($nfproot_current_language_settings_name, $nfproot_current_language_settings, false);
					
				}
								
			}
			
		}	
		
		//delete settings from the old plugin structure
		delete_option('_nfp_root_settings');
		delete_option('_nfp_settings');

	}
		
}  else {
	
	error_log('NUTSFORPRESS ERROR: function "nfpdap_plugin_uninstall" already exists');
	
}