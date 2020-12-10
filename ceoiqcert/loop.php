<?php
/**
 * Main Loop
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ferus_core
 */

?>

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
        ?>
        <div class="post-item post-<?php echo $count; ?> animated fadeIn">

            <article id="post-<?php echo $post->ID; ?>" class="post-<?php echo $post->ID; ?> post-inner" style="background-image: url(<?php echo $image; ?>);">



                <div class="post-content animated flipInX">
                    <div class="category">
                        <?php the_category( ' | ', '', $post->ID ); ?>
                    </div>
                    <p class="author-date"><?php the_author(); ?> | <?php the_time('F d, Y'); ?></p>
                    <h2 class="post-title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h2>

                    <!-- <div class="content-blurb">
                                    <?php // echo $excerpt; ?>
                                </div> -->
                    <!-- <a href="<?php the_permalink(); ?>" data-button="arrow">Learn More</a> -->
                </div>
            </article>
        </div>

        <?php
        $count = $count + 1;
        if ($count === 7) {
            $count = 0;
        } ?>
    <?php endwhile;

else :
    get_template_part('template-parts/content', 'none');
endif; ?>