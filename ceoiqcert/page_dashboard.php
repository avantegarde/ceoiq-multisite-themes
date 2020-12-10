<?php
/**
 * Template Name: CERT Dashboard
 *
 * The default full-width template
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Ferus_Core
 */

get_header();

$user = wp_get_current_user();
$user_name = $user->display_name;
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
    $image = $feat_image[0] ? '<img class="featured-icon" src="' . $feat_image[0] . '" width="105">' : '';
    $bg_class = $feat_image[0] ? '' : 'bg-repeat-light';
    $contentLocation = custom_header_content_get_meta('custom_header_content_location') ? custom_header_content_get_meta('custom_header_content_location') : 'content-center';
    ?>
    <section id="page-header" class="<?php echo $contentLocation; ?> <?php echo strtolower($bannerHeight) ?>">
        <div class="container">
            <div class="header-content">
                <?php echo $image; ?>
                <?php
                $customTitle = html_entity_decode( custom_header_content_get_meta('custom_header_content_title') );
                $customHeaderCont = html_entity_decode( custom_header_content_get_meta('custom_header_content_content') );
                ?>
                <?php if( $customTitle && $customHeaderCont ): ?>
                    <h1 class="page-title"><?php echo $customTitle; ?></h1>
                    <div class="header-subline">
                      <h2>Welcome <span class="green"><?php echo $user_name; ?></span>!</h2>
                      <p><?php echo $customHeaderCont; ?></p>
                    </div>
                <?php elseif( $customTitle && !$customHeaderCont ): ?>
                    <h1 class="page-title"><?php echo $customTitle; ?></h1>
                    <div class="header-subline">
                      <h2>Welcome <span class="green"><?php echo $user_name; ?></span>!</h2>
                    </div>
                <?php elseif( !$customTitle && $customHeaderCont ): ?>
                    <?php the_title( '<h1 class="page-title">', '</h1>' ); ?>
                    <div class="header-subline">
                      <h2>Welcome <span class="green"><?php echo $user_name; ?></span>!</h2>
                      <p><?php echo $customHeaderCont; ?></p>
                    </div>
                <?php else : ?>
                    <?php the_title( '<h1 class="page-title">', '</h1>' ); ?>
                    <div class="header-subline">
                      <h2>Welcome <span class="green"><?php echo $user_name; ?></span>!</h2>
                    </div>
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
        <main id="main" class="site-main" role="main">

            <?php // the_content(); ?>

            <section id="dashboard-grid" class="services-grid blank">
              <div class="container">
                  <div class="row">
                      <div class="col-sm-6 col-md-4 item">
                          <div class="inner" data-col="homeservices">
                              <span class="icon"><img src="/wp-content/themes/ceoiq/inc/images/icon-programs.png" width="100"></span>
                              <h2>Meeting Check-In</h2>
                              <a href="<?php echo site_url('/check-in'); ?>" data-button>Check-In Now</a>
                          </div>
                      </div>
                      <div class="col-sm-6 col-md-4 item">
                          <div class="inner" data-col="homeservices">
                              <span class="icon"><img src="/wp-content/themes/ceoiq/inc/images/icon-workshops.png" width="100"></span>
                              <h2>Meetings</h2>
                              <a href="<?php echo site_url('/meetings'); ?>/meetings/" data-button>View</a>
                          </div>
                      </div>
                      <div class="col-sm-6 col-md-4 item">
                          <div class="inner" data-col="homeservices">
                              <span class="icon"><img src="/wp-content/themes/ceoiq/inc/images/icon-leadership.png" width="100"></span>
                              <h2>Speakers</h2>
                              <a href="<?php echo site_url('/speakers'); ?>/speakers/" data-button>View</a>
                          </div>
                      </div>
                      <div class="col-sm-6 col-md-4 item">
                          <div class="inner" data-col="homeservices">
                              <span class="icon"><img src="/wp-content/themes/ceoiq/inc/images/icon-advisory.png" width="100"></span>
                              <h2>Group Roster</h2>
                              <a href="<?php echo site_url('/group-roster'); ?>/group-roster/" data-button>View</a>
                          </div>
                      </div>
                      <div class="col-sm-6 col-md-4 item">
                          <div class="inner" data-col="homeservices">
                              <span class="icon"><img src="/wp-content/themes/ceoiq/inc/images/icon-tools.png" width="100"></span>
                              <h2>Tools & Resources</h2>
                              <a href="<?php echo site_url('/tools-resources'); ?>/tools-resources/" data-button>Learn More</a>
                          </div>
                      </div>
                      <div class="col-sm-6 col-md-4 item">
                          <div class="inner" data-col="homeservices">
                              <span class="icon"><img src="/wp-content/themes/ceoiq/inc/images/icon-coaching.png" width="100"></span>
                              <h2>Your Profile</h2>
                              <a href="<?php echo site_url('/account'); ?>/account/" data-button>Edit</a>
                          </div>
                      </div>

                  </div><!-- .row -->
              </div><!-- .container -->
          </section>

          <section id="featured-articles" class="narrow">
              <div class="container center">
                  <h3 class="section-title">Featured Articles</h3>
              </div>
              <?php echo do_shortcode('[must-reads posts="4" category="featured"]'); ?>
          </section>

            
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



