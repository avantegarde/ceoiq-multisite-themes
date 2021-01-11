<?php
/**
 * The Homepage of the site
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ferus_core
 */

get_header(); ?>

<div id="primary" class="content-area page-body">
    <main id="main" class="site-main" role="main">

        <?php while (have_posts()) : the_post(); ?>
            <?php // echo the_content(); ?>
        <?php endwhile; ?>

        <section id="home-slider" class="home_slider">
            <div class="slide1 slick-slide" style="background-image:url('/wp-content/themes/ceoiq/inc/images/home-slide-01.jpg');">
                <div class="slide-caption">
                    <div class="container center">
                        <h3 class="section-title">Welcome to the CEOIQ <br>Peer Advisory Group Portal!</h3>
                        <a href="#" data-button data-toggle="modal" data-target="#loginModal">Login</a>
                        <!-- <a class="podcast-link" href="http://ceoiqradio.libsyn.com/" target="_blank"><i class="fa fa-podcast" aria-hidden="true"></i> Check out our Podcast <i class="fa fa-podcast" aria-hidden="true"></i></a> -->
                    </div>
                </div>
            </div>
        </section>

        <section id="digital-leadership-labs" class="">
            <div class="container flex-align">
                <div class="col-sm-4 center">
                    <img src="/wp-content/themes/ceoiq/inc/images/icon-leadership.png" width="260">
                </div>
                <div class="col-sm-8">
                    <h3 class="section-title">Welcome Members!</h3>
                    <p>Members of the CEOIQ Peer Groups – you are in the right place to log-in for your meetings, see your annual Business, Personal, Health &amp; Fitness goals, get meeting information and access the CEOIQ content available to you as a valued member of the CEOIQ community.</p>
                    <p>Please log-in at the right side of this page, using your access credentials.</p>
                    <p>Visitors! If you’ve found your way here…well, there isn’t anywhere else for you to go since you are not a member of a CEOIQ Peer Group. (Well, you can find out more about our Groups using the “About” button at the top of the page). Please click the “Home” button a the top of this page to return to the main Home Page of our website.</p>
                    <p><a href="#" data-button data-toggle="modal" data-target="#loginModal">Login</a></p>
                </div>
            </div>
        </section>

        <section id="peer-advisory-groups" class="grey">
            <div class="container flex-align">
                <div class="col-sm-4 col-sm-push-8 center">
                    <img src="/wp-content/themes/ceoiq/inc/images/icon-advisory.png" width="260">
                </div>
                <div class="col-sm-8 col-sm-pull-4">
                    <h3 class="section-title">What are CEOIQ Peer Advisory Groups?</h3>
                    <h4>A Community of Committed Leaders…</h4>
                    <p>Would having the opportunity to meet regularly with a group of like-minded CEO’s, owners, entrepreneurs who are running growing organizations help you be a better leader? </p>
                    <p>Would having a time and place where you can talk about the most significant issues and challenges you are facing…in an environment of Confidentiality…Authenticity…Trust…Engagement…make a difference in your leadership effectiveness?</p>
                    <p>That’s what CEOIQ Community members do with and for each other.  You bring your experience and expertise to share…and benefit from the deep collective experiences and expertise of other group members.  You also get the opportunity to expand your point of view and learnings by working with resource speakers and subject matter experts 5 – 6 times a year in a small group setting.</p>
                    <p>Want to know more about our Peer Advisory Groups? If you are a lifelong learner who knows that you can’t possibly ‘know it all’, wants to make better decisions and have the opportunity to interact with peers regularly, we’d love to talk with you. </p>
                    <p><strong>CEOIQ Peer Advisory Groups are a ‘Gathering of Eagles’</strong> – successful entrepreneurs, business owners and CEO’s who want to play at the top of their game! These leaders know that Peer Group membership provides a vehicle for working with other leaders who share </p>
                    <p>And, you can learn more while you are here by clicking on the “About” navigation button at the top of this page. There is a detailed description of our Mission and Vision along with lots of details about the Group programs.  You can also find out more back on the main site, on the <a href="https://www.ceoiq.com/peer-groups/" onclick="_gaq.push(['_trackEvent', 'outbound-article', 'https://www.ceoiq.com/peer-groups/', 'Peer Advisory Groups page']);" target="_blank">Peer Advisory Groups page</a>.</p>
                    <p>Interested in the concept of ARETE that is our guiding vision at CEOIQ.  Get an in-depth look at what ARETE means and how we apply it to developing 21st Century Leaders by visiting the <a href="https://www.ceoiq.com/what-is-arete/" onclick="_gaq.push(['_trackEvent', 'outbound-article', 'https://www.ceoiq.com/what-is-arete/', 'ARETE Information Page']);" target="_blank">ARETE Information Page</a>, it’s also back on the main website.</p>
                    <p>To find out if a CEOIQ Group is a fit for you, please give us some information about yourself using the webform below. It’s the first step to discovering how a CEOIQ Peer Advisory Group can support you on your journey of ARETE to become a more effective leader!</p>
                    <p><a href="#" data-button data-toggle="modal" data-target="#groupSignup">Get Started Today!</a></p>
                </div>
            </div>
        </section>

        <!-- <section id="home-services" class="services-grid">
            <div class="container">
                <h3 class="section-title center">Quick Links</h3>
                <div class="row">
                    <div class="col-sm-6 col-md-4 item">
                        <div class="inner" data-col="homeservices">
                            <span class="icon"><img src="/wp-content/themes/ceoiq/inc/images/icon-leadership.png" width="100"></span>
                            <h2>Digital Leadership Labs</h2>
                            <a href="/digital-leadership-labs/" data-button>Learn More</a>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4 item">
                        <div class="inner" data-col="homeservices">
                            <span class="icon"><img src="/wp-content/themes/ceoiq/inc/images/icon-coaching.png" width="100"></span>
                            <h2>Executive Coaching</h2>
                            <a href="/executive-coaching/" data-button>Learn More</a>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4 item">
                        <div class="inner" data-col="homeservices">
                            <span class="icon"><img src="/wp-content/themes/ceoiq/inc/images/icon-advisory.png" width="100"></span>
                            <h2>Peer Advisory Groups</h2>
                            <a href="/peer-groups/" data-button>Learn More</a>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4 item">
                        <div class="inner" data-col="homeservices">
                            <span class="icon"><img src="/wp-content/themes/ceoiq/inc/images/icon-programs.png" width="100"></span>
                            <h2>Virtual Programs</h2>
                            <a href="/virtual-programs/" data-button>Learn More</a>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4 item">
                        <div class="inner" data-col="homeservices">
                            <span class="icon"><img src="/wp-content/themes/ceoiq/inc/images/icon-tools.png" width="100"></span>
                            <h2>Tools & Resources</h2>
                            <a href="/tools-resources/" data-button>Learn More</a>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4 item">
                        <div class="inner" data-col="homeservices">
                            <span class="icon"><img src="/wp-content/themes/ceoiq/inc/images/icon-workshops.png" width="100"></span>
                            <h2>Workshops & Seminars</h2>
                            <a href="/workshops-seminars/" data-button>Learn More</a>
                        </div>
                    </div>

                </div>
            </div>
        </section> -->

        <section class="landing-account-cta purple parallax" data-plx-img="/wp-content/themes/ceoiq/inc/images/library-bg.jpg">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-6 col-md-offset-3 center">
                        <h4 class="section-title" data-color="white">New Member Sign-Up</h4>
                        <h5 data-color="white">CEOIQ<sup>&reg;</sup> Peer Advisory Group</h5>
                        <div class="inner-text">
                            <p>Join now to begin.</p>
                        </div>
                        <div class="button-wrap">
                            <a href="#" data-button="" class="button-large" data-toggle="modal" data-target="#groupSignup">Get Started</a>
                        </div>
                    </div>

                </div><!-- .row -->
            </div><!-- .container -->
        </section>

    </main><!-- #main -->
</div><!-- #primary -->

<!-- Start Modal -->
<div id="groupSignup" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="section-title center">Group Signup</h3>
                <?php echo do_shortcode('[gravityform id="2" title="false" description="false" ajax="true" tabindex="999"]'); ?>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- END Modal -->

<div id="loginModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <?php echo do_shortcode('[uwp_login]'); ?>
            </div>
        </div><!-- .modal-content -->
    </div><!-- .modal-dialog -->
</div><!-- .modal -->
<script>
jQuery(document).ready(function ($) {
    $('#loginModal').modal('show');
});// END document.ready
</script>

<?php get_footer();