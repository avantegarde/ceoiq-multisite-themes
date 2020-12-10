<?php
/**
 * Template Name: Home Splash Page
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Ferus_Core
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, minimal-ui"/>
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico"/>

    <?php wp_head(); ?>

    <!-- Google Analytics -->
    <!-- <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','https://www.google-analytics.com/analytics.js','__gaTracker');

        __gaTracker('create', 'UA-xxxxxxxx-x', 'auto');
        __gaTracker('send', 'pageview');
    </script> -->
</head>

<body id="splash" <?php body_class(); ?>>
<header id="splash-header">
    <h1 id="logo">
        <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
            <img src="<?php echo get_template_directory_uri() . '/inc/images/logo-dark.png'; ?>" width="200"><span><?php bloginfo('name'); ?></span>
        </a>
    </h1>
</header>

<div id="splash-page" class="site">

    <section id="primary" class="content-area" role="main">

        <video poster="<?php echo get_template_directory_uri(); ?>/inc/video/bg-video.jpg" id="bgvid" playsinline autoplay muted loop>
            <source src="<?php echo get_template_directory_uri(); ?>/inc/video/bg-video.webm" type="video/webm">
            <source src="<?php echo get_template_directory_uri(); ?>/inc/video/bg-video.mp4" type="video/mp4">
        </video>

        <div class="splash-content">
            <div class="splash-inner">
                <?php while (have_posts()) : the_post(); ?>
                    <?php echo the_content(); ?>
                <?php endwhile; ?>
            </div>
        </div>

    </section><!-- #primary -->

</div><!-- #splash-page -->

<footer id="colophon" class="site-footer" role="contentinfo">
    <div class="inner">
        <p class="copyright">&copy; <?php echo date("Y") . ' ' . get_bloginfo( 'name' ); ?></p>
    </div><!-- .inner -->
</footer><!-- #colophon -->

<?php wp_footer(); ?>
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri() . '/js/EQCSS-polyfills.min.js'?>"></script><![endif]-->
</body>
</html>

