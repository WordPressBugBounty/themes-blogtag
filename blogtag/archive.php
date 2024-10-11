<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * @package Blogtag
 */
get_header(); ?>
<main id="content" class="archive-class">
    <!--container-->
    <div class="container">
    <?php do_action('blogdata_action_archive_page_title'); ?>
        <!--row-->
        <div class="row">
       <?php $content_layout = (blogdata_get_option('blogdata_archive_page_layout'));
        $blog_post_layout = (get_theme_mod('blog_post_layout','list-layout'));
        if($content_layout == "align-content-left") { ?>
            <!-- col-lg-4 -->
                <aside class="col-lg-4 sidebar-left">
                    <?php get_sidebar();?>
                </aside>
            <!-- / col-lg-4 -->
        <?php } ?>
        <div class="<?php
            echo esc_attr(($content_layout == "full-width-content")
                ? 'col-lg-12' :  'col-lg-8 content-right'); ?>"> <?php 
            if($blog_post_layout == 'grid-layout'){
                get_template_part('content','grid');
            } else { get_template_part('content',''); } ?>
        </div>

        <?php if($content_layout == "align-content-right") { ?>
            <!--col-lg-4-->
                <aside class="col-lg-4 sidebar-right">
                    <?php get_sidebar();?>
                </aside>
            <!--/col-lg-4-->
        <?php } ?>
        </div><!--/row-->
    </div><!--/container-->
</main>                
<?php
get_footer();
?>