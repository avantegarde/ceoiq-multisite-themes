<?php
/**
 * Template Name: PXT Offer
 *
 * The default full-width template
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Ferus_Core
 */

get_header(); ?>

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
    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">


<!-- START: CONTENT -->
<section class="landing-header">
    <div class="container">
        <div class="row">

            <div class="col-md-8 col-md-offset-2 center">
                <h1 class="section-title">Take the First Steps to Upping Your Leadership Game in 2021</h1>
                <div class="inner-text">
                    <p>Leadership in 2021 is more challenging than ever. The key to upping your game is improving your self-knowledge and knowing what you can do to be more effective. That’s why CEOIQ is making this special offer to Entrepreneurs, CEO’s and C-Suite Executives now.</p>
                </div>
                <div class="button-wrap">
                    <a class="dll-button caps button-large" href="#" data-button="" data-toggle="modal" data-target="#pxt-modal">Get Started</a>
                </div>
            </div>

        </div><!-- .row -->
    </div><!-- .container -->
</section>
<section id="pxt-intro" class="grey">
    <div class="container">
        <div class="col-sm-3 col-md-2">
            <img class="spark" src="/wp-content/themes/ceoiq/inc/images/ceoiq-spark.png" width="250">
        </div>
        <div class="col-sm-9 col-sm-10">
            <!-- <h2 class="section-title">An Ecosystem</h2> -->
            <p>The PXT Select Profile Assessment from Wiley International is a comprehensive leadership insights and development tool that will help you take your game to the next level.  The adage…”Leader, first know yourself” has never been more true, appropriate or useful than right now as the entire Planet continues battling the coronavirus pandemic, as the way work gets done continues to change and the way leaders engage with and motivate their teams becomes increasingly important.</p>
            <p>CEOIQ is offering you the opportunity to complete the PXT Assessment and receive an hour of interpretation and coaching input from our knowledgeable, skilled practitioners who are certified in using this powerful tool. If you qualify (as an Entrepreneur, CEO C-Suite Executive) this offer (a value of $895.) will not cost you a dime...nada...nothing!</p>
            <p>At CEOIQ, where we’ve operated peer advisory groups for 20 years, conducted countless workshops and team development sessions, coached hundreds of executives...we want to ‘pay it forward’ in 2021 by offering qualified executives the opportunity to know yourself...and grow yourself...as a leader who is making a difference this year.</p>
            <p>To take advantage of this unique opportunity, complete the registration information on our website.</p>
            <p>We will validate your eligibility and contact you by email to get the process started!</p>
            <p>The opportunity to ‘up your game’ in 2021 is here...act now and be the best leader you can be this year!</p>
        </div>
    </div>
