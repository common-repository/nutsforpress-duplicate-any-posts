<?php
//if this file is called directly, abort.
if(!defined('ABSPATH')) die('please, do not call this page directly');

if(!function_exists('nfpdap_add_duplication_link')){

	//add duplicate link into each page, post or post type
	function nfpdap_add_duplication_link($nfpdap_passed_actions, $nfpdap_post_object) {

		if(
		
			is_admin()
			&& current_user_can('edit_posts')
		
		){
			
			//get options 
			global $nfproot_current_language_settings;

			//if duplicate post is enabled
			if(

				!empty($nfproot_current_language_settings['nfpdap']['nfproot_duplicate_posts'])
				&& $nfproot_current_language_settings['nfpdap']['nfproot_duplicate_posts'] === '1'
									
			){

				//get options to deal with post types
				$nfpdap_options_array = $nfproot_current_language_settings['nfpdap'];
				
				$nfpdap_post_types_to_order = array();
				
				//loop into post options
				foreach($nfpdap_options_array as $nfpdap_option_key => $nfpdap_option_value){
					
					//check if option is releted to a post type and if it is switched on
					if(
					
						substr($nfpdap_option_key, 0, 18) === 'nfproot_post_type_'
						&& $nfpdap_option_value === '1'
						
					){
						
						//get the involved post type
						$nfpdap_option_key_exploded = explode('nfproot_post_type_', $nfpdap_option_key);
						$nfpdap_post_type = $nfpdap_option_key_exploded[1];
						
						//check if post type exists
						if(post_type_exists($nfpdap_post_type)){

							$nfpdap_post_types_to_order[] = $nfpdap_post_type;
							
						}
						
					}
					
				}

				//if at least a post type is found and if the current query is related to that post type
				if(
				
					!empty($nfpdap_post_types_to_order)	
					&& in_array($nfpdap_post_object -> post_type, $nfpdap_post_types_to_order) 
					
				){

					$nfpdap_post_id = absint($nfpdap_post_object -> ID);
					
					//skip if post is trashed
					if(get_post_status($nfpdap_post_id) !== 'trash'){
						
						//define a link where we can deal with the duplication request
						$nfpdap_duplication_link = admin_url().'admin.php?action=nfpdap_duplicate&post='.$nfpdap_post_id;
						$nfpdap_duplication_link = wp_nonce_url($nfpdap_duplication_link, 'nfpdap_duplicate_nonce');

						//add action
						$nfpdap_passed_actions['nfpdap_duplicate'] = '<a href="'.$nfpdap_duplication_link.'" title="'.__('Duplicate', 'nfpdaplang').'">'.__('Duplicate', 'nfpdaplang').'</a>';

					}
					
				}
			
			}
			
		}

		return $nfpdap_passed_actions;
	}
	
} else {
	
	error_log('NUTSFORPRESS ERROR: function "nfpdap_add_duplication_link" already exists');
	
}