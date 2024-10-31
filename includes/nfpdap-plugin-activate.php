<?php
 //if this file is called directly, abort.
if(!defined('ABSPATH')) die('please, do not call this page directly');

//ACTIVATE

//plugin activate function
if(!function_exists('nfpdap_plugin_activate')){

	function nfpdap_plugin_activate() {
				
		//get NutsForPress setting
		global $nfproot_plugins_settings;
		
		//define plugin installaton type
		$nfproot_plugins_settings['nfpdap']['prefix'] = 'nfpdap';
		$nfproot_plugins_settings['nfpdap']['slug'] = 'nfpdap-settings';
		$nfproot_plugins_settings['nfpdap']['edition'] = 'repository';
		$nfproot_plugins_settings['nfpdap']['name'] = 'Duplicate Any Posts';
		
		//update NutsForPress setting
		update_option('_nfproot_plugins_settings', $nfproot_plugins_settings, false);
			
	}
		
}  else {
	
	error_log('NUTSFORPRESS ERROR: function "nfpdap_plugin_activate" already exists');
	
}