</section>
<section class="landing-features pxt-features grey">
    <div class="container">
        <div class="row">
            <div class="col-md-12 center">
                <h3 class="section-title">Here’s How It Works</h3>
                <!-- <h4 data-color="black">Looking to learn on your own at your own pace? <br>Hoping to host small groups for “lunch and learn” sessions that are actually valuable? </h4> -->
                <br>
            </div>
        </div><!-- .row -->
        <div class="row flex-row">
            <div class="col-md-4 center">
                <div class="img-wrap">
                    <img src="/wp-content/themes/ceoiq/inc/images/green-keyhole.png">
                </div>
                <div class="text-wrap">
                    <!-- <h5 class="feature-title" data-color="black"></h5> -->
                    <p data-color="black">Complete the brief registration form on the CEOIQ Website</p>
                </div>
            </div>

            <div class="col-md-4 center">
                <div class="img-wrap img-gauge">
                    <img src="/wp-content/themes/ceoiq/inc/images/green-crown.png">
                </div>
                <div class="text-wrap">
                    <!-- <h5 class="feature-title" data-color="black"></h5> -->
                    <p data-color="black">We will verify your eligibility as a qualified executive, usually from your LinkedIn profile.</p>
                </div>
            </div>

            <div class="col-md-4 center">
                <div class="img-wrap">
                    <img src="/wp-content/themes/ceoiq/inc/images/timeline-icon.png">
                </div>
                <div class="text-wrap">
                    <!-- <h5 class="feature-title" data-color="black"></h5> -->
                    <p data-color="black">Once verified, we will contact you by email and set up your link to complete the PXT Select assessment.</p>
                </div>
            </div>

            <div class="col-md-4 center">
                <div class="img-wrap">
                    <img src="/wp-content/themes/ceoiq/inc/images/resources-icon.png">
                </div>
                <div class="text-wrap">
                    <!-- <h5 class="feature-title" data-color="black"></h5> -->
                    <p data-color="black">When you’ve completed the assessment, we’ll email your profile reports and you’ll sign up for a one-hour debrief, interpretation and coaching session.</p>
                </div>
            </div>

            <div class="col-md-4 center">
                <div class="img-wrap">
                    <img src="/wp-content/themes/ceoiq/inc/images/resources-icon.png">
                </div>
                <div class="text-wrap">
                    <!-- <h5 class="feature-title" data-color="black"></h5> -->
                    <p data-color="black">CEOIQ’s certified professionals, Ben Griffin and Sara King, will conduct a confidential virtual debrief meeting with you to explore your PXT profile and opportunities for growth and development.</p>
                </div>
            </div>
        </div>
    </div><!-- .container -->
</section>
<section id="faq" class="">
    <div class="container">
        <div class="col-sm-3 col-md-2">
            <img class="spark" src="/wp-content/themes/ceoiq/inc/images/ceoiq-spark.png" width="250">
        </div>
        <div class="col-sm-9 col-sm-10">
            <h2 class="section-title">F.A.Q.</h2>
            <h3>“This is an $895 program from CEOIQ. Why are you offering it at no cost?”</h3>
            <p class="faq-answer">We get that question a lot...Ben Griffin, CEOIQ’s Chief Visionary and Cheerleader, celebrated 20 years of peer group facilitation, workshop production and executive coaching success in 2020. The celebration was, to say the least, muted.  At the beginning of 2021, Ben and Sara King started thinking about how they could do more to ‘pay it forward’ this year and came up with this program as an answer.</p>
            <h3>“Will anyone else see my assessment results?”</h3>
            <p class="faq-answer">That’s an easy and emphatic NO!. Your assessment is confidential to you. No one else sees it unless you decide to make it available.  The PXT Select assessment includes a suite of 4 individual reports that will provide you with valuable insight into your personal ‘wiring’ and leadership style along with specific suggestions for ‘upping your game’!</p>
            <!-- <div class="accordion">
                <h3 data-accordion="title">“This is an $895 program from CEOIQ. Why are you offering it at no cost?”</h3>
                <div data-accordion="content">
                    <p>We get that question a lot...Ben Griffin, CEOIQ’s Chief Visionary and Cheerleader, celebrated 20 years of peer group facilitation, workshop production and executive coaching success in 2020. The celebration was, to say the least, muted.  At the beginning of 2021, Ben and Sara King started thinking about how they could do more to ‘pay it forward’ this year and came up with this program as an answer.</p>
                </div>
                <h3 data-accordion="title">“Will anyone else see my assessment results?”</h3>
                <div data-accordion="content">
                    <p>That’s an easy and emphatic NO!. Your assessment is confidential to you. No one else sees it unless you decide to make it available.  The PXT Select assessment includes a suite of 4 individual reports that will provide you with valuable insight into your personal ‘wiring’ and leadership style along with specific suggestions for ‘upping your game’!</p>
                </div>
            </div> --><!-- .accordion -->

        </div>
    </div>
