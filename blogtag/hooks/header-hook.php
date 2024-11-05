<?php if (!function_exists('blogtag_header_type_section')) :
/**
 *  Header
 *
 * @since Blogtag
 *
 */
function blogtag_header_type_section(){

  do_action('blogdata_action_header_image_section'); ?>
  <!--header-->
  <header class="bs-headfive">
    <div class="clearfix"></div>
    <div class="bs-header-main">  
      <div class="container">
        <div class="main d-flex align-center">
          
          <div class="logo col-lg-12 d-none d-lg-flex justify-center">
            <!-- logo Area-->
            <?php do_action('blogdata_action_header_logo_section'); ?>
            <!-- /logo Area-->
          </div>
          <!--col-lg-4-->
          <!--/col-lg-6-->
        </div>
      </div>
    </div>
    <!-- Main Menu Area-->
    <?php $sticky_header = get_theme_mod('sticky_header_toggle', true ) == true ? ' sticky-header' : ''; ?>
    <div class="bs-menu-full<?php echo esc_attr($sticky_header); ?>">
      <div class="inner">
        <div class="container">
          <div class="main d-flex align-center">
          <div class="col-lg-3 d-none d-lg-flex justify-start">
            <?php if(get_theme_mod('header_social_icon_enable', true) == true) { do_action('blogdata_action_social_section'); } ?>           
          </div>
            <!-- logo Area-->
            <?php do_action('blogdata_action_header_logo_section'); ?>
            <!-- /logo Area-->
              <!-- Main Menu Area-->
              <?php do_action('blogdata_action_header_menu_section'); ?>
              <!-- /Main Menu Area-->
          <div class="col-lg-3">
          <!-- Right Area-->
            <?php do_action('blogdata_action_header_right_menu_section'); ?>
          <!-- Right-->
          </div>
          </div><!-- /main-->
        </div><!-- /container-->
      </div><!-- /inner-->
    </div><!-- /Main Menu Area-->
  </header> <?php
}
endif;
add_action('blogtag_action_header_type_section', 'blogtag_header_type_section', 6);


if (!function_exists('blogtag_side_menu_section')) :
  /**
   *  Header
   *
   * @since blogdata
   *
   */
  function blogtag_side_menu_section() { ?>
    <aside class="bs-offcanvas end" bs-data-targeted="true">
      <div class="bs-offcanvas-close">
        <a href="#" class="bs-offcanvas-btn-close" bs-data-removable="true">
          <span></span>
          <span></span>
        </a>
      </div>
      <div class="bs-offcanvas-inner">
        <?php if( is_active_sidebar('menu-sidebar-content')){
          get_template_part('sidebar','menu');
        } else { ?>
        
        <div class="bs-card-box empty-sidebar">
          <div class="bs-widget-title one">
            <h2 class='title'><?php echo esc_html( 'Header Toggle Sidebar', 'blogdata' ); ?></h3>
          </div>
          <p class='empty-sidebar-widget-text'>
            <?php echo esc_html( 'This is an example widget to show how the Header Toggle Sidebar looks by default. You can add custom widgets from the', 'blogdata' ); ?>
            <a href='<?php echo esc_url( admin_url( 'widgets.php' ) ); ?>' title='<?php esc_attr_e('widgets','blogdata'); ?>'>
              <?php echo esc_html( 'widgets', 'blogdata' ); ?>
            </a>
            <?php echo esc_html( 'in the admin.', 'blogdata' ); ?>
          </p>
        </div>
        <?php } ?>
      </div>
    </aside>
    <?php 
  }
  endif;
  add_action('wp_footer', 'blogtag_side_menu_section', 5);