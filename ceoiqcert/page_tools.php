<?php
/**
 * Template Name: Tools
 *
 * The default full-width template
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Ferus_Core
 */

get_header();
$site_details = get_blog_details();
$site_slug = trim($site_details->path, '/');
?>

<?php
switch_to_blog(1);
$page = get_posts(
    array(
        'name'      => 'tools-resources',
        'post_type' => 'page'
    )
);
if ( $page ) {
    $post = $page[0];
}
?>
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
                <img class="featured-icon" src="<?php echo $image; ?>" width="105">
                <?php
                $customTitle = html_entity_decode( custom_header_content_get_meta('custom_header_content_title') );
                $customHeaderCont = html_entity_decode( custom_header_content_get_meta('custom_header_content_content') );
                ?>
                <?php if( $customTitle && $customHeaderCont ): ?>
                    <h1 class="page-title"><?php echo $customTitle; ?></h1>
                    <div class="header-subline"><?php echo $customHeaderCont; ?></div>
                <?php elseif( $customTitle && !$customHeaderCont ): ?>
                    <h1 class="page-title"><?php echo $customTitle; ?></h1>
                <?php elseif( !$customTitle && $customHeaderCont ): ?>
                    <?php the_title( '<h1 class="page-title">', '</h1>' ); ?>
                    <div class="header-subline"><?php echo $customHeaderCont; ?></div>
                <?php else : ?>
                    <?php the_title( '<h1 class="page-title">', '</h1>' ); ?>
                <?php endif; ?>
            </div>
        </div>
    </section>
<?php endif; ?>
<?php restore_current_blog(); ?>

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


<section id="primary" class="content-area">
    <main id="main" class="site-main container" role="main">


    <div class="row">
        <div class="col-md-6">
            <p>What you will find here is a collection of tools, including:</p>
            <ul>
                <li>Financial Analysis Calculators;</li>
                <li>Diagnostics from our Executive Coaching Program;</li>
                <li>Tools we use in Strategic Thinking Workshops;</li>
                <li>Planning and Analysis Tools;</li>
                <li>The CEOIQ<sup>&reg;</sup> ARETE Diagnostic, a starting place for ‘your story’; and,</li>
                <li>More...a continually growing ‘digital library’ of tools and resources that are our gift to you.</li>
            </ul>
        </div>
        <div class="col-md-6">
            <p>You’re invited to use anything you find here to strengthen your team, sharpen your financial skills, analyze your business or work on yourself.  We’ll keep growing the content here - so check back from time to time for new stuff you can use.</p>
            <p>Most of the Tools and Resources are completely free.  As we continue to develop this section of the CEOIQ<sup>&reg;</sup> website, we’re planning to add some exciting new digital books that you’ll have the opportunity to purchase separately.</p>
            <p>Please poke around here. Let us know what you’ve found useful.  Tell us what you’d like to see added.</p>
        </div>
    </div>

    <?php // load_template(get_theme_root() . '/ceoiq/template-parts/content-tools_resources.php'); ?>

    <div class="accordion">
        <h3 id="calculators" data-accordion="title"><i class="fa fa-calculator"></i> Calculators</h3>
        <div data-accordion="content">
            <?php echo do_shortcode('[ceoiq-resources cat="calculators" group="public"]'); ?>
            <?php echo do_shortcode( '[wlm_ismember]'.'[ceoiq-resources cat="calculators" group="'.$site_slug.'"]'.'[/wlm_ismember]' ); ?>
        </div><!-- END: calculators -->

        <h3 id="eBooks" data-accordion="title"><i class="fa fa-book"></i> eBooks</h3>
        <div data-accordion="content">
            <?php echo do_shortcode('[ceoiq-resources cat="ebooks" group="public"]'); ?>
            <?php echo do_shortcode( '[wlm_ismember]'.'[ceoiq-resources cat="ebooks" group="'.$site_slug.'"]'.'[/wlm_ismember]' ); ?>
        </div><!-- END: eBooks -->

        <h3 id="tools" data-accordion="title"><i class="fa fa-bar-chart-o"></i> Diagnostics & Tools</h3>
        <div data-accordion="content">
            <?php echo do_shortcode('[ceoiq-resources cat="tools" group="public"]'); ?>
            <?php echo do_shortcode( '[wlm_ismember]'.'[ceoiq-resources cat="tools" group="'.$site_slug.'"]'.'[/wlm_ismember]' ); ?>
        </div><!-- END: tools -->

        <h3 id="worksheets" data-accordion="title"><i class="fa fa-file-alt"></i> Worksheets</h3>
        <div data-accordion="content">
            <?php echo do_shortcode('[ceoiq-resources cat="worksheets" group="public"]'); ?>
            <?php echo do_shortcode( '[wlm_ismember]'.'[ceoiq-resources cat="worksheets" group="'.$site_slug.'"]'.'[/wlm_ismember]' ); ?>
        </div><!-- END: worksheets -->
        
        <h3 id="videos" data-accordion="title"><i class="fa fa-video-camera"></i> Videos</h3>
        <div data-accordion="content">
            <?php echo do_shortcode('[ceoiq-resources cat="videos" group="public"]'); ?>
            <?php echo do_shortcode( '[wlm_ismember]'.'[ceoiq-resources cat="videos" group="'.$site_slug.'"]'.'[/wlm_ismember]' ); ?>
        </div><!-- END: videos -->

    </div><!-- .accordion -->












    </main><!-- #main -->
</section><!-- #primary -->

<?php while (have_posts()) : the_post(); ?>
    <?php // the_content(); ?>
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
