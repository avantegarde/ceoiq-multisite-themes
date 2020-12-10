<?php
/**
 *
 * Virtual Programs Archive template
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Ferus_Core
 */

get_header(); ?>

<?php if ( is_active_sidebar( 'page-header' ) ) : ?>
    <section id="page-header" class="content-center normal">
        <div class="container">
            <div class="header-content">
                <?php dynamic_sidebar( 'page-header' ); ?>
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


<?php
if (have_posts()) :
    /* Start the Loop */
    $count = 0;
    while (have_posts()) : the_post(); ?>

        <?php
        $feat_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'post-med' );
        $image = $feat_image[0] ? $feat_image[0] : get_template_directory_uri() . '/inc/images/bg-repeat-light.jpg';
        $excerpt_length = 250;
        $content = apply_filters('the_content', get_the_content());
        $excerpt = truncate( $content, $excerpt_length, '...', false, true );
        if ($count === 1) {
            $push_class = 'col-sm-3 col-sm-push-9 col-md-3 col-md-push-9';
            $pull_class = 'col-sm-9 col-sm-pull-3 col-md-9 col-md-pull-3';
        } else {
            $push_class = 'col-sm-3';
            $pull_class = 'col-sm-9';
        }
        ?>
        <section class="program-item">
            <article class="container">
                <div class="<?php echo $push_class; ?>">
                    <img class="spark" src="/wp-content/themes/ceoiq/inc/images/ceoiq-spark.png" width="500">
                </div>
                <div class="<?php echo $pull_class; ?>">
                    <h2 class="post-title">
                        <?php the_title(); ?>
                    </h2>
                    <div class="content-blurb">
                        <?php the_excerpt(); ?>
                    </div>
                    <!-- <p><a href="<?php // the_permalink(); ?>" data-button>Learn More</a></p> -->
                    <a class="vprogram-button" href="#" data-button data-toggle="modal" data-target="#vprogramModal" data-vprogram="<?php the_title(); ?>">Get More Information</a>
                </div>
            </article>
        </section>
        <?php
        $count = $count + 1;
        if ($count === 2) {
            $count = 0;
        } ?>
    <?php endwhile;

else :
    get_template_part('template-parts/content', 'none');
endif; ?>

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

<?php if ( is_active_sidebar( 'vprogram-modal' ) ) : ?>
    <div id="vprogramModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <?php dynamic_sidebar( 'vprogram-modal' ); ?>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
<?php endif; ?>

<?php
get_footer();
