<?php
/*--------------------------------------------------------------------*/
/*     Register Google Fonts
/*--------------------------------------------------------------------*/
function blogtag_fonts_url() {
	
    $fonts_url = '';
		
    $font_families = array();
 
	$font_families = array('Josefin Sans:300,400,500,600,700,800,900');
 
        $query_args = array(
            'family' => urlencode( implode( '|', $font_families ) ),
            'subset' => urlencode( 'latin,latin-ext' ),
        );
 
        $fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );

    return $fonts_url;
}
function blogtag_scripts_styles() {
    wp_enqueue_style( 'blogtag-fonts', blogtag_fonts_url(), array(), null );
}
add_action( 'wp_enqueue_scripts', 'blogtag_scripts_styles' );