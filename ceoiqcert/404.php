<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Ferus_Core
 */

get_header(); ?>

    <section id="page-header" class="tall" style="background-image:url(<?php echo get_template_directory_uri() . '/inc/images/hero.jpg'; ?>);">
        <div class="container v-align">
            <div class="header-content v-inner">
                <h1 class="page-title">Whoops!<br>That page can&rsquo;t be found</h1>
            </div>
        </div>
    </section>

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

    <section id="primary" class="error-404 content-area">
        <main id="main" class="site-main container" role="main">

            <article class="page">
                <div class="entry-content">
                    <?php if ( is_active_sidebar( 'four-oh-four' ) ) : ?>
                        <?php dynamic_sidebar( 'four-oh-four' ); ?>
                    <?php else : ?>
                        <div class="center">
                            <p><strong>It looks like nothing was found at this location.</strong></p>
                            <p>Maybe try one of the links below or head <a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><i class="fa fa-home" aria-hidden="true"></i> Home</a>?</p>
                            <?php
                            $defaults = array(
                                'theme_location' => 'menu404',
                                'container' => false,
                                'menu_class' => 'icon-list default-cont',
                                'fallback_cb' => false
                            );
                            wp_nav_menu($defaults);
                            ?>
                        </div>
                    <?php endif; ?>
                </div><!-- .entry-content -->
            </article><!-- #post-## -->

        </main><!-- #main -->
    </section><!-- #primary -->

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
