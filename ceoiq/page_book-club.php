<?php
/**
 * Template Name: Book Club
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
<section class="landing-header darkgrey book-club-header parallax" data-plx-img="/wp-content/themes/ceoiq/inc/images/library-bg.jpg">
    <div class="container">
        <div class="row">

            <div class="col-md-6 col-md-offset-3 center">
                <h1 class="section-title">CEOIQ Leadership 2021 Book Club</h1>
                <div class="inner-text">
                    <p>Grow your Leadership EQ! Join a high-energy group of leaders for CEOIQ Book Club virtual workshops.</p>
                </div>
                <div class="button-wrap">
                    <a class="dll-button caps button-large" href="#" data-button="">Join Now!</a>
                </div>
            </div>

        </div><!-- .row -->
    </div><!-- .container -->
</section>
<section id="benefits" class="">
    <div class="container">
        <div class="col-md-12">
            <h2 class="section-title center">Benefits</h2>
        </div>
        <div class="col-md-4">
            <h3>Discover new perspectives on leading in chaos!</h3>
            <p>Leadership at all levels is more challenging than ever in 2021. Keeping people engaged and motivated as ‘pandemic fatigue’ builds and uncertainty about the ‘next normal’ grows is testing leaders from the C-Suite, the Boardroom, and the Shop Floor. Explore current thinking from various thought leaders and discover ideas for increasing your effectiveness in this four session CEOIQ virtual book club.</p>
        </div>
        <div class="col-md-4">
            <h3>Meet other leaders who are sharing your ARETE journey today!</h3>
            <p>Leaders learn from Leaders! This book club environment is an opportunity for you to listen to what other leaders are saying, add your own unique perspective and share the ‘journey of ARETE’ - your pursuit of excellence and achieving your highest potential. Learn more about <a href="https://www.ceoiq.com/what-is-arete/" target="_blank">ARETE</a> on the CEOIQ website.</p>
        </div>
        <div class="col-md-4">
            <h3>Grow your Leadership EQ!</h3>
            <p>Emotional Intelligence (EQ) is the leadership buzzword of this era.  And, few leaders actually spend time ‘working on themselves’ and being introspective about their EQ. The unique format of the CEOIQ Leadership 2021 Book Club is designed to provide you that opportunity and to share the journey with other like-minded leaders.</p>
        </div>
    </div>
</section>
<section class="landing-features book-club-features grey">
    <div class="container">
        <div class="row">
            <div class="col-md-12 center">
                <h3 class="section-title">What We'll Discuss</h3>
                <br>
                <p>Leadership 2021 brings completely new and different challenges for leaders at all levels. In four workshops over eight weeks, instead of a specific book, the CEOIQ Book club will use current thought provoking articles and excerpts from books to frame discussions about how leadership is changing, what new behaviors, approaches and attitudes you need to bring to your “A-Game” today. The diverse small group format  gives you the opportunity to learn from and learn with other leaders in this innovative book club format.</p>
                <br>
            </div>
        </div><!-- .row -->
        <div class="row flex-row">
            <div class="col-md-7 center">
                <div class="img-wrap">
                    <img src="/wp-content/themes/ceoiq/inc/images/icon-group.png">
                </div>
                <div class="text-wrap">
                    <h5 class="feature-title" data-color="black">A ‘small group’ book club. Maximum of 12 participants.</h5>
                    <p data-color="black">In a virtual book club environment, small is definitely beautiful. With a maximum of 12 participants, you and your colleagues in the club will have the opportunity for deep dives into concepts, ideas and principles.</p>
                </div>
            </div>

            <div class="col-md-6 center">
                <div class="img-wrap">
                    <img src="/wp-content/themes/ceoiq/inc/images/icon-diagram-fill.png">
                </div>
                <div class="text-wrap">
                    <h5 class="feature-title" data-color="black">Explore up-to-the-minute leadership experiences and learnings</h5>
                    <p data-color="black">The challenge of the usual book club for leaders is that the books are already dated by the time they are published.  In 2021, the environment is changing so fast that we believe you’ll get more learning opportunities from ‘smaller bites of content’ found in current articles, blog posts, videos.  Using these ‘unusual inputs’ as a framework, you and your colleagues in the CEOIQ Book Club will explore timely leadership topics and craft individual action plans you can put into use immediately.</p>
                </div>
            </div>

            <div class="col-md-6 center">
                <div class="img-wrap">
                    <img src="/wp-content/themes/ceoiq/inc/images/icon-facilitators.png">
                </div>
                <div class="text-wrap">
                    <h5 class="feature-title" data-color="black">Led by skilled, deeply experienced facilitators.</h5>
                    <p data-color="black">Your CEOIQ Book Club uses a workshop format. Your participation is enhanced by skilled facilitators who work to assure a great experience for each person.  CEOIQ founder Ben Griffin has over 20 years experience facilitating peer advisory groups and serving as an executive coach.  Colleague Sara King has a masters degree in education design, a long and deep experience as a top human resources executive and now serves as a consultant and coach.</p>
                </div>
            </div>
        </div>
    </div><!-- .container -->
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
                <p>Ben founded CEOIQ as a digital home to the peer groups, workshops and seminars he facilitates and as a resource for leadership laboratory content developed during his career. He is a certified expert practitioner for the PXT Select assessment from Wiley International. You can check out his full bio on the CEOIQ website.</p>
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
                <p>Sara partnered with Ben at CEOIQ to create virtual and real-world content that extends her expertise and experience to leaders in all types of organizations and industries. Along the way, she earned her Expert Practitioner Certification in the PXT Select profiling assessment from Wiley International and works with CEOIQ clients to use the PXT as a recruiting, onboarding, team development and coaching tool. You can check out Sara’s complete bio on the CEOIQ website.</p>
            </div>
        </div>
    </div>
</section>
<section id="testimonials" class="grey">
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
</section>
<section class="book-club-cta darkgrey parallax" data-plx-img="/wp-content/themes/ceoiq/inc/images/hero-landing.jpg">
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-8 col-md-offset-2 center">
                <h4 class="section-title" data-color="white">The small group, professionally facilitated CEOIQ Leadership Book Club is now available for registration...And, it is FREE.</h4>
				<h5 data-color="white">These four workshop sessions are one way CEOIQ can give back and pay-it-forward in 2021.</h5>
                <!-- <div class="inner-text">
                    <p>Join now to begin your progress.</p>
                </div> -->
                <div class="button-wrap">
                    <a href="#" data-button="" class="button-large">Sign Up HERE</a>
                </div>
            </div>

        </div><!-- .row -->
    </div><!-- .container -->
</section>
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
