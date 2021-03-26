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
$user_ID = $user->ID;
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

            <section id="dashboard-goals" class="dashboard-goals blank">
                <div class="container">
                    <h2 class="section-title center line">Your Goals</h2>
                    <div class="db-slideset-goals">
                        <?php 
                        $empty_goal = '<a href="'.site_url('account').'" data-button>Add Goal</a>';
                        $business_goal1 = uwp_get_usermeta($user_ID, 'business_goal_1')?uwp_get_usermeta($user_ID, 'business_goal_1'):$empty_goal;
                        $business_goal2 = uwp_get_usermeta($user_ID, 'business_goal_2')?uwp_get_usermeta($user_ID, 'business_goal_2'):$empty_goal;
                        $business_goal3 = uwp_get_usermeta($user_ID, 'business_goal_3')?uwp_get_usermeta($user_ID, 'business_goal_3'):$empty_goal;
                        $personal_goal1 = uwp_get_usermeta($user_ID, 'personal_goal_1')?uwp_get_usermeta($user_ID, 'personal_goal_1'):$empty_goal;
                        $personal_goal2 = uwp_get_usermeta($user_ID, 'personal_goal_2')?uwp_get_usermeta($user_ID, 'personal_goal_2'):$empty_goal;
                        $personal_goal3 = uwp_get_usermeta($user_ID, 'personal_goal_3')?uwp_get_usermeta($user_ID, 'personal_goal_3'):$empty_goal;
                        $health_goal1 = uwp_get_usermeta($user_ID, 'health_goal_1')?uwp_get_usermeta($user_ID, 'health_goal_1'):$empty_goal;
                        $health_goal2 = uwp_get_usermeta($user_ID, 'health_goal_2')?uwp_get_usermeta($user_ID, 'health_goal_2'):$empty_goal;
                        $health_goal3 = uwp_get_usermeta($user_ID, 'health_goal_3')?uwp_get_usermeta($user_ID, 'health_goal_3'):$empty_goal;
                        $user_goals = array(
                            'Business Goal 1' => $business_goal1,
                            'Business Goal 2' => $business_goal2,
                            'Business Goal 3' => $business_goal3,
                            'Personal Goal 1' => $personal_goal1,
                            'Personal Goal 2' => $personal_goal2,
                            'Personal Goal 3' => $personal_goal3,
                            'Health Goal 1' => $health_goal1,
                            'Health Goal 2' => $health_goal2,
                            'Health Goal 3' => $health_goal3
                        );
                        foreach($user_goals as $name => $goal){
                            echo '<div><div class="goal-item"><h4>'.$name.'</h4><p>'.$goal.'</p></div></div>';
                        }
                        ?>
                    </div><!-- .db-slideset-goals -->
                </div><!-- .container -->
            </section>

            <!-- Dashboard Grid -->
            <section id="dashboard-grid" class="services-grid blank">
                <div class="container">
                    <h2 class="section-title center line">Quick Links</h2>
                    <div class="row">
                        <div class="col-sm-6 col-md-3 item">
                            <div class="inner" data-col="homeservices">
                                <span class="icon"><img src="/wp-content/themes/ceoiq/inc/images/icon-programs.png" width="100"></span>
                                <h2>Meeting Check-In</h2>
                                <a href="<?php echo site_url('/check-in'); ?>" data-button>Check-In Now</a>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3 item">
                            <div class="inner" data-col="homeservices">
                                <span class="icon"><img src="/wp-content/themes/ceoiq/inc/images/icon-tools.png" width="100"></span>
                                <h2>Tools & Resources</h2>
                                <a href="<?php echo site_url('/tools-resources'); ?>" data-button>Learn More</a>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3 item">
                            <div class="inner" data-col="homeservices">
                                <span class="icon"><img src="/wp-content/themes/ceoiq/inc/images/icon-advisory.png" width="100"></span>
                                <h2>Group Roster</h2>
                                <a href="<?php echo site_url('/group-roster'); ?>" data-button>View</a>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3 item">
                            <div class="inner" data-col="homeservices">
                                <span class="icon"><img src="/wp-content/themes/ceoiq/inc/images/icon-workshops.png" width="100"></span>
                                <h2>Articles</h2>
                                <a href="<?php echo site_url('/articles'); ?>" data-button>View</a>
                            </div>
                        </div>

                    </div><!-- .row -->
                </div><!-- .container -->
            </section>

            <section id="dashboard-meetings" class="narrow">
                <div class="container">
                    <h2 class="section-title center line">Meetings</h2>
                    <div class="row">
                    <div class="col-md-6">
                        <h3>Meeting Calendar</h3>
                        <!-- Material theme -->
                        <!-- <div class="auto-jsCalendar material-theme custom-green"></div> -->
                        <div id="cert-calendar" class="material-theme custom-green"></div>
                        <!-- Selected Day click : <br><input id="dayclick"> -->
                        <?php 
                        $meetings_args = array(
                            'post_type' => 'meetings',
                            'posts_per_page' => -1,
                            'order' => 'DESC'
                        );
                        $meeting_dates = array();
                        $meetings_data = array();
                        $meetings_query = new WP_Query($meetings_args);
                        if ($meetings_query->have_posts()) :
                            while ( $meetings_query->have_posts() ) : $meetings_query->the_post();
                            $meeting_date = get_field('meeting_date');
                            $meeting_start_time = get_field('meeting_start_time');
                            $meeting_end_time = get_field('meeting_end_time');
                            $meeting_type = get_field('meeting_type');
                            $meeting_url = get_field('meeting_url');
                            $meeting_location = get_field('meeting_location');
                            if($meeting_type === 'local') {
                                $meeting_loc = $meeting_location;
                            } else {
                                $virtual_url = $meeting_url?$meeting_url:'#';
                                $meeting_loc = '<a href="'.$virtual_url.'" target="_blank">Virtual</a>';
                            }
                            $meeting_speaker_ID = get_field('meeting_speaker');
                            $meeting_speaker = $meeting_speaker_ID?get_the_title($meeting_speaker_ID):'';
                            // Build Dates For Calendar
                            $newDate = date_create($meeting_date);
                            $f_date = date_format($newDate, 'M-d-Y');
                            $cal_date = date_format($newDate, 'd/m/Y');
                            array_push($meeting_dates, $cal_date);
                            // Build Meeting Info
                            $meeting = array(
                                'id' => $post->ID,
                                'meeting_date' => $meeting_date,
                                'meeting_start_time' => $meeting_start_time,
                                'meeting_end_time' => $meeting_end_time,
                                'meeting_type' => $meeting_type,
                                'meeting_location' => $meeting_loc,
                                'meeting_address' => $meeting_location,
                                'meeting_speaker' => $meeting_speaker,
                                'permalink' => get_permalink(),
                            );
                            array_push($meetings_data, $meeting);
                            endwhile; wp_reset_postdata();
                        endif;?>
                    </div>
                    <div class="col-md-6">
                        <h3>Upcoming Meeting / Event</h3>
                        <?php echo do_shortcode('[upcoming-meeting]'); ?>
                    </div>
                    </div>
                </div>
            </section>

            <section id="dashboard-featured-user" class="narrow">
                <div class="container">
                    <h2 class="section-title center line">Monthly Spotlight</h2>
                    <div class="row">
                    <div class="col-md-6">
                        <h3 class="dashboard-title">Featured Member</h3>
                        <?php echo do_shortcode('[featured-user]'); ?>
                    </div>
                    <div class="col-md-6">
                        <h3 class="dashboard-title">Featured Speaker</h3>
                        <?php echo do_shortcode('[featured-speaker]'); ?>
                    </div>
                    </div>
                </div>
            </section>

            <section id="featured-articles" class="narrow">
                <div class="container center">
                    <h2 class="section-title center line">Featured Articles</h2>
                </div>
                <?php // echo do_shortcode('[must-reads posts="4" category="featured"]'); ?>
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
.db-slideset-goals .goal-item {
    display: block;
    padding: 15px;
}
</style>
<script>
jQuery(document).ready(function ($) {
    /**
     * Slideset Goals
     */
    $('.db-slideset-goals').slick({
        dots: true,
        arrows: false,
        infinite: true,
        speed: 800,
        slidesToShow: 3,
        slidesToScroll: 3,
        autoplay: true,
        autoplaySpeed: 8000,
        responsive: [
            {
                breakpoint: 991,
                settings: {
                    speed: 300,
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 650,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });

    /**
     * Calendar with events highlighted
     */
    // ajax -> Get Meeting Events
    /*var meetingsUrl = <?php // echo '"'.site_url('/wp-json/wp/v2/meetings').'"'; ?>;
    function getMeeting(meetingDate, callback) {
        meeting = null;
        $.getJSON(meetingsUrl+'?meta_key=meeting_date&meta_value='+meetingDate, function (jsonData) {
            meeting = jsonData;
            callback(meeting);
        });
    }*/
    /*getMeeting("86, function(meetings) {
        console.log(meetings);
    });*/
    // Initialize Calendar
    var calendarEl = document.getElementById("cert-calendar");
    var certCalendar = jsCalendar.new(calendarEl);
    var calEvents = <?php echo json_encode($meeting_dates); ?>;
    var meetings = <?php echo json_encode($meetings_data); ?>;
    console.log(meetings);
    // Add events
    certCalendar.select(calEvents);
    // Calendar Click Events
    certCalendar.onDateClick(function(event, date){
        let meeting_info = document.querySelectorAll('.meeting-info');
        let cal_cells = document.querySelectorAll('#cert-calendar td');
        [].forEach.call(cal_cells, function(el) {
            el.classList.remove("active");
        });
        if(event.target.classList.contains('jsCalendar-selected')) {
            event.target.classList.add('active');
            const ye = new Intl.DateTimeFormat('en', { year: 'numeric' }).format(date);
            const mo = new Intl.DateTimeFormat('en', { month: 'long' }).format(date);
            const da = new Intl.DateTimeFormat('en', { day: 'numeric' }).format(date);
            //inputA.value = mo+' '+da+', '+ye;
            let meetingDate = mo+' '+da+', '+ye;
            let meetingElement = document.getElementById('upcoming-meeting');
            let meeting = getMeeting(meetings, meetingDate);
            let meetingContent = `
                <p class="meeting-date">Date: ${meeting.meeting_date}</p>
                <ul class="icon-list">
                    ${meeting.meeting_start_time?'<li data-icon="clock">Start Time: '+meeting.meeting_start_time+'</li>':''}
                    ${meeting.meeting_end_time?'<li data-icon="stopwatch">End Time: '+meeting.meeting_end_time+'</li>':''}
                    ${meeting.meeting_location?'<li data-icon="pin">Location: '+meeting.meeting_location+'</li>':''}
                    ${meeting.meeting_speaker?'<li data-icon="speaker">Speaker: '+meeting.meeting_speaker+'</li>':''}
                </ul>
                <p><a href="${meeting.permalink}" data-button>View Meeting</a></p>
            `;
            meetingElement.innerHTML = meetingContent;
        }
    });
    function getMeeting(meetings, date) {
        for(i=0;i<meetings.length;i++){
            if(meetings[i].meeting_date === date){
                return meetings[i];
            }
        }
    }
    /* END Event Calendar */

});// END document.ready
</script>

<?php
get_footer();
