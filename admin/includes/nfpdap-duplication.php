<?php
//if this file is called directly, abort.
if(!defined('ABSPATH')) die('please, do not call this page directly');

if(!function_exists('nfpdap_duplication')){

	function nfpdap_duplication() {
		
		//first check if url contains all the esxpected values
		if(
		
			!empty($_REQUEST['action'])
			&& !empty($_REQUEST['post'])
			&& !empty($_REQUEST['_wpnonce'])
		
		){
			
			//now check is values passed are valid
			if(
			
				sanitize_text_field($_REQUEST['action']) === 'nfpdap_duplicate'
				&& wp_verify_nonce($_REQUEST['_wpnonce'], 'nfpdap_duplicate_nonce')
				&& (
				
					get_post_status(absint($_REQUEST['post'])) === 'publish'
					|| get_post_status(absint($_REQUEST['post'])) === 'private'
					|| get_post_status(absint($_REQUEST['post'])) === 'draft'
					
				)			
			
			){
				
				$nfpdap_original_post_id = absint($_REQUEST['post']);
				
				$nfpdap_original_post_object = get_post($nfpdap_original_post_id);
				
				if(!empty($nfpdap_original_post_object)){
					
					$nfpdap_current_user = wp_get_current_user();
					$nfpdap_current_user_id = $nfpdap_current_user -> ID;
					
					$nfpdap_involved_post_type = $nfpdap_original_post_object->post_type;
										
					$nfpdap_post_to_duplicate_args = array(
					
						'post_type'      => $nfpdap_involved_post_type,
						'post_author'    => $nfpdap_original_post_object->post_author,
						'post_title'     => $nfpdap_original_post_object->post_title,
						'post_content'   => $nfpdap_original_post_object->post_content,
						'post_excerpt'   => $nfpdap_original_post_object->post_excerpt,
						'post_parent'    => $nfpdap_original_post_object->post_parent,
						'post_status'    => 'draft'	
					
					);	

					$nfpdap_duplicated_post_id = wp_insert_post($nfpdap_post_to_duplicate_args);	

					if(!is_wp_error($nfpdap_duplicated_post_id)){
						
						//get all the original post meta
						$nfpdap_original_post_metas = get_post_meta($nfpdap_original_post_id);
						
						//if original post meta are found
						if(
						
							!empty($nfpdap_original_post_metas)
							&& is_array($nfpdap_original_post_metas)
							
						){
							
							$nfpdap_original_post_meta_keys = array_keys($nfpdap_original_post_metas);

							//loop into original post meta
							foreach($nfpdap_original_post_meta_keys as $nfpdap_original_post_meta_key){
								
								//get each original post meta
								$nfpdap_original_post_meta = get_post_meta(
								
									$nfpdap_original_post_id, 
									$nfpdap_original_post_meta_key, 
									true
									
								);
								
								//compensate for the call to stripslashes()
								if($nfpdap_original_post_meta_key === '_elementor_data'){
									
									$nfpdap_original_post_meta = wp_slash($nfpdap_original_post_meta);
									
								}
								
								//do not add _elementor_template_type and _elementor_css meta, since they are built as soon as you navigate the duplicated page
								if(
								
									$nfpdap_original_post_meta_key === '_elementor_template_type'
									|| $nfpdap_original_post_meta_key === '_elementor_css'
									
								){
									
									continue;
									
								}
									
								//create post meta for the duplicated post
								update_post_meta(
								
									$nfpdap_duplicated_post_id,
									$nfpdap_original_post_meta_key,
									$nfpdap_original_post_meta
								
								);
		
							}						
							
						}					

						//get the original taxonomies
						$nfpdap_original_post_taxonomies = get_object_taxonomies($nfpdap_involved_post_type);
						
						//if original taxonomies are found
						if(
							
							!empty($nfpdap_original_post_taxonomies) 
							&& is_array($nfpdap_original_post_taxonomies) 
							
						){
							
							//loop into original taxonomies
							foreach ($nfpdap_original_post_taxonomies as $nfpdap_original_post_taxonomy) {
								
								//get the terms
								$nfpdap_involved_post_terms = wp_get_object_terms(
								
									$nfpdap_original_post_id, 
									$nfpdap_original_post_taxonomy, 
									array( 
									
										'fields' => 'slugs' 
									
									) 
									
								);
								
								//set the terms
								wp_set_object_terms(

									$nfpdap_duplicated_post_id, 
									$nfpdap_involved_post_terms, 
									$nfpdap_original_post_taxonomy, 
									false 
									
								);
								
							}
							
						}					
						
					}
					
					wp_safe_redirect('edit.php?post_type='.$nfpdap_involved_post_type);
					
				}
			
			}
			
		}

	}
	
} else {
	
	error_log('NUTSFORPRESS ERROR: function "nfpdap_duplication" already exists');
	
}