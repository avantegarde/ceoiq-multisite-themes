<?php
/**
 * Template Name: Contact
 *
 * The default page for contact page
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
    $image = $feat_image[0] ? $feat_image[0] : get_template_directory_uri() . '/inc/images/bg-repeat-light.jpg';
    $bg_class = $feat_image[0] ? '' : 'bg-repeat-light';
    $contentLocation = custom_header_content_get_meta('custom_header_content_location') ? custom_header_content_get_meta('custom_header_content_location') : 'content-center';
    ?>
    <section id="page-header" class="<?php echo $contentLocation; ?> <?php echo strtolower($bannerHeight) ?>">
        <div class="container">
            <div class="header-content">
                <?php
                $customTitle = html_entity_decode( custom_header_content_get_meta('custom_header_content_title') );
                $customHeaderCont = html_entity_decode( custom_header_content_get_meta('custom_header_content_content') );
                ?>
                <?php if( $customTitle && $customHeaderCont ): ?>
                    <h1 class="page-title"><?php echo $customTitle; ?></h1>
                    <p class="header-subline"><?php echo $customHeaderCont; ?></p>
                <?php elseif( $customTitle && !$customHeaderCont ): ?>
                    <h1 class="page-title"><?php echo $customTitle; ?></h1>
                <?php elseif( !$customTitle && $customHeaderCont ): ?>
                    <?php the_title( '<h1 class="page-title">', '</h1>' ); ?>
                    <p class="header-subline"><?php echo $customHeaderCont; ?></p>
                <?php else : ?>
                    <?php the_title( '<h1 class="page-title">', '</h1>' ); ?>
                <?php endif; ?>
            </div>
        </div>
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

            <!-- BreadCrumbs -->
            <?php
            if (function_exists('yoast_breadcrumb')) {
                yoast_breadcrumb('<div id="breadcrumbs" class="col-md-12">', '</div>');
            }
            ?>

            <!-- Contact Details -->
            <!-- <section id="contact-details">
                <div class="row">

                    <div class="col-md-6">
                        [gravityform id="3" title="false" description="false" ajax="true"]
                    </div>
                    <div class="col-md-6 center">
                        <iframe src="https://player.vimeo.com/video/17404191?color=069e24&byline=0&portrait=0" width="900" height="600" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                        <ul class="social contact">
                            <li><a href="mailto:info@ceoiq.com" target="_blank"><i class="fa fa-envelope-o"></i></a></li>
                            <li><a href="https://twitter.com/" target="_blank"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="https://www.linkedin.com/" target="_blank"><i class="fa fa-linkedin-square"></i></a></li>
                            <li class="phone"><a href="tel:4435298455">443-529-8455</a></li>
                            <li class="email"><a href="mailto:info@ceoiq.com" target="_blank">info@CEOIQ.com</a></li>
                        </ul>
                    </div>

                </div>
            </section> -->

            <?php get_template_part('template-parts/content', 'page'); ?>

            <?php // If comments are open or we have at least one comment, load up the comment template.
            /*if (comments_open() || get_comments_number()) :
                comments_template();
            endif;*/ ?>

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
get_footer();
