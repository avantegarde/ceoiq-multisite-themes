<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package ferus_core
 */

get_header(); ?>

    <section id="page-header" class="custom-header">
        <header class="inner">
            <h1><?php printf( esc_html__( 'Search Results for: %s', 'ferus_core' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
            <!-- <p></p> -->
        </header>
    </section>

    <div id="page-wrap" class="clearfix">

        <div id="primary" class="content-area search-content clearfix" data-col=primary>

            <?php if ( is_active_sidebar( 'page-header' ) ) : ?>
                <div id="page-header" class="widget-area" role="complementary">
                    <?php dynamic_sidebar( 'page-header' ); ?>
                </div><!-- #page-header -->
            <?php endif; ?>

            <main id="main" class="site-main" role="main">

                <?php
                if ( have_posts() ) : ?>

                    <?php
                    /* Start the Loop */
                    while ( have_posts() ) : the_post();
                        // Remove Pages from results
                        if ( $post->post_type=='post' ) { continue; }

                        /**
                         * Run the loop for the search to output the results.
                         * If you want to overload this in a child theme then include a file
                         * called content-search.php and that will be used instead.
                         */
                        get_template_part( 'template-parts/content', 'search' );

                    endwhile;

                    the_posts_navigation();

                else :

                    get_template_part( 'template-parts/content', 'none' );

                endif; ?>

            </main><!-- #main -->
            <main id="main" class="site-main container" role="main">
                <div class="row posts-grid-wrapper">

                    <?php
                    if (have_posts()) :
                        /* Start the Loop */
                        while (have_posts()) : the_post();
                            // Remove Pages from results
                            if ( $post->post_type=='post' ) { continue; } ?>

                            <?php $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'post-med'); ?>
                            <div class="post-item col-md-12">

                                <article id="post-<?php echo $post->ID; ?>" class="post-<?php echo $post->ID; ?> post-inner panel">

                                    <?php if ($image): ?>
                                        <a class="post-thumb" href="<?php echo get_permalink($post->ID); ?>" data-col="post-inner" style="background-image: url(<?php echo $image[0] ?>);"></a>
                                    <?php else: ?>
                                        <a class="post-thumb" href="<?php echo get_permalink($post->ID); ?>" data-col="post-inner" style="background-image: url(/wp-content/themes/ceoiq/inc/images/hero.jpg);"></a>
                                    <?php endif; ?>

                                    <div class="post-content" data-col="post-inner">
                                        <!-- <div class="category">
                                        <?php // the_category( ' | ', '', $post->ID ); ?>
                                </div> -->
                                        <h2 class="post-title">
                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                        </h2>
                                        <p class="author-date"><?php the_time('m-d-Y'); ?> | Author: <?php the_author(); ?></p>

                                        <p class="content-blurb">
                                            <?php echo wp_trim_words($post->post_content, 46, '...'); ?>
                                        </p>
                                        <a href="<?php the_permalink(); ?>" data-button="arrow">Learn More</a>
                                    </div>
                                </article>
                            </div>

                        <?php endwhile;

                    else :
                        get_template_part('template-parts/content', 'none');
                    endif; ?>
                </div><!-- .row -->
            </main><!-- #main -->

            <?php if ( is_active_sidebar( 'inner-bottom' ) ) : ?>
                <section id="inner-bottom" class="inner-bottom" role="complementary">
                    <?php dynamic_sidebar( 'inner-bottom' ); ?>
                </section><!-- #page-bottom -->
            <?php endif; ?>

        </div><!-- #primary -->

        <?php get_sidebar(); ?>
    </div><!-- #page-bottom -->

<?php if ( is_active_sidebar( 'page-bottom' ) ) : ?>
    <section id="page-bottom" class="page-bottom" role="complementary">
        <?php dynamic_sidebar( 'page-bottom' ); ?>
    </section><!-- #page-bottom -->
<?php endif; ?>

<?php
get_footer();
