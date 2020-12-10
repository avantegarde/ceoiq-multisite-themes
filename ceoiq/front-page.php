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
                        <h3 class="section-title"><strong>CEOIQ<sup><sup>&reg;</sup></sup></strong> is about <a href="/what-is-arete/"><strong>Arete</strong></a> <br>
                            <span class="subline"><a href="/what-is-arete/">Arete</a> is about… <br>
                                The Pursuit of Excellence...Always Doing Your Best</span>
                        </h3>
                        <a class="podcast-link" href="http://ceoiqradio.libsyn.com/" target="_blank"><i class="fa fa-podcast" aria-hidden="true"></i> Check out our Podcast <i class="fa fa-podcast" aria-hidden="true"></i></a>
                    </div>
                </div>
            </div>
        </section>

        <section id="home-services" class="services-grid">
            <div class="container">
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

                </div><!-- .row -->
            </div><!-- .container -->
        </section>

        <section id="digital-leadership-labs" class="grey">
            <div class="container">
                <div class="col-sm-4 center" data-col="service1">
                    <img src="/wp-content/themes/ceoiq/inc/images/icon-leadership.png" width="260">
                </div>
                <div class="col-sm-8" data-col="service1">
                    <h3 class="section-title">Digital Leadership Labs</h3>
                    <p>So, you get what Arete is about and know that it’s a lifelong journey. AND, you want to take the trip on your own time, at your own pace.  Maybe you even want members of your Leadership Team to join you in the pursuit of Arete.  CEOIQ Digital Leadership Labs are here for you.  All digital, video driven, self-paced Leadership Labs designed for you and your team to use on your schedule.  Our Digital Leadership Labs library is growing all the time.  We’re bringing in some top thought leaders to join CEOIQ in providing you with world-class content for your journey of Arete.</p>
                    <p><a href="/digital-leadership-labs/" data-button>Learn More</a></p>
                </div>
            </div>
        </section>

        <section id="peer-advisory-groups" class="">
            <div class="container">
                <div class="col-sm-4 col-sm-push-8 center" data-col="service2">
                    <img src="/wp-content/themes/ceoiq/inc/images/icon-advisory.png" width="260">
                </div>
                <div class="col-sm-8 col-sm-pull-4" data-col="service2">
                    <h3 class="section-title">Peer Advisory Groups</h3>
                    <p>The CEOIQ<sup>®</sup> Peer Advisory Group experience is designed for those demanding and discerning leaders pursuing their journey of Arete with the ‘fellow-travelers’ in their Group. We have two groups, the Chief Executive RoundTable (for businesses with $10million and above in revenue) and the Entrepreneurs Advisory Board (designed for smaller businesses and high-performing practicing professionals).  Ben Griffin has 20 years experience facilitating, leading and coaching CEO’s, Entrepreneurs and C-Suite Leaders. That experience and Ben’s varied business roles as a corporate executive, turnaround specialist, entrepreneur and profit center leader, combine to create the premier Peer Advisory Group experiences available today in the Mid-Atlantic area. Ben facilitates the two CEOIQ<sup>®</sup> Peer Advisory Groups.  Our group members run some of the most high-impact companies in the region. Find out if you are eligible for membership - it’s an experience in growing as a leader you simply can’t get anywhere else.</p>
                    <p><a href="/peer-groups/" data-button>Learn More</a></p>
                </div>
            </div>
        </section>

        <section id="executive-coaching" class="grey">
            <div class="container">
                <div class="col-sm-4 center" data-col="service1">
                    <img src="/wp-content/themes/ceoiq/inc/images/icon-coaching.png" width="260">
                </div>
                <div class="col-sm-8" data-col="service1">
                    <h3 class="section-title">Executive Coaching</h3>
                    <p>Effective Executive Coaching is an important ‘secret weapon’ in your Arete Journey...Top Leaders, in businesses of all sizes and types, recognize that no one does it alone.  Having a confidant, a consigliere you trust and can talk with  about the grand sweep of your vision...or,  the problems you’re having with a difficult employee in a series of ongoing conversations that occur regularly is the ‘secret weapon’ of many CEO’s and C-Suite leaders.  Ben Griffin has  extensive, deep experience as a line executive, entrepreneur, CEO, and practicing professional..  Ben brings that depth and breadth to every Executive Coaching engagement.  He works with CEO’s and executives on  focused assignments of a year or less and has relationships that have spanned 15 or more years where he makes a valued continuing contribution to the leader's success and growth.  Explore the CEOIQ Executive Coaching Program and some of the proprietary tools and diagnostics used to facilitate your Journey of Arete.</p>
                    <p><a href="/executive-coaching/" data-button>Learn More</a></p>
                </div>
            </div>
        </section>

        <section id="tools-resources" class="">
            <div class="container">
                <div class="col-sm-4 col-sm-push-8 center" data-col="service2">
                    <img src="/wp-content/themes/ceoiq/inc/images/icon-tools.png" width="260">
                </div>
                <div class="col-sm-8 col-sm-pull-4" data-col="service2">
                    <h3 class="section-title">Tools & Resources</h3>
                    <p>Looking for that ‘Quick Hit’ to analyze a financial issue, work with your team, solve a problem? CEOIQ<sup>&reg;</sup> Tools and Resources is our gift to you!</p>
                    <p>We’ve got tons of free content here for you to explore and use to grow yourself and your team.</p>
                    <p>There are the CEOIQ Calculators - 10 financial analysis tools you can use right on the website to get answers to financial questions about your business.  Then there is the “Issue Processing Diagnostic” - a tool we use in our Peer Advisory Groups to solve problems together - it’s included here, along with a ‘how to use’ sheet.  Is Accountability an issue? Check out the “Action Planning and Accountability” template that’s designed to get a key strategic initiative ‘on-paper’, with key responsibilities and due dates assigned.  This tool becomes the starting point for your regular Strategic Thinking Conversations.  There’s lot’s more - and we are adding to the library all the time...Check it out...bookmark the page so you can find your way back often.</p>
                    <p><a href="/tools-resources/" data-button>Learn More</a></p>
                </div>
            </div>
        </section>

        <section id="workshops-seminars" class="grey">
            <div class="container">
                <div class="col-sm-4 center" data-col="service1">
                    <img src="/wp-content/themes/ceoiq/inc/images/icon-workshops.png" width="260">
                </div>
                <div class="col-sm-8" data-col="service1">
                    <h3 class="section-title">Workshops & Seminars</h3>
                    <p>Ready to take your Leadership Team on a ‘giant leap’ in the Journey of Arete? That’s what you’ll experience in the Workshop Programs available from CEOIQ<sup>&reg;</sup>!</p>
                    <p>We’ve designed workshops that include Strategic Thinking, TeamAlignment, Financial Management and others.  Each of these designs is customized to your specific needs and desired outcomes from working with Ben Griffin as your .  Ben focuses on workshop topics where he has specific expertise and deep interest. The ‘signature’ of a CEOIQ workshop is taking  the ‘best of the best’ thinking, often aimed at “Fortune 1000” companies and scaling it to work in entrepreneurial, privately held organization environments. Ben uses proprietary diagnostics and tools for program participants to use in preparing for a workshop so that everyone hits the ground running at the opening.  Tell us about your needs and we’ll design a custom ARETE experience for you and your team.</p>
                    <p><a href="/workshops-seminars/" data-button>Learn More</a></p>
                </div>
            </div>
        </section>

        <section id="virtual-programs" class="">
            <div class="container">
                <div class="col-sm-4 col-sm-push-8 center" data-col="service2">
                    <img src="/wp-content/themes/ceoiq/inc/images/icon-programs.png" width="260">
                </div>
                <div class="col-sm-8 col-sm-pull-4" data-col="service2">
                    <h3 class="section-title">Virtual Programs</h3>
                    <p>OK, we’re on our own Journey of Arete at CEOIQ<sup>&reg;</sup> - Our pursuit of Excellence and Achieving Highest Potential includes a vision of bringing a combination of our Digital Leadership Labs, Peer Advisory Groups and Real-World Workshops together into an ‘All Virtual’ format for Leaders who want to play that way - virtually.</p>
                    <p>We’re working to bring together small groups of 6 - 10 leaders - all from different businesses and from different parts of North America - to participate in ‘topic-focused’  workshops… Ben Griffin and Sara King have been planning this all new format in order to provide additional support for the “How To Create Your Next Great Employee” Digital Leadership Lab.  We also envision creating groups to work on Strategy, TeamAlignment and other topics.  These programs are ‘in the creation phase’ now.  If you’d like to know more and be on the invite list for them, click below!</p>
                    <p><a href="/virtual-programs/" data-button>Learn More</a></p>
                </div>
            </div>
        </section>

    </main><!-- #main -->
</div><!-- #primary -->

<!-- Start Modal -->
<!-- <div id="myModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Modal title</h4>
            </div>
            <div class="modal-body">
                <p>One fine body&hellip;</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div> -->
<!-- END Modal -->

<?php get_footer();