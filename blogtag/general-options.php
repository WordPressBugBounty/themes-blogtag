<?php

/**
 * Option Panel
 *
 * @package Blogtag
 */

function blogtag_general_customize_register($wp_customize) {

    $blogtag_default = blogtag_get_default_theme_options();
    
	$wp_customize->get_setting('blog_post_layout')->default = 'list-layout';
	$wp_customize->get_setting('header_text_color_on_hover')->default = '#0d6eff';
	$wp_customize->get_setting('header_text_dark_color_on_hover')->default = '#0d6eff';
	$wp_customize->get_setting('show_main_banner_section')->default = false;


	// $wp_customize->get_control('tren_edit_section_title')->label = esc_html__('Editor Post Section', 'blogtag');

	Blogdata_Customizer_Control::add_field( 
		array(
			'type'     => 'toggle', 
			'settings'  => 'header_social_icon_enable',
			'label' => esc_html__('Enable Header Social Icon', 'blogdata'),
			'section'  => 'social_icon_options',
			'priority' => 102,
			'default' => true,
			'sanitize_callback' => 'blogdata_sanitize_checkbox',
		)
	);

}
add_action('customize_register', 'blogtag_general_customize_register');