<style>
section#primary {
  padding: 0;
  min-height: 100vh;
}
/*--- Tabs ---*/
.tabs-wrap {
  display: block;
  width: 100%;
  max-width: 100%;
  margin: 0;
  padding: 0;
}
.tabs-wrap:after {
  content: "";
  display: block;
  clear:both;
}
.tabs-wrap ul.tabs-menu {
  display: block;
  float: left;
  clear: both;
  list-style: none;
  padding: 15px 15px 0px 15px;
  margin: 0;
  margin-bottom: -1px !important;
  width: 100%;
}
.tabs-wrap .tabs-menu li {
  line-height: 50px;
  float: left;
  padding: 0 !important;
  margin-right: 10px;
  background-color: #eaeaea;
  border: 1px solid #cccccc;
  border-bottom: 1px solid transparent;
  transition: all 0.3s ease-in-out;
  -moz-transition: all 0.3s ease-in-out;
  -webkit-transition: all 0.3s ease-in-out;
}
.tabs-menu li:hover {
  background-color: #ffffff;
}
.tabs-menu li.current {
  position: relative;
  background-color: #fff;
  border-bottom: 1px solid #fff;
  z-index: 5;
}
.tabs-menu li a {
  padding: 15px 20px;
  text-decoration: none; 
}
.tabs-menu li:hover a,
.tabs-menu li.current a {
  color: #000000;
}
.tabs-wrap .tab-content {
  border: 1px solid #d4d4d1;
  background-color: #fff;
  float: left;
  margin-bottom: 20px;
  width: 100%;
}
.tabs-wrap .tab-content > div {
  padding: 30px 20px;
  display: none;
}
.tabs-wrap .tab-content > div > * {
  margin-top: 0;
}
.tab-title {
  display: block;
  font-size: 32px;
  line-height: 34px;
  font-weight: bold;
  text-align: center;
  margin: 0 0 20px 0;
  padding: 0 0 10px 0;
  border-bottom: 3px solid #069e24;
  color: #000000;
}
@media screen and (max-width: 600px) {
  .tabs-menu li {
    width: 100%;
    max-width: 100%;
  }
  .tabs-menu li a {
    width: 100%;
    display: block;
    line-height: 2;
  }
}
@media screen and (max-width: 500px) {
  .tabs-menu li {
    width: 100%;
  }
}
/*--- Checkin Form ---*/
ul.gform_fields > li > label {
  display: block;
  width: 100%;
  font-size: 24px;
  line-height: 26px;
  font-weight: bold;
  margin: 0 0 10px 0;
  padding: 10px;
  border: 1px solid #cccccc;
  color: #069e24;
  background: #eaeaea;
}
.gfield.feelings ul.gfield_radio {
  display: block;
  margin: 0;
  padding: 0;
}
.gfield.feelings ul.gfield_radio li {
  display: inline-block;
  margin: 0;
  padding: 0;
}
.gfield.feelings ul.gfield_radio li input {
  display: none;
}
.gfield.feelings ul.gfield_radio li label {
  text-align: center;
  padding: 5px;
}
.gfield.feelings ul.gfield_radio li label img {
  display: block;
  width: 100%;
  height: auto;
  opacity: 0.25;
  transition: all 0.3s ease-in-out;
  -webkit-transition: all 0.3s ease-in-out;
}
.gfield.feelings ul.gfield_radio li input:checked+label img,
.gfield.feelings ul.gfield_radio li label:hover img {
  opacity: 1;
}
.gfield.feelings ul.gfield_radio li label span {
  display: block;
}
form .gform_footer {
  text-align: center;
}
.gform_wrapper .gform_footer input.gform_button {
  font-size: 125% !important;
}
/*--- Results Slider NAV ---*/
.checkin-results-nav {
  width: 250px;
  margin: auto;
}
.checkin-results-nav h3 {
  text-align: center;
}
/*----------------------*/
/*--- Results Slider ---*/
/*----------------------*/
.checkin-results-slider .entries-slide > div {
  display: block;
  margin-left: 20px;
  border-bottom: 1px solid #cccccc;
}
/* Emote Entry */
.checkin-results-slider .qid-3 > p,
.checkin-results-slider .qid-4 > p,
.checkin-results-slider .qid-5 > p {
  display: block;
  width: 50px;
  font-weight: bold;
  text-align: center;
}
/* Entry Name */
.checkin-results-slider .entries-slide .qid-17 {
  margin-left: 0;
  border-bottom: none;
}
.checkin-results-slider .qid-17 h4 {
  display: none;
}
.checkin-results-slider .qid-17 p {
  display: block;
  font-size: 24px;
  line-height: 26px;
  font-weight: bold;
  margin: 10px 0;
  padding: 10px;
  border: 1px solid #cccccc;
  color: #069e24;
  background: #eaeaea;
}
/*--------------------*/
/*--- Member Goals ---*/
/*--------------------*/
.users-goals-wrap .member-goals {
  display: block;
  width: 100%;
  margin: 0;
  padding: 0 0 30px 0;
}
.users-goals-wrap .member-goals .member-header {
  display: block;
  width: 100%;
  margin: 0;
  padding: 0 0 10px 0;
  clear: both;
}
.users-goals-wrap .member-goals .member-header:after {
  content: "";
  display: block;
  clear: both;
}
.users-goals-wrap .member-goals img.avatar {
  display: block;
  width: 96px;
  height: 96px;
  float: left;
  border: 1px solid #cccccc;
  background: #eaeaea;
}
.users-goals-wrap .member-goals .member-title {
  display: block;
  width: calc(100% - 96px);
  float: left;
  font-size: 24px;
  line-height: 26px;
  font-weight: bold;
  margin: 0;
  padding: 10px;
  border: 1px solid #cccccc;
  border-left: none;
  color: #069e24;
  background: #eaeaea;
}
.users-goals-wrap .member-goals > p {
  display: block;
  width: 100%;
  margin: 0 0 10px 0;
  padding: 0 0 10px 0;
  border-bottom: 1px solid #cccccc;
}
</style>
<script>
jQuery(document).ready(function ($) {
    /**
     * Entry Results Slider Settings
     */
    function getSliderSettings(){
      return {
        infinite: true,
        dots: true,
        arrows: false,
        autoplay: false,
        speed: 1000,
        autoplaySpeed: 4000,
        fade: false,
        adaptiveHeight: true,
        asNavFor: '.checkin-results-nav'
      }
    }
    /**
     * Entry Results Month Controller Settings
     */
    function getSliderNavSettings(){
      return {
        infinite: true,
        dots: true,
        arrows: false,
        autoplay: false,
        speed: 1000,
        autoplaySpeed: 4000,
        fade: false,
        //adaptiveHeight: true,
        asNavFor: '.checkin-results-slider',
      }
    }
    /**
     * Tabs
     */
    $(".tabs-menu a").click(function(event) {
        event.preventDefault();
        $(this).parent().addClass("current");
        $(this).parent().siblings().removeClass("current");
        var tab = $(this).attr("href");
        $(".tab-content > div").not(tab).css("display", "none");
        $(tab).fadeIn();
        // re-initialize results sliders
        $('.checkin-results-slider').slick('unslick');
        $('.checkin-results-nav').slick('unslick');
        $('.checkin-results-slider').slick(getSliderSettings());
        $('.checkin-results-nav').slick(getSliderNavSettings());
    });
    /**
     * Inititalize Results Slider
     */
    $('.checkin-results-slider').slick(getSliderSettings());
    /**
     * Inititalize Results Month Controller
     */
    $('.checkin-results-nav').slick(getSliderNavSettings());
});// END document.ready
</script>

<?php
get_footer();