</section>
<section id="benefits" class="grey">
    <div class="container">
        <div class="col-sm-3 col-md-2">
            <img class="spark" src="/wp-content/themes/ceoiq/inc/images/ceoiq-spark.png" width="250">
        </div>
        <div class="col-sm-9 col-sm-10">
            <h2 class="section-title">Benefits</h2>
            <h3>Why do the PXT Select Assessment?</h3>
            <ul>
                <li>You’ll get actionable information and data about your personal profile and leadership style.</li>
                <li>Understand how to work with your team and direct reports more effectively.</li>
                <li>A roadmap for your leadership growth.</li>
            </ul>
        </div>
        <div class="col-md-12 center">
            <img src="https://ceoiq.com/wp-content/uploads/2021/04/pxt-image4.jpg" width="750" alt="Leader teaching group">
        </div>
        <div class="col-md-4">
            <h3>Know yourself first!</h3>
            <p>One of the great leadership challenges is spending some time being introspective...considering your approach to leading and how you can improve (and, we can all find opportunities to improve).  Using the PXT Select Assessment is a great way to build self-knowledge and create a personal ‘portal’ into growing yourself as a leader...this year and in coming years.</p>
        </div>
        <div class="col-md-4">
            <h3>Engage Effectively!</h3>
            <p>In this era of ‘forced’ remote work and ‘work from home’ environments, leaders can quickly start feeling separated...disengaged...from their direct reports and peers in the organization.  Using the PXT Select Assessment, your enhanced self-knowledge leads to understanding how to engage with work relationships - virtual and face-to-face more effectively.</p>
        </div>
        <div class="col-md-4">
            <h3>Map your personal growth plan!</h3>
            <p>Growing yourself as a leader has never been more important...or full of potential for positive impact on your team.  The PXT Select Assessment is a great starting point for creating your personal growth plan this year.  The insights you’ll gain about yourself and your leadership style will help you craft your personal plan for showing up the best you can be, fully present and aware of where and how you can grow!</p>
        </div>
    </div>
</section>
<section class="bios">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2 center">
                <div class="inner">
                    <h3 class="section-title">About Us</h3><br>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3 col-md-2">
                <img src="/wp-content/themes/ceoiq/inc/images/ben-griffin.jpg">
            </div>
            <div class="col-sm-9 col-sm-10">
                <h3>Ben Griffin</h3>
                <p>Entrepreneur, corporate executive, facilitator, coach, consultant, photographer...Ben Griffin has followed a constantly evolving path in his personal journey of ARETE.  For the past 20 years, he has facilitated CEO Peer Advisory Group and coached many CEO’s in companies of all sizes.  In addition he is a largely self-taught photographer who chases wildlife photo ops wherever he can find them.</p>
                <p>A great fan of that Kelly Clarkson song, “What doesn’t kill you makes you stronger,”  Ben has learned that truth through hard won personal experience. From losing a company he started in a venture capital deal that went sideways to getting fired three times from corporate positions (he says it took him awhile to realize he wasn’t the ‘best choice for an employee’) to emerging from a stint as a ‘turnaround guy’ and evolving into a facilitator and coach for entrepreneurs, he knows the title first-hand.</p>
                <p>Ben founded CEOIQ as a digital home to the peer groups, workshops and seminars he facilitates and as a resource for leadership laboratory content developed during his career. He is a certified expert practitioner for the PXT Select assessment from Wiley International. You can check out his <a href="/about/ben-griffin/">full bio on the CEOIQ website</a>.</p>
            </div>
        </div>
        <br><br>
        <div class="row">
            <div class="col-sm-3 col-md-2">
                <img src="/wp-content/themes/ceoiq/inc/images/sara-king.jpg">
            </div>
            <div class="col-sm-9 col-sm-10">
                <h3>Sara King</h3>
                <p>Accomplished Human Resources professional, expert on recruiting, hiring and onboarding, inspirational youth leader, consultant, facilitator and coach.  Sara has put her M.A. in Educational Media and Instructional Design to work in many venues during her career.</p>
                <p>She was the senior H.R. officer of a fast growing software company, overseeing an employee population that grew from 125 to over 650. During that time she worked with three different CEO’s to orchestrate five ownership changes while preserving the entrepreneurial spirit of the company.  Sara’s bedrock belief that the Human Resources function is a critical component of company growth and leadership development earned her a ‘seat at the senior leadership table’ and was the hallmark of her 21 year career.</p>
                <p>Sara partnered with Ben at CEOIQ to create virtual and real-world content that extends her expertise and experience to leaders in all types of organizations and industries. Along the way, she earned her Expert Practitioner Certification in the PXT Select profiling assessment from Wiley International and works with CEOIQ clients to use the PXT as a recruiting, onboarding, team development and coaching tool. You can check out Sara’s <a href="/about/sara-king/">complete bio on the CEOIQ website</a>.</p>
            </div>
        </div>
    </div>
