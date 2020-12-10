<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Ferus_Core
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, minimal-ui" />
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

<?php
$logoIMG = get_template_directory_uri() . '/inc/images/logo.png';
?>

<body <?php body_class(); ?>>

<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e('Skip to content', 'bright_light'); ?></a>

    <header id="masthead" class="site-header" role="banner">

        <div class="header-inner">
            <div class="container">
                <h1 id="logo">
                    <a href="#" rel="home">
                        <img src="<?php echo $logoIMG; ?>" width="200"><span><?php bloginfo('name'); ?></span>
                    </a>
                </h1>
            </div><!-- .container -->
        </div><!-- .header-inner -->
    </header><!-- #masthead -->

    <div id="content" class="site-content">
