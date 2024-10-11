<?php
/**
 * Theme functions and definitions
 *
 * @package Blogtag
 */

if ( ! function_exists( 'blogtag_enqueue_styles' ) ) :
	/**
	 * @since 0.1
	 */
	function blogtag_enqueue_styles() {
		wp_enqueue_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.css');
		wp_enqueue_style( 'blogdata-style-parent', get_template_directory_uri() . '/style.css' );
		wp_enqueue_style( 'blogtag-style', get_stylesheet_directory_uri() . '/style.css', array( 'blogdata-style-parent' ), '1.0' );
		wp_enqueue_style( 'blogtag-default-css', get_stylesheet_directory_uri()."/css/colors/default.css" );
		wp_enqueue_style( 'blogtag-dark', get_stylesheet_directory_uri() . '/css/colors/dark.css');

		if(is_rtl()){
			wp_enqueue_style( 'blogdata_style_rtl', trailingslashit( get_template_directory_uri() ) . 'style-rtl.css' );
	    }
		
	}

endif;
add_action( 'wp_enqueue_scripts', 'blogtag_enqueue_styles', 9999 );

function blogtag_customizer_rid_values($wp_customize) {

	$wp_customize->remove_section('header_advert_section');
	
}
add_action( 'customize_register', 'blogtag_customizer_rid_values', 1000 );

function blogtag_theme_setup() {
	//Load text domain for translation-ready
	load_theme_textdomain('blogtag', get_stylesheet_directory() . '/languages');

	require( get_stylesheet_directory() . '/customizer-default.php' );
	require( get_stylesheet_directory() . '/general-options.php' );
	require( get_stylesheet_directory() . '/hooks/header-hook.php' );
	require( get_stylesheet_directory() . '/font.php' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'automatic-feed-links' );
} 
add_action( 'after_setup_theme', 'blogtag_theme_setup' );


if( ! function_exists( 'blogtag_add_menu_description' ) ) :
    
    function blogtag_add_menu_description( $item_output, $item, $depth, $args ) {
        if($args->theme_location != 'primary') return $item_output;
        
        if ( !empty( $item->description ) ) {
            $item_output = str_replace( $args->link_after . '</a>', '<span class="menu-link-description">' . $item->description . '</span>' . $args->link_after . '</a>', $item_output );
        }
        return $item_output;
    }
    add_filter( 'walker_nav_menu_start_el', 'blogtag_add_menu_description', 10, 4 );
endif;

$args = array(
    'default-color' => '#f4f4f4',
    'default-image' => '',
	);
add_theme_support( 'custom-background', $args );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function blogtag_widgets_init() {

	$blogdata_footer_column_layout = esc_attr(get_theme_mod('blogdata_footer_column_layout',3));
	
	$blogdata_footer_column_layout = 12 / $blogdata_footer_column_layout;
	
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar Widget Area', 'blogtag' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<div id="%1$s" class="bs-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="bs-widget-title"><h2 class="title">',
		'after_title'   => '</h2></div>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Widget Area', 'blogtag' ),
		'id'            => 'footer_widget_area',
		'description'   => '',
		'before_widget' => '<div id="%1$s" class="col-md-'.$blogdata_footer_column_layout.' rotateInDownLeft animated bs-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="bs-widget-title"><h2 class="title">',
		'after_title'   => '</h2></div>',
	) );

}
add_action( 'widgets_init', 'blogtag_widgets_init' );

function blogtag_custom_css(){ ?>
<style>	
	.site-branding-text .site-title a:hover{
		color: <?php echo esc_attr(get_theme_mod('header_text_color_on_hover','#0d6eff'))?> !important;
	}
	body.dark .site-branding-text .site-title a:hover{
		color: <?php echo esc_attr(get_theme_mod('header_text_dark_color_on_hover','#0d6eff'))?> !important;
	}
</style>
<script>
	(function($) {
		"use strict";
		function applyTabNavigation(selector) {
		$(document).ready(function() {
			$(selector).each(function() {
				var $capture = $(this);

				$capture
				.attr('tabindex', '-1')
				.focus()
				.keydown(function handleKeydown(event) {
					if (event.key.toLowerCase() !== 'tab') {
						return;
					}
					var tabbable = $()
					.add($capture.find('button, input, select, textarea'))
					.add($capture.find('[href]'))
					.add($capture.find('[tabindex]:not([tabindex="-1"])'));

					var $target = $(event.target);

					if (tabbable.length === 0) {
						return;
					}
					var firstTabbable = tabbable.first();
					var lastTabbable = tabbable.last();
					if (event.shiftKey) { 
						if ($target.is(firstTabbable)) {
							event.preventDefault();
							lastTabbable.focus();
						}
					} else { 
						if ($target.is(lastTabbable)) {
							event.preventDefault();
							firstTabbable.focus();
						}
					}
				});

				// Ensure focus starts within the container when it's focused
				$capture.on('focus', function() {
					var tabbable = $()
					.add($capture.find('button, input, select, textarea'))
					.add($capture.find('[href]'))
					.add($capture.find('[tabindex]:not([tabindex="-1"])'));

					if (tabbable.length > 0) {
						tabbable.first().focus();
					}
				});
			});
		});
		}

		// Apply to multiple selectors
		applyTabNavigation('.search-popup');
		applyTabNavigation('.bs-offcanvas.end');

		
		function onClickFocus(clickableSelector, focusableSelector) {
			const clickableElements = document.querySelectorAll(clickableSelector);

			// Iterate over each clickable element
			clickableElements.forEach(clickableElement => {
				// Add click event listener to the clickable element
				clickableElement.addEventListener('click', function() {
				// Find the focusable element
				const focusableElement = document.querySelector(focusableSelector);
				if (focusableElement) {
					// Focus on the focusable element
					focusableElement.focus();
				}
				});
			});
		}

		onClickFocus('[bs-data-clickable-end]', '[bs-data-removable]');
		onClickFocus('[bs-data-removable]', '[bs-data-clickable-end]');
		onClickFocus('[bs-search-clickable]', '[bs-dismiss-search]');
		onClickFocus('[bs-dismiss-search]', '[bs-search-clickable]');

	})(jQuery);
</script>
<?php
} 
add_action('wp_footer', 'blogtag_custom_css',999);

function blogtag_customizer_styles() {
	?>
	<style>
		body #accordion-section-blogdata_pro_upsell h3 .button-secondary:hover{
			color: #0d6eff !important;
			border-color: currentcolor;
		}
	</style>
	<?php
}
add_action('customize_controls_enqueue_scripts', 'blogtag_customizer_styles');