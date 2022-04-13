<?php
/**
 * Template Name: Check In
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

            <?php // the_content(); ?>
                <h1 class="section-title center">Member Check In</h1>
                <br><br>
                <?php
                // date helpers
                $current_date = new DateTime('now');
                $current_m_y = $current_date->format('m-Y');
                $current_month = date('F');
                // Upcoming Meeting
                $upcoming_meeting = upcoming_meeting();
                $checkin_meetings = previous_meetings(6);
                if($upcoming_meeting) {
                  array_unshift($checkin_meetings, $upcoming_meeting);
                }
                // bool for showing/hiding checkin form
                $show_form = true;
                // get checkin form and fields
                $fid = get_field('checkin_form_id');
                $formID = $fid?$fid:1;
                $checkin_form = GFAPI::get_form($formID);
                $form_questions = $checkin_form['fields'];
                // Build array of previous 6 months
                $months = 6;
                $entry_dates = array();
                $dateTime1 = new DateTime('first day of this month');
                for ($i = 1; $i <= 6; $i++) {
                  $d1_string = $dateTime1->format('Y-m-d');
                  $d2_string = $dateTime1->format('Y-m-t');
                  $m_string = $dateTime1->format('F');
                  array_push($entry_dates, array('m'=>$m_string, '1'=>$d1_string, '2'=>$d2_string));
                  $dateTime1->modify('-1 month');
                }
                // Get entries for each individual month
                $entry_results = array();
                // Get entries for each individual meeting date
                foreach($checkin_meetings as $meeting){
                  $checkin_search_criteria = array(
                      'status'        => 'active',
                      /*'start_date' => $dates['1'],
                      'end_date' => $dates['2'],*/
                      'field_filters' => array(
                          'mode' => 'all',
                          array(
                              'key'   => '18',
                              'value' => $meeting['meeting_date']
                          ),
                      )
                  );
                  $sorting = null;
                  $paging = array(
                      'offset' => 0,
                      'page_size' => 50
                  );
                  $total_count = null;
                  $checkin_entries = GFAPI::get_entries($formID, $checkin_search_criteria, $sorting, $paging, $total_count);
                  array_push($entry_results, array('m'=>$dates['m'], 'entries'=>$checkin_entries));

                  //check for existing entry this month
                  foreach($checkin_entries as $entry){
                    //$entry_name = $entry['17'];
                    $entry_name = $entry['19'];
                    $entry_checkin_date = $entry['18'];
                    $entry_month_year = date('m-Y', strtotime($entry['date_created']));
                    if ($user_name === $entry_name && $entry_checkin_date === $upcoming_meeting['meeting_date']) {
                      $show_form = false;
                      $no_form_message = "Thanks for checking in! Time to sit back and relax until it's meeting time.";
                    } elseif (!$upcoming_meeting) {
                      $show_form = false;
                      $no_form_message = "There is currently no meeting scheduled. Please check back later.";
                    }
                  }
                }// END: Get entries for each individual month
                ?>

                <div class="tabs-wrap">
                    <ul class="tabs-menu">
                        <li class="current"><a data-toggle="tab" href="#month-checkin">Meeting Check-In</a></li>
                        <li><a data-toggle="tab" href="#member-checkin">Check-In Results</a></li>
                        <li><a data-toggle="tab" href="#member-goals">Member Goals</a></li>
                    </ul>
                    <div class="tab-content">
                        <div id="month-checkin" style="display:block;">
                            <h2 class="tab-title">Check-In</h2>
                            <?php if($show_form) {
                              echo do_shortcode('[gravityform id="'.$formID.'" title="false" description="false" ajax="false" tabindex="99" field_values="checkin_meeting_date='.$upcoming_meeting['meeting_date'].'"]');
                            } else {
                              echo "<p class='center'>".$no_form_message."</p>";
                            } ?>
                        </div>
                        <div id="member-checkin">
                            <h2 class="tab-title">Check-In Results</h2>
                            <div class="checkin-results-nav">
                              <?php foreach($checkin_meetings as $entry_month) : ?>
                                <div>
                                  <h3><?php echo $entry_month['meeting_date']; ?></h3>
                                </div>
                              <?php endforeach; ?>
                            </div>
                            
                            <div class="checkin-results-slider">
                              <?php foreach($entry_results as $month) : ?>
                                <div class="entries-slide">
                                <?php if(count($month['entries']) > 0 ) : ?>
                                      <!-- <h2><?php //echo $month['m']; ?></h2> -->
                                      <?php foreach($month['entries'] as $entry) : ?>
                                          <?php foreach($form_questions as $question) : ?>
                                              <?php 
                                              //var_dump($entry);
                                              $qID = $question['id'];
                                              if($qID != 12 ) : ?>
                                                  <div class="qid-<?php echo $qID; ?>">
                                                      <h4><?php echo $question['label']; ?></h4>
                                                      <p><?php echo $entry[$qID]; ?></p>
                                                  </div>
                                              <?php endif; ?>
                                          <?php endforeach; ?>
                                          <br>
                                      <?php endforeach; ?>
                                <?php else : ?>
                                  <p class="center">No Entries found for this month.</p>
                                <?php endif; ?>
                                </div><!-- .entries-slide -->
                              <?php endforeach; ?>
                            </div><!-- .checkin-results-slider -->

                        </div><!-- #member-checkin -->
                        <div id="member-goals">
                            <h2 class="tab-title">Member Goals</h2>
                            <?php echo do_shortcode('[user-goals role="subscriber"]'); ?>
                        </div>
                    </div>
                </div><!-- .tabs-wrap -->

            
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
ul.gform_fields > li > label,
.gform_fields .gfield > .gfield_label {
  display: block !important;
  width: 100%;
  font-size: 18px !important;
  margin: 0 0 10px 0;
  padding: 10px !important;
  border: 1px solid #cccccc;
  color: #069e24;
  background: #eaeaea;
}
.gfield.feelings ul.gfield_radio,
.gfield.feelings .gfield_radio {
  display: block;
  margin: 0;
  padding: 0;
}
.gfield.feelings ul.gfield_radio li,
.gfield.feelings .gfield_radio .gchoice {
  display: inline-block;
  margin: 0;
  padding: 0;
}
.gfield.feelings ul.gfield_radio li input,
.gfield.feelings .gfield_radio .gchoice input {
  display: none;
}
.gfield.feelings ul.gfield_radio li label,
.gfield.feelings .gfield_radio .gchoice label {
  text-align: center;
  padding: 5px;
  max-width: 60px;
  cursor: pointer;
}
.gfield.feelings ul.gfield_radio li label img,
.gfield.feelings .gfield_radio .gchoice label img {
  display: block;
  width: 100%;
  height: auto;
  opacity: 0.25;
  transition: all 0.3s ease-in-out;
  -webkit-transition: all 0.3s ease-in-out;
}
.gfield.feelings ul.gfield_radio li input:checked+label img,
.gfield.feelings ul.gfield_radio li label:hover img,
.gfield.feelings .gfield_radio .gchoice input:checked+label img,
.gfield.feelings .gfield_radio .gchoice label:hover img {
  opacity: 1;
}
.gfield.feelings ul.gfield_radio li label span,
.gfield.feelings .gfield_radio .gchoice label span {
  display: block;
}
form .gform_footer {
  text-align: center;
}
.gform_wrapper .gform_footer input.gform_button {
  font-size: 125% !important;
}
.gform_wrapper .checkin-meeting-date input {
  border: none;
  color: #444444;
  font-weight: bold;
  pointer-events: none;
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
.checkin-results-slider .entries-slide .qid-17,
.checkin-results-slider .entries-slide .qid-19 {
  margin-left: 0;
  border-bottom: none;
}
.checkin-results-slider .qid-17 h4,
.checkin-results-slider .qid-19 h4 {
  display: none;
}
.checkin-results-slider .qid-17 p,
.checkin-results-slider .qid-19 p {
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
