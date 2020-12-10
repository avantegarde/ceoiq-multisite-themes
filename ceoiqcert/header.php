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
if ( is_front_page() || is_page('contact') ) {
    $logoIMG = get_template_directory_uri() . '/inc/images/logo-notag.png';
} else if ( is_page('digital-leadership-labs') || preg_match( '#^digital-leadership-labs(/.+)?$#', $wp->request ) ) {
    $logoIMG = get_template_directory_uri() . '/inc/images/logo-dll.png';
} else if ( is_page('peer-groups') ) {
    $logoIMG = get_template_directory_uri() . '/inc/images/logo-pag.png';
}
?>

<body <?php body_class(); ?>>

<div class="floating-button">
    <div class="container">
        <button type="button" id="menu-toggle" class="navbar-toggle">
            <span class="sr-only">Toggle navigation</span>
            <div class="menu-icon">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </div>
            <span class="menu-label">Menu</span>
        </button>
    </div>
</div>

<div id="menu-float">
    <div id="main-menu" class="">
        <nav class="navbar navbar-default">
            <!-- Collect the nav links, forms, and other content for toggling -->
            <?php
            $default_menu = array(
                'theme_location' => 'menu-1',
                'container' => false,
                'menu_class' => 'nav navbar-nav',
                'menu_id' => 'primary'
            );
            $member_menu = array(
                'menu' => 'member-menu',
                'theme_location' => 'menu-1',
                'container' => false,
                'menu_class' => 'nav navbar-nav',
                'menu_id' => 'primary'
            );
            if(is_user_logged_in()){
                $selected_menu = $member_menu;
            } else {
                $selected_menu = $default_menu;
            }
            wp_nav_menu($selected_menu);
            ?>
        </nav>
        <!-- Toolbar Mobile -->
        <?php if ( is_active_sidebar( 'toolbar' ) ) : ?>
            <aside id="toolbar-mobile" class="widget-area" role="complementary">
                <?php dynamic_sidebar( 'toolbar' ); ?>
            </aside>
        <?php endif; ?>
    </div>
</div><!-- .menu-wrap -->

<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e('Skip to content', 'bright_light'); ?></a>

    <header id="masthead" class="site-header" role="banner">

        <div class="header-inner">
            <div class="container">
                <h1 id="logo">
                    <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                        <img src="<?php echo $logoIMG; ?>" width="200"><span><?php bloginfo('name'); ?></span>
                    </a>
                </h1>
                <!-- Toolbar -->
                <?php if ( is_active_sidebar( 'toolbar' ) ) : ?>
                    <aside id="toolbar" class="widget-area" role="complementary">
                        <?php dynamic_sidebar( 'toolbar' ); ?>
                    </aside>
                <?php endif; ?>
                <!-- <div class="header-search">
                    <form role="search" method="get" class="search" action="<?php echo esc_url(home_url('/')); ?>">
                        <label for="search_text"><i class="fa fa-search"></i></label>
                        <input type="text" class="search-text" id="search_text" placeholder="Site Search" value="" name="s" title="Search...">
                    </form>
                </div> -->
            </div><!-- .container -->
        </div><!-- .header-inner -->
    </header><!-- #masthead -->

    <div id="content" class="site-content">
