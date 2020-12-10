<?php
/**
 * Template Name: Course Preview
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Ferus_Core
 */

get_header(); ?>

    <?php
    $iHeight = header_height_get_meta( 'header_height_size' );
    if($iHeight) {
        $bannerHeight = $iHeight;
    } else {
        $bannerHeight = '';
    }
    ?>
    <?php if($bannerHeight != 'None'): ?>
        <?php
        $feat_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );
        $image = $feat_image[0] ? $feat_image[0] : '';
        $bg_class = $feat_image[0] ? '' : 'bg-repeat-light';
        $contentLocation = custom_header_content_get_meta('custom_header_content_location') ? custom_header_content_get_meta('custom_header_content_location') : 'content-center';
        ?>
        <section id="page-header" class="fp <?php echo $contentLocation; ?> <?php echo strtolower($bannerHeight) ?>" style="background-image:url(<?php echo $image; ?>);">
            <div class="triangle"><span>Featured Program</span></div>
        </section>
    <?php endif; ?>

<!-- Page Top Widgets -->
<?php if ( is_active_sidebar( 'page-top' ) ) : ?>
    <section id="page-top" class="widget-area" role="complementary">
        <?php dynamic_sidebar( 'page-top' ); ?>
    </section>
<?php endif; ?>

<!-- Inner Top Widgets -->
<?php if ( is_active_sidebar( 'inner-top' ) ) : ?>
    <section id="inner-top" class="widget-area" role="complementary">
        <?php dynamic_sidebar( 'inner-top' ); ?>
    </section>
<?php endif; ?>

<?php while (have_posts()) : the_post(); ?>
    <section id="primary" class="content-area">
        <main id="main" class="site-main container" role="main">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <!-- BreadCrumbs -->
                    <?php
                    if (function_exists('yoast_breadcrumb')) {
                        yoast_breadcrumb('<div id="breadcrumbs" class="col-md-12">', '</div>');
                    }
                    ?>

                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <?php the_title( '<h1 class="page-title">', '</h1>' ); ?>

                        <div class="entry-content">

                            <?php the_content(); ?>

                        </div><!-- .entry-content -->
                    </article><!-- #post-## -->

                    <?php // If comments are open or we have at least one comment, load up the comment template.
                    /*if (comments_open() || get_comments_number()) :
                        comments_template();
                    endif;*/ ?>
                </div>
            </div>
        </main><!-- #main -->
    </section><!-- #primary -->
<?php endwhile; // End of the loop. ?>

<!-- Inner Bottom Widgets -->
<?php if ( is_active_sidebar( 'inner-bottom' ) ) : ?>
    <section id="inner-bottom" class="widget-area" role="complementary">
        <?php dynamic_sidebar( 'inner-bottom' ); ?>
    </section>
<?php endif; ?>

<!-- Page Bottom Widgets -->
<?php if ( is_active_sidebar( 'page-bottom' ) ) : ?>
    <section id="page-bottom" class="widget-area" role="complementary">
        <?php dynamic_sidebar( 'page-bottom' ); ?>
    </section>
<?php endif; ?>

<?php
$dll_program_name = get_the_title();
?>
<div id="dllModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="section-title center">Get More Information</h3>
                <?php echo do_shortcode('[gravityform id="18" field_values="dll_name='.$dll_program_name.'" title="false" description="false" ajax="true" tabindex="999"]'); ?>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<?php
get_footer();
