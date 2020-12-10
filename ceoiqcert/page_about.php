<?php
/**
 * Template Name: About
 *
 * The default full-width template
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
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <!-- BreadCrumbs -->
                    <?php
                    if (function_exists('yoast_breadcrumb')) {
                        yoast_breadcrumb('<div id="breadcrumbs" class="col-md-12">', '</div>');
                    }
                    ?>

                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <?php
                        $bannerHeight = header_height_get_meta( 'header_height_size' );
                        if($bannerHeight === 'None'): ?>
                            <header class="entry-header">
                                <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
                            </header><!-- .entry-header -->
                        <?php endif; ?>

                        <div class="entry-content">
                            <?php
                            the_content();

                            wp_link_pages(array(
                                'before' => '<div class="page-links">' . esc_html__('Pages:', 'ferus_core'),
                                'after' => '</div>',
                            ));
                            ?>

                            <div class="row">
                                <div class="col-md-3">
                                    <h3>A little piece of history.</h3>
                                </div>
                                <div class="col-md-9">
                                    <h2>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod.</h2>
                                    <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum. Lorem ipsum dolor sit amet, consetetur sadipscing elitr.</p>
                                    <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum. Lorem ipsum dolor sit amet, consetetur sadipscing elitr. labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.</p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <h3>Meet the Staff</h3>
                                </div>
                                <?php echo do_shortcode('[consultants people="dave,mandy,johnny,sarah"]'); ?>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <h3>What We Do Differently</h3>
                                </div>
                                <div class="col-md-9">
                                    <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum. Lorem ipsum dolor sit amet, consetetur sadipscing elitr.</p>
                                    <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum. Lorem ipsum dolor sit amet, consetetur sadipscing elitr. labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.</p>
                                </div>
                            </div>

                            <h3>Case Studies</h3>

                            <div class="accordion">

                                <h3 data-accordion="title">Client Case Study</h3>
                                <div data-accordion="content">
                                    <p>At vero eos et accusamus. Animi, id est laborum et dolorum fuga. Inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Laboris nisi ut aliquip ex ea commodo consequat. Itaque earum rerum hic tenetur a sapiente delectus.</p>
                                    <p>Ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat. Duis aute irure dolor in reprehenderit in voluptate velit. Qui officia deserunt mollit anim id est laborum.</p>
                                    <p>Et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque. Totam rem aperiam. At vero eos et accusamus. Et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque.</p>
                                    <p>Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit. Corrupti quos dolores et quas molestias excepturi sint occaecati. Et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque.</p>
                                </div>
                                <h3 data-accordion="title">Client Case Study</h3>
                                <div data-accordion="content">
                                    <p>At vero eos et accusamus. Animi, id est laborum et dolorum fuga. Inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Laboris nisi ut aliquip ex ea commodo consequat. Itaque earum rerum hic tenetur a sapiente delectus.</p>
                                    <p>Ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat. Duis aute irure dolor in reprehenderit in voluptate velit. Qui officia deserunt mollit anim id est laborum.</p>
                                    <p>Et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque. Totam rem aperiam. At vero eos et accusamus. Et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque.</p>
                                    <p>Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit. Corrupti quos dolores et quas molestias excepturi sint occaecati. Et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque.</p>
                                </div>
                                <h3 data-accordion="title">Client Case Study</h3>
                                <div data-accordion="content">
                                    <p>At vero eos et accusamus. Animi, id est laborum et dolorum fuga. Inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Laboris nisi ut aliquip ex ea commodo consequat. Itaque earum rerum hic tenetur a sapiente delectus.</p>
                                    <p>Ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat. Duis aute irure dolor in reprehenderit in voluptate velit. Qui officia deserunt mollit anim id est laborum.</p>
                                    <p>Et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque. Totam rem aperiam. At vero eos et accusamus. Et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque.</p>
                                    <p>Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit. Corrupti quos dolores et quas molestias excepturi sint occaecati. Et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque.</p>
                                </div>
                                <h3 data-accordion="title">Client Case Study</h3>
                                <div data-accordion="content">
                                    <p>At vero eos et accusamus. Animi, id est laborum et dolorum fuga. Inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Laboris nisi ut aliquip ex ea commodo consequat. Itaque earum rerum hic tenetur a sapiente delectus.</p>
                                    <p>Ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat. Duis aute irure dolor in reprehenderit in voluptate velit. Qui officia deserunt mollit anim id est laborum.</p>
                                    <p>Et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque. Totam rem aperiam. At vero eos et accusamus. Et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque.</p>
                                    <p>Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit. Corrupti quos dolores et quas molestias excepturi sint occaecati. Et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque.</p>
                                </div>
                                <h3 data-accordion="title">Client Case Study</h3>
                                <div data-accordion="content">
                                    <p>At vero eos et accusamus. Animi, id est laborum et dolorum fuga. Inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Laboris nisi ut aliquip ex ea commodo consequat. Itaque earum rerum hic tenetur a sapiente delectus.</p>
                                    <p>Ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat. Duis aute irure dolor in reprehenderit in voluptate velit. Qui officia deserunt mollit anim id est laborum.</p>
                                    <p>Et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque. Totam rem aperiam. At vero eos et accusamus. Et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque.</p>
                                    <p>Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit. Corrupti quos dolores et quas molestias excepturi sint occaecati. Et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque.</p>
                                </div>
                                <h3 data-accordion="title">Client Case Study</h3>
                                <div data-accordion="content">
                                    <p>At vero eos et accusamus. Animi, id est laborum et dolorum fuga. Inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Laboris nisi ut aliquip ex ea commodo consequat. Itaque earum rerum hic tenetur a sapiente delectus.</p>
                                    <p>Ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat. Duis aute irure dolor in reprehenderit in voluptate velit. Qui officia deserunt mollit anim id est laborum.</p>
                                    <p>Et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque. Totam rem aperiam. At vero eos et accusamus. Et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque.</p>
                                    <p>Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit. Corrupti quos dolores et quas molestias excepturi sint occaecati. Et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque.</p>
                                </div>

                            </div>



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
get_footer();
