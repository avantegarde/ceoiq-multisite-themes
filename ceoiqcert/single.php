<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Ferus_Core
 */

get_header(); ?>

    <!-- <section id="post-header" class="bg-repeat-light" style="background-image:url(<?php echo get_template_directory_uri() . '/inc/images/bg-repeat-light.jpg'; ?>);"></section> -->


    <div id="primary" class="content-area">
        <main id="main" class="site-main container" role="main">
            <div class="row">
                <?php
                while (have_posts()) : the_post(); ?>

                    <div class="col-md-12">
                        <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' ); ?>
                        <?php if($image): ?>
                            <div id="post-img" style="background-image:url(<?php echo $image[ 0 ] ?>);"></div>
                        <?php else : ?>
                            <div id="post-img" style="background-image:url(<?php echo get_template_directory_uri(); ?>/inc/images/hero.jpg);"></div>
                        <?php endif; ?>
                    </div>

                    <div class="col-md-8">
                        <?php get_template_part('template-parts/content', get_post_format()); ?>
                    </div>
                    <div id="sidebar" class="col-md-4">
                        <?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
                            <?php dynamic_sidebar( 'sidebar-1' ); ?>
                        <?php endif; ?>
                    </div>

                    <?php //the_post_navigation(); ?>

                    <?php // If comments are open or we have at least one comment, load up the comment template.
                    //if (comments_open() || get_comments_number()) : ?>
                        <!-- <div class="container">
                            <div class="col-md-10 col-md-push-1 panel">
                                <div class="panel-content">
                                    <?php //comments_template(); ?>
                                </div>
                            </div>
                        </div> -->
                    <?php // endif; ?>

                <?php // End of the loop.
                endwhile; ?>
            </div><!-- .row -->
        </main><!-- #main -->
    </div><!-- #primary -->

<?php
get_footer();
