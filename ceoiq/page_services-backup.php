<?php
/**
 * Template Name: Backup - Services
 *
 * The default page for services
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Ferus_Core
 */

get_header(); ?>

<?php while (have_posts()) : the_post(); ?>

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
        <section id="page-header" class="<?php echo $contentLocation; ?> <?php echo strtolower($bannerHeight) ?> <?php echo $bg_class; ?>" style="background-image:url(<?php echo $image; ?>);">
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

    <div class="container">

        <!-- Page Top Widgets -->
        <?php if ( is_active_sidebar( 'page-top' ) ) : ?>
            <section id="page-top" class="widget-area" role="complementary">
                <?php dynamic_sidebar( 'page-top' ); ?>
            </section>
        <?php endif; ?>

        <div class="row">

            <div id="primary" class="content-area page-body col-md-12">

                <!-- Inner Top Widgets -->
                <?php if ( is_active_sidebar( 'inner-top' ) ) : ?>
                    <section id="inner-top" class="widget-area" role="complementary">
                        <?php dynamic_sidebar( 'inner-top' ); ?>
                    </section>
                <?php endif; ?>

                <main id="main" class="site-main" role="main">

                    <!-- BreadCrumbs -->
                    <?php
                    if (function_exists('yoast_breadcrumb')) {
                        yoast_breadcrumb('<div id="breadcrumbs" class="col-md-12">', '</div>');
                    }
                    ?>

                    <!-- Tab Slider -->
                    <section data-reveal="fadeInDown">
                        <div class="tab-slider-wrap left-nav panel">
                            <div class="tab-slider" data-col="tab-slider">
                                <div class="v-align" style="background-image:url(<?php echo get_template_directory_uri(); ?>/inc/images/home-slide-01.jpg);">
                                    <div class="slide-caption v-inner">
                                        <h3 class="sub-title">Web & Mobile Design</h3>
                                        <p>With properly executed web design and development, FerusMedia can help you engage with your target audience effectively while increasing your brand awareness and meeting your business objectives.</p>
                                        <p>Websites give your business credibility and allow you to show off your expertise. FerusMedia will help you gain valuable exposure not only through the synchronization of your website, but also through search engine listings like Google, and social media networks.</p>
                                        <p>We know running a successful company is time-consuming, so give yourself a bit of a break. Allow our team to keep your Internet presence alive and well while you focus on developing and expanding your business.</p>
                                        <a href="#" data-button>Get In Touch</a>
                                    </div>
                                </div>
                                <div class="v-align" style="background-image:url(<?php echo get_template_directory_uri(); ?>/inc/images/home-slide-02.jpg);">
                                    <div class="slide-caption v-inner">
                                        <h3 class="title"><a href="#">Make connections with new customers and keep current clients coming back for more…and more!</a></h3>
                                        <p class="subline">Use me as a starting point for all your projects!</p>
                                        <p><a href="#" data-button>Discover More</a></p>
                                    </div>
                                </div>
                                <div class="v-align" style="background-image:url(<?php echo get_template_directory_uri(); ?>/inc/images/home-slide-03.jpg);">
                                    <div class="slide-caption v-inner">
                                        <h3 class="title"><a href="#">This is an easy two-step process we think you’ll love: First, you connect with clients. Then (in no time at all!), you make more money.</a></h3>
                                        <p><a href="#" data-button>Discover More</a></p>
                                    </div>
                                </div>
                                <div class="v-align" style="background-image:url(<?php echo get_template_directory_uri(); ?>/inc/images/home-slide-03.jpg);">
                                    <div class="slide-caption v-inner">
                                        <h3 class="title"><a href="#">Easily gain valuable industry insights, see what’s trending and get expert tips.</a></h3>
                                        <p class="subline">Use me as a starting point for all your projects!</p>
                                        <p><a href="#" data-button>Discover More</a></p>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-slider-nav" data-col="tab-slider">
                                <div class="tab-nav-item active" data-slide="0">
                                    <h3 class="tab-label">Web & Mobile Design</h3>
                                </div>

                                <div class="tab-nav-item" data-slide="1">
                                    <h3 class="tab-label">E-Commerce Development</h3>
                                </div>

                                <div class="tab-nav-item" data-slide="2">
                                    <h3 class="tab-label">Search Engine Optimization (SEO)</h3>
                                </div>

                                <div class="tab-nav-item" data-slide="3">
                                    <h3 class="tab-label">Web & Mobile App Development</h3>
                                </div>

                                <div class="tab-nav-item" data-slide="4">
                                    <h3 class="tab-label">Advanced Mobile App Development</h3>
                                </div>

                                <div class="tab-nav-item" data-slide="5">
                                    <h3 class="tab-label">Our Process</h3>
                                </div>

                            </div><!-- .tab-slider-nav -->
                        </div><!-- .tab-slider-wrap -->
                    </section>


                    <section data-reveal="slideInLeft">
                        <div class="panel">
                            <?php echo do_shortcode('[content-slider posts="4" category="new-cat"]');?>
                        </div>
                    </section>

                    <section data-reveal="slideInRight">
                        <div class="panel">
                            <?php echo do_shortcode('[portfolio-slider posts="4" content="left"]');?>
                        </div>
                    </section>

                    <section class="services-grid">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="panel-hover" data-reveal="fadeInLeft">
                                    <img src="http://placehold.it/600x400">
                                    <div class="hover-content v-align">
                                        <div class="v-inner">
                                            <h3 class="title">Print</h3>
                                            <i class="fa fa-print"></i>
                                            <p>Connect with your customer and draw in new clients with unique design concepts that are tailored for your business.</p>
                                            <a href="#" data-button>Visit</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="panel-hover" data-reveal="fadeInRight">
                                    <img src="http://placehold.it/600x400">
                                    <div class="hover-content v-align">
                                        <div class="v-inner">
                                            <h3 class="title">Branding</h3>
                                            <i class="fa fa-android"></i>
                                            <p>Create strong, authoritative branding strategies to guarantee that your company image is parallel to customer interests.</p>
                                            <a href="#" data-button>Visit</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="panel-hover" data-reveal="fadeInLeft">
                                    <img src="http://placehold.it/600x400">
                                    <div class="hover-content v-align">
                                        <div class="v-inner">
                                            <h3 class="title">Marketing</h3>
                                            <i class="fa fa-line-chart"></i>
                                            <p>Identify strengths, weaknesses, opportunities, and threats before impulsively making decisions that may not be profitable.</p>
                                            <a href="#" data-button>Visit</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="panel-hover" data-reveal="fadeInRight">
                                    <img src="http://placehold.it/600x400">
                                    <div class="hover-content v-align">
                                        <div class="v-inner">
                                            <h3 class="title">Content Management</h3>
                                            <i class="fa fa-edit"></i>
                                            <p>Creative content that is aligned with your branding to capture the attention of your most lucrative audiences.</p>
                                            <a href="#" data-button>Visit</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- .row -->
                    </section>

                    <?php //get_template_part('template-parts/content', 'page'); ?>

                    <?php // If comments are open or we have at least one comment, load up the comment template.
                    /*if (comments_open() || get_comments_number()) :
                        comments_template();
                    endif;*/ ?>

                </main><!-- #main -->

                <!-- Inner Bottom Widgets -->
                <?php if ( is_active_sidebar( 'inner-bottom' ) ) : ?>
                    <section id="inner-bottom" class="widget-area" role="complementary">
                        <?php dynamic_sidebar( 'inner-bottom' ); ?>
                    </section>
                <?php endif; ?>

            </div><!-- #primary -->

        </div><!-- .row -->

        <!-- Page Bottom Widgets -->
        <?php if ( is_active_sidebar( 'page-bottom' ) ) : ?>
            <section id="page-bottom" class="widget-area" role="complementary">
                <?php dynamic_sidebar( 'page-bottom' ); ?>
            </section>
        <?php endif; ?>

    </div><!-- .container -->

<?php endwhile; // End of the loop. ?>

<?php
get_footer();