</section>
<section id="pxt-logo">
    <div class="container">
        <div class="col-md-12 center">
            <img src="https://ceoiq.com/wp-content/uploads/2021/04/pxt-logo.jpg" width="1000" alt="PXT Select Authorized Partner">
        </div>
    </div>
</section>
<!-- <section id="testimonials" class="grey">
    <div class="container">
        <div class="col-md-12">
            <h3 class="section-title center">Testimonials</h3><br>
        </div>
        <div class="col-sm-12">
            <div class="testimonial_slider">
                <div>
                    <blockquote>
                        <p>&ldquo;Excepteur sint occaecat cupidatat non proident, sunt in culpa. Sed ut perspiciatis unde omnis iste natus error sit voluptatem. Nihil molestiae consequatur, vel illum qui dolorem eum. Laboris nisi ut aliquip ex ea commodo consequat. Animi, id est laborum et dolorum fuga. Do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae.&rdquo;</p>
                        <span class="author">First Last</span>
                    </blockquote>
                </div>
                <div>
                    <blockquote>
                        <p>&ldquo;Qui officia deserunt mollit anim id est laborum. Itaque earum rerum hic tenetur a sapiente delectus. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit. Duis aute irure dolor in reprehenderit in voluptate velit.&rdquo;</p>
                        <span class="author">First Last</span>
                    </blockquote>
                </div>
                <div>
                    <blockquote>
                        <p>&ldquo;Excepteur sint occaecat cupidatat non proident, sunt in culpa. Quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Architecto beatae vitae dicta sunt explicabo. Nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam.
                        <br><br>Architecto beatae vitae dicta sunt explicabo. Qui officia deserunt mollit anim id est laborum. Eaque ipsa quae ab illo inventore veritatis et quasi. Facere possimus, omnis voluptas assumenda est, omnis dolor repellendus.&rdquo;</p>
                        <span class="author">First Last</span>
                    </blockquote>
                </div>
            </div>
        </div>
    </div>
</section> -->
<section class="pxt-cta black parallax" data-plx-img="/wp-content/themes/ceoiq/inc/images/library-bg.jpg">
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-6 col-md-offset-3 center">
                <h4 class="section-title" data-color="white">It's time to get started with PXT.</h4>
				<h5 data-color="white">CEOIQ<sup>®</sup> CTA here.</h5>
                <div class="inner-text">
                    <p data-color="white">Join now to begin your progress.</p>
                </div>
                <div class="button-wrap">
                    <a href="#" data-button="" class="button-large" data-toggle="modal" data-target="#pxt-modal">GET STARTED</a>
                </div>
            </div>

        </div><!-- .row -->
    </div><!-- .container -->
</section>
<div id="pxt-modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="section-title center">Get Started</h3>
                <?php echo do_shortcode('[gravityform id="20" title="false" description="false" ajax="true" tabindex="999"]'); ?>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- END: CONTENT -->


        </main><!-- #main -->
    </div><!-- #primary -->
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
