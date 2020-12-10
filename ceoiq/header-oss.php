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
$invite_q = get_query_var('ossinvite');
$inviteClass = 'oss-dashboard';
if($invite_q === '1') {
    $inviteClass = 'oss-invites';
}
?>

<body <?php body_class($inviteClass); ?>>

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
            <?php
            global $post;
            if (is_page_template('page_survey-dashboard.php')) {
                $company_slug = $post -> post_name;
            } else if (is_page_template('page_survey-results.php')) {
                $post_data = get_post($post->post_parent);
                $company_slug = $post_data->post_name;
            }
            $dashboard_url = home_url('/oss/') . $company_slug;
            $invites_url = home_url('/oss/') . $company_slug . '/?ossinvite=1';
            $survey_url = home_url('/oss/') . $company_slug . '/survey';
            $questions_url = home_url('/oss/') . $company_slug . '/?ossquestions=1';
            //$baseline_url = home_url() . '/wp-content/themes/ceoiq/inc/oss/Baseline-sheet-2019.03.05.xls';
            $benchmark_url = 'https://docs.google.com/spreadsheets/d/12oSHHMAcwv91qL1LPEtkEtKCOVf3fii0f2WlDn3p2NE/edit#gid=1115924557';
            ?>
            <ul id="primary" class="nav navbar-nav">
                <li id="" class="menu-item"><a href="<?php echo $dashboard_url; ?>">Dashboard</a></li>
                <li id="" class="menu-item"><a href="<?php echo $invites_url; ?>">Survey Invites</a></li>
                <li id="" class="menu-item"><a href="<?php echo $questions_url; ?>">Survey Questions</a></li>
                <li id="" class="menu-item"><a href="<?php echo $benchmark_url; ?>" target="_blank">Historical Benchmarks</a></li>
                <li id="" class="menu-item tutorial-trigger"><a href="<?php echo $dashboard_url . '?welcome=1'; ?>">Tutorial</a></li>
            </ul>
        </nav>
    </div>
</div><!-- .menu-wrap -->

<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e('Skip to content', 'bright_light'); ?></a>

    <header id="masthead" class="site-header" role="banner">

        <div class="header-inner">
            <div class="container">
                <h1 id="logo">
                    <a href="<?php echo $dashboard_url; ?>" rel="dashboard">
                        <img src="<?php echo $logoIMG; ?>" width="200"><span><?php bloginfo('name'); ?></span>
                    </a>
                </h1>
            </div><!-- .container -->
        </div><!-- .header-inner -->
    </header><!-- #masthead -->

    <div id="content" class="site-content">
