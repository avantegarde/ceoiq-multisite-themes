<?php
/**
 * Template Name: Company Survey
 * Template Post Type: ceoiq_surveys
 * The template for the survey form
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Ferus_Core
 */
get_header('survey'); ?>
<?php // Survey variables
global $wp;
$parentID = wp_get_post_parent_id( $post->ID );
$formID = get_field('survey_form_id', $post->post_parent);
$company_name = get_the_title($parentID);
$tier_survey_link = home_url( $wp->request ) . '/survey';
?>

<?php
$feat_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );
$image = $feat_image[0] ? '<img class="featured-icon" src="' . $feat_image[0] . '" width="105">' : '<img class="featured-icon" src="/wp-content/uploads/2017/10/icon-workshops.png" width="105">';
?>
<section id="page-header" class="content-center normal">
    <div class="container">
        <div class="header-content">
            <?php echo $image; ?>
            <?php the_title( '<h1 class="page-title">', '</h1>' ); ?>
            <div class="header-subline"><?php echo $company_name; ?></div>
        </div>
    </div>
</section>

<!-- Page Top Widgets -->
<?php if ( is_active_sidebar( 'page-top' ) ) : ?>
    <!-- <section id="page-top" class="widget-area" role="complementary">
        <?php // dynamic_sidebar( 'page-top' ); ?>
    </section> -->
<?php endif; ?>

<!-- Inner Top Widgets -->
<?php if ( is_active_sidebar( 'inner-top' ) ) : ?>
    <!-- <section id="inner-top" class="widget-area" role="complementary">
        <?php // dynamic_sidebar( 'inner-top' ); ?>
    </section> -->
<?php endif; ?>

<?php while (have_posts()) : the_post(); ?>
    <section id="primary" class="content-area survey-content">
        <main id="main" class="site-main container" role="main">
            <div class="row">
                <div class="col-md-12">
                    <?php //START: pw protection
                    if ( post_password_required() ) : ?>
                        <div class="wppw-form">
                            <?php the_content(); ?>
                        </div>
                    <?php else : ?>

                        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                            <div class="entry-content">
                                <?php echo do_shortcode('[gravityform id="'. $formID .'" title="false" description="false" ajax="false" tabindex="99"]'); ?>
                            </div><!-- .entry-content -->
                        </article><!-- #post-## -->

                    <?php endif; //END: pw protection ?>
                </div>
            </div>
        </main><!-- #main -->
    </section><!-- #primary -->
<?php endwhile; // End of the loop. ?>

<!-- Inner Bottom Widgets -->
<?php if ( is_active_sidebar( 'inner-bottom' ) ) : ?>
    <!-- <section id="inner-bottom" class="widget-area" role="complementary">
        <?php // dynamic_sidebar( 'inner-bottom' ); ?>
    </section> -->
<?php endif; ?>

<!-- Page Bottom Widgets -->
<?php if ( is_active_sidebar( 'page-bottom' ) ) : ?>
    <!-- <section id="page-bottom" class="widget-area" role="complementary">
        <?php // dynamic_sidebar( 'page-bottom' ); ?>
    </section> -->
<?php endif; ?>

<?php // get_footer(); ?>

</div><!-- #content -->

<!-- Banner Bottom Widgets -->
<?php if ( is_active_sidebar( 'banner-bottom' ) ) : ?>
    <?php // dynamic_sidebar( 'banner-bottom' ); ?>
<?php endif; ?>

<footer id="colophon" class="site-footer center" role="contentinfo">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <p class="copyright">
                    <?php echo 'Copyright &copy; ' . date('Y') . ' - ' . get_bloginfo( 'name' ); ?> <span class="hidden-xs">| </span><span class="hidden-sm"><br></span><a href="/terms-of-use/">Terms of Use</a> | <a href="/privacy-policy/">Privacy Policy</a>
                </p>
            </div>
        </div>
    </div><!-- .inner -->
</footer><!-- #colophon -->

</div><!-- #page -->

<?php wp_footer(); ?>
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri() . '/js/EQCSS-polyfills.min.js'?>"></script><![endif]-->
</body>
</html>

