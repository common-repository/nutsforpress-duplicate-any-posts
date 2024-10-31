<?php
//if this file is called directly, die.
if(!defined('ABSPATH')) die('please, do not call this page directly');

//with this function we will create the NutsForPress menu page
if(!function_exists('nfpdap_settings')) {
	
	function nfpdap_settings() {	
		
		global $nfproot_plugins_settings;
		$nfpdap_pro = null;
		
		if(
		
			!empty($nfproot_plugins_settings) 
			&& !empty($nfproot_plugins_settings['installed_plugins']['nfpdap']['edition'])
			&& $nfproot_plugins_settings['installed_plugins']['nfpdap']['edition'] === 'registered'
			
		) {
			
			$nfpdap_pro = ' <span class="dashicons dashicons-saved"></span>';
			
		}
		
		add_submenu_page(
	
			'nfproot-settings',
			'Duplicate Any Posts',
			'Duplicate Any Posts'.$nfpdap_pro,
			'manage_options',
			'nfpdap-settings',
			'nfpdap_settings_callback'
		
		);
		
		
	}
	
} else {
	
	error_log('NUTSFORPRESS ERROR: function "nfpdap_base_options" already exists');
	
}
	
//with this function we will define the NutsForPress menu page content
if(!function_exists('nfpdap_settings_callback')) {
	
	function nfpdap_settings_callback() {
		
		?>
		
		<div class="wrap nfproot-settings-wrap">
			
			<h1>Duplicate Any Posts settings</h1>
			
			<div class="nfproot-settings-main-container">
		
				<?php
				
				//include option content page
				require_once NFPDAP_BASE_PATH.'admin/nfpdap-settings-content.php';
				
				//define contents as result of the function nfpdap_settings_content
				$nfpdap_settings_content = nfpdap_settings_content();
				
				//invoke nfproot_options_structure functions included into /root/options/nfproot-options-structure.php
				nfproot_settings_structure($nfpdap_settings_content);
				
				?>
			
			</div>
		
		</div>
		
		<?php
		
	}
	
} else {
	
	error_log('NUTSFORPRESS ERROR: function "nfpdap_settings" already exists');
	
}