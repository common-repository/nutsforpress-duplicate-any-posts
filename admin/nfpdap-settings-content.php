<?php
//if this file is called directly, die.
if(!defined('ABSPATH')) die('please, do not call this page directly');
	
//with this function we will define the NutsForPress menu page content
if(!function_exists('nfpdap_settings_content')) {
	
	function nfpdap_settings_content() {
		
		//get builtin post types
		$nfpdap_builtin_post_types_args = array(
		
			'exclude_from_search' => false,
			'public'   => true,
			'_builtin' => true,
			'publicly_queryable' => true
			
		);
			
		$nfpdap_builtin_post_types = get_post_types($nfpdap_builtin_post_types_args, 'objects');

		//get public post types
		$nfpdap_public_post_types_args = array(
		
			'exclude_from_search' => false,
			'public'   => true,
			'_builtin' => false,
			'publicly_queryable' => true
			
		);
			
		$nfpdap_public_post_types = get_post_types($nfpdap_public_post_types_args, 'objects');
		
		//get private post types
		$nfpdap_private_post_types_args = array(
		
			'exclude_from_search' => false,
			'public'   => false,
			'_builtin' => false,
			
		);
			
		$nfpdap_private_post_types = get_post_types($nfpdap_private_post_types_args, 'objects');
		
		//define child elements
		$nfpdap_settings_content_childs = array();
		
		//add page post type
		$nfpdap_settings_content_childs[] = array(
		
			'container-title'	=> __('Pages','nutsforpress-duplicate-any-posts'),
		
			'container-id'		=> 'nfpdap_post_type_container',
			'container-class' 	=> 'nfpdap-post-type-container',					
			'input-name' 		=> 'nfproot_post_type_page',
			'add-to-settings'	=> 'global',
			'data-save'			=> 'nfpdap',
			'input-id' 			=> 'nfpdap_post_typepage',
			'input-class'		=> 'nfpdap-post-type',
			'input-description' => __('Add','nutsforpress-duplicate-any-posts').' "'.__('Pages','nutsforpress-duplicate-any-posts').'" '.__('to the post types to duplicate','nutsforpress-duplicate-any-posts'),
			'arrow-before'		=> false,
			'after-input'		=> '',
			'input-type' 		=> 'switch',
			'input-value'		=> 1,			
		
		
		);

		//define post types to exclude
		$nfpdap_builtin_post_type_name_to_exclude = array('attachment');

		//loop into builtin post types
		foreach($nfpdap_builtin_post_types as $nfpdap_builtin_post_type){
			
			$nfpdap_builtin_post_type_name = $nfpdap_builtin_post_type->name;
			$nfpdap_builtin_post_type_label = $nfpdap_builtin_post_type->labels->name;
			
			if(in_array($nfpdap_builtin_post_type_name, $nfpdap_builtin_post_type_name_to_exclude)){
				
				continue;
				
			}
			
			$nfpdap_settings_content_childs[] = array(
			
				'container-title'	=> $nfpdap_builtin_post_type_label,
			
				'container-id'		=> 'nfpdap_post_type_container',
				'container-class' 	=> 'nfpdap-post-type-container',					
				'input-name' 		=> 'nfproot_post_type_'.$nfpdap_builtin_post_type_name,
				'add-to-settings'	=> 'global',
				'data-save'			=> 'nfpdap',
				'input-id' 			=> 'nfpdap_post_type_'.$nfpdap_builtin_post_type_name,
				'input-class'		=> 'nfpdap-post-type',
				'input-description' => __('Add','nutsforpress-duplicate-any-posts').' "'.$nfpdap_builtin_post_type_label.'" '.__('to the post types to duplicate','nutsforpress-duplicate-any-posts'),
				'arrow-before'		=> false,
				'after-input'		=> '',
				'input-type' 		=> 'switch',
				'input-value'		=> 1,			
			
			
			);
			
		}
		
		//loop into public post types
		foreach($nfpdap_public_post_types as $nfpdap_public_post_type){
			
			$nfpdap_public_post_type_name = $nfpdap_public_post_type->name;
			$nfpdap_public_post_type_label = $nfpdap_public_post_type->labels->name;
			
			$nfpdap_settings_content_childs[] = array(
			
				'container-title'	=> $nfpdap_public_post_type_label,
			
				'container-id'		=> 'nfpdap_post_type_container',
				'container-class' 	=> 'nfpdap-post-type-container',					
				'input-name' 		=> 'nfproot_post_type_'.$nfpdap_public_post_type_name,
				'add-to-settings'	=> 'global',
				'data-save'			=> 'nfpdap',
				'input-id' 			=> 'nfpdap_post_type_'.$nfpdap_public_post_type_name,
				'input-class'		=> 'nfpdap-post-type',
				'input-description' => __('Add','nutsforpress-duplicate-any-posts').' "'.$nfpdap_public_post_type_label.'" '.__('to the post types to duplicate','nutsforpress-duplicate-any-posts'),
				'arrow-before'		=> false,
				'after-input'		=> '',
				'input-type' 		=> 'switch',
				'input-value'		=> 1,			
			
			
			);
			
		}
		
		//loop into private post types
		foreach($nfpdap_private_post_types as $nfpdap_private_post_type){
			
			$nfpdap_private_post_type_name = $nfpdap_private_post_type->name;
			$nfpdap_private_post_type_label = $nfpdap_private_post_type->labels->name;
			
			$nfpdap_settings_content_childs[] = array(
			
				'container-title'	=> $nfpdap_private_post_type_label,
			
				'container-id'		=> 'nfpdap_post_type_container',
				'container-class' 	=> 'nfpdap-post-type-container',					
				'input-name' 		=> 'nfproot_post_type_'.$nfpdap_private_post_type_name,
				'add-to-settings'	=> 'global',
				'data-save'			=> 'nfpdap',
				'input-id' 			=> 'nfpdap_post_type_'.$nfpdap_private_post_type_name,
				'input-class'		=> 'nfpdap-post-type',
				'input-description' => __('Add','nutsforpress-duplicate-any-posts').' "'.$nfpdap_private_post_type_label.'" '.__('to the post types to duplicate','nutsforpress-duplicate-any-posts'),
				'arrow-before'		=> false,
				'after-input'		=> '',
				'input-type' 		=> 'switch',
				'input-value'		=> 1,			
			
			
			);
			
		}
		
		//options content
		$nfpdap_settings_content = array(
		
			array(
			
				'container-title'	=> __('Enable the duplicate function','nutsforpress-duplicate-any-posts'),
				
				'container-id'		=> 'nfpdap_duplicate_posts_container',
				'container-class' 	=> 'nfpdap-duplicate-posts-container',
				'input-name'		=> 'nfproot_duplicate_posts',
				'add-to-settings'	=> 'global',
				'data-save'			=> 'nfpdap',
				'input-id'			=> 'nfpdap_duplicate_posts',
				'input-class'		=> 'nfpdap-duplicate-posts',
				'input-description'	=> __('If switched on, to the post list of the post types selected below will be added a link to duplicate them','nutsforpress-duplicate-any-posts'),
				'arrow-before'		=> true,
				'after-input'		=> '',
				'input-type' 		=> 'switch',
				'input-value'		=> '1',
				
				'childs'			=> $nfpdap_settings_content_childs,
				
			),
				
		);
						
		return $nfpdap_settings_content;
		
	}
	
} else {
	
	error_log('NUTSFORPRESS ERROR: function "nfpdap_settings_content" already exists');
	
}