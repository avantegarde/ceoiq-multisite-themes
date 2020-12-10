<?php
/**
 * Template Name: Services
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

                            <div class="panel-grid row">
                                <div class="col-md-6 col-lg-4" data-panel="grey" data-col="service-panel">
                                    <div class="panel-content">
                                        <h3>Financial Planning</h3>
                                        <p>Supportive text goes here. Above when I mention related service or keyword, I mean a title such as “Financial Planning”</p>
                                        <p>Supportive text goes here. Above when I mention related service or keyword, I mean a title such as “Financial Planning” Supportive text goes here. Above when I mention related service or keyword, I mean a title such as “Financial Planning”</p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4" data-panel="grey" data-col="service-panel">
                                    <div class="panel-content">
                                        <h3>Financial Planning</h3>
                                        <p>Supportive text goes here. Above when I mention related service or keyword, I mean a title such as “Financial Planning”</p>
                                        <p>Supportive text goes here. Above when I mention related service or keyword, I mean a title such as “Financial Planning” Supportive text goes here. Above when I mention related service or keyword, I mean a title such as “Financial Planning”</p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4" data-panel="grey" data-col="service-panel">
                                    <div class="panel-content">
                                        <h3>Financial Planning</h3>
                                        <p>Supportive text goes here. Above when I mention related service or keyword, I mean a title such as “Financial Planning”</p>
                                        <p>Supportive text goes here. Above when I mention related service or keyword, I mean a title such as “Financial Planning” Supportive text goes here. Above when I mention related service or keyword, I mean a title such as “Financial Planning”</p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4" data-panel="grey" data-col="service-panel">
                                    <div class="panel-content">
                                        <h3>Financial Planning</h3>
                                        <p>Supportive text goes here. Above when I mention related service or keyword, I mean a title such as “Financial Planning”</p>
                                        <p>Supportive text goes here. Above when I mention related service or keyword, I mean a title such as “Financial Planning” Supportive text goes here. Above when I mention related service or keyword, I mean a title such as “Financial Planning”</p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4" data-panel="grey" data-col="service-panel">
                                    <div class="panel-content">
                                        <h3>Financial Planning</h3>
                                        <p>Supportive text goes here. Above when I mention related service or keyword, I mean a title such as “Financial Planning”</p>
                                        <p>Supportive text goes here. Above when I mention related service or keyword, I mean a title such as “Financial Planning” Supportive text goes here. Above when I mention related service or keyword, I mean a title such as “Financial Planning”</p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4" data-panel="grey" data-col="service-panel">
                                    <div class="panel-content">
                                        <h3>Financial Planning</h3>
                                        <p>Supportive text goes here. Above when I mention related service or keyword, I mean a title such as “Financial Planning”</p>
                                        <p>Supportive text goes here. Above when I mention related service or keyword, I mean a title such as “Financial Planning” Supportive text goes here. Above when I mention related service or keyword, I mean a title such as “Financial Planning”</p>
                                    </div>
                                </div>
                            </div>

                            <h2>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod.</h2>
                            <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum. Lorem ipsum dolor sit amet, consetetur sadipscing elitr.</p>
                            <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum. Lorem ipsum dolor sit amet, consetetur sadipscing elitr. labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.</p>

                            <div class="row">
                                <div class="col-md-12">
                                    <h3>Meet the Staff</h3>
                                </div>
                                <?php echo do_shortcode('[consultants people="dave,mandy,johnny,sarah"]'); ?>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <h3>Download Brochures</h3>
                                </div>
                                <div class="col-md-12">
                                    <?php if( have_rows('brochures') ): ?>
                                        <ul class="brochures">
                                            <?php while( have_rows('brochures') ): the_row(); ?>
                                                <?php
                                                $file = get_sub_field('single_brochure');
                                                //var_dump($file);
                                                $icon = '<i class="fa fa-file-text-o"></i>';
                                                if($file['type'] === 'image') {
                                                    $icon = '<i class="fa fa-file-image-o"></i>';
                                                }
                                                if( $file ): ?>
                                                    <li>
                                                        <a href="<?php echo $file['url']; ?>" target="_blank"><?php echo $icon; ?> <?php echo $file['title']; ?></a>
                                                    </li>
                                                <?php endif; ?>
                                            <?php endwhile; ?>
                                        </ul>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="accordion">

                                <h3 data-accordion="title">Brochure File 2017</h3>
                                <div data-accordion="content">
                                    <p><em><strong>(7 per cent of gross monthly rent)</strong></em></p>
                                    <p>This full-service approach includes:</p>
                                    <ul>
                                        <li>Collection of rent and bill paying</li>
                                        <li>Detailed monthly income statements & invoices</li>
                                        <li>Support & coordinating of all maintenance & repairs</li>
                                        <li>Monitoring and coordination of fire safety devices</li>
                                        <li>Managing all calls, inquiries and emergency responses 24/7</li>
                                        <li>Coordination of any Renewal Leases (included in fee)</li>
                                        <li>Regular inspection of property</li>
                                        <li>Full support of Tenant relationships</li>
                                        <li>Assistance with Landlord & Tenant Tribunal Board</li>
                                        <li>Option: Monthly inspection report available to owners</li>
                                    </ul>
                                </div>
                                <h3 data-accordion="title">Advertise – Rent My House Package</h3>
                                <div data-accordion="content">
                                    <p><em><strong>(50 per cent of one month's rent)</strong></em></p>
                                    <p>Through our multiple advertising platforms, company website, and internal contacts, we will ensure that suitable tenants be found in a timely manner.</p>
                                    <p>Our 'Rent My House ' Package includes:</p>
                                    <ul>
                                        <li>LPM "For Lease" lawn sign</li>
                                        <li>Photos and write up of property on all advertising platforms</li>
                                        <li>Scheduling and showing all prospective tenants</li>
                                        <li>Ensuring proper application process</li>
                                        <li>Preparation of lease</li>
                                        <li>Collection of rent deposit</li>
                                    </ul>
                                </div>
                                <h3 data-accordion="title">Home Protection Package</h3>
                                <div data-accordion="content">
                                    <p>Let us ensure your home insurance stays valid with regular walk-throughs, inspections and a variety of services to help you manage, protect, and safeguard your home in your absence.</p>
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
