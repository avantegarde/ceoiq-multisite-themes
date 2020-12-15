<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Ferus_Core
 */

get_header(); ?>

    <!-- <section id="post-header" class="bg-repeat-light" style="background-image:url(<?php echo get_template_directory_uri() . '/inc/images/bg-repeat-light.jpg'; ?>);"></section> -->


    <div id="primary" class="content-area">
        <main id="main" class="site-main container" role="main">
            <div class="row">
                <?php
                while (have_posts()) : the_post(); ?>

                    <div class="col-md-8">
                        <article id="post-<?php the_ID(); ?>" <?php post_class('single-post'); ?>>
                            <div class="entry-wrap">

                                <header class="entry-header">
                                    <?php 
                                    $feat_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );
                                    $image = $feat_image?$feat_image[0]:get_template_directory_uri().'/inc/images/hero.jpg';
                                    ?>
                                    <div id="meeting-img" style="background-image:url(<?php echo $image; ?>);"></div>
                                    <div class="header-content">
                                        <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
                                        <?php
                                        $meeting_date = get_field('meeting_date');
                                        $meeting_start_time = get_field('meeting_start_time');
                                        $meeting_end_time = get_field('meeting_end_time');
                                        $meeting_type = get_field('meeting_type');
                                        $meeting_url = get_field('meeting_url');
                                        $meeting_location = get_field('meeting_location');
                                        if($meeting_type === 'local') {
                                            $meeting_loc = $meeting_location;
                                        } else {
                                            $meeting_loc = '<a href="'.$meeting_url.'">Virtual</a>';
                                        }
                                        ?>
                                        <p class="meeting-date">Date: <?php echo $meeting_date; ?></p>
                                        <ul class="icon-list">
                                            <?php if ($meeting_start_time) : ?>
                                                <li data-icon="stopwatch">Start Time: <?php echo $meeting_start_time; ?></li>
                                            <?php endif; ?>
                                            <?php if ($meeting_end_time) : ?>
                                                <li data-icon="clock">End Time: <?php echo $meeting_end_time; ?></li>
                                            <?php endif; ?>
                                            <?php if ($meeting_end_time) : ?>
                                                <li data-icon="pin">Location: <?php echo $meeting_loc; ?></li>
                                            <?php endif; ?>
                                        </ul>
                                    </div>
                                </header><!-- .entry-header -->

                                <div class="entry-content">
                                    <?php the_content(); ?>
                                </div><!-- .entry-content -->
                            </div>

                        </article><!-- #post-## -->
                    </div>
                    <div id="sidebar" class="col-md-4">
                        <div class="meeting-details">
                            <h2 class="widget-title">Resources</h2>
                            <?php 
                            $meeting_files = get_field('meeting_files');
                            $meeting_audio_location = get_field('meeting_audio_location');
                            $meeting_audio_file = get_field('meeting_audio_file');
                            $meeting_audio_link = get_field('meeting_audio_link');
                            if($meeting_audio_location === 'local' && $meeting_audio_file) {
                                $audio_file = '<li class="audio"><a href="'.$meeting_audio_file.'" target="_blank">Audio Recording</a></li>';
                            } elseif($meeting_audio_location === 'external' && $meeting_audio_link) {
                                $audio_file = '<li class="audio"><a href="'.$meeting_audio_link.'" target="_blank">Audio Recording</a></li>';
                            } else {
                                $audio_file = '';
                            }
                            ?>
                            <ul class="icon-list files">
                                <?php if ($meeting_files) : ?>
                                    <?php foreach( $meeting_files as $file ): ?>
                                        <?php
                                        $m_file = $file['meeting_file'];
                                        $f_title = $m_file['title'];
                                        $f_url = $m_file['url'];
                                        ?>
                                        <li><a href="<?php echo $f_url; ?>" target="_blank"><?php echo $f_title; ?></a></li>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <li class="cross">No files.</li>
                                <?php endif; ?>
                                <?php echo $audio_file; ?>
                            </ul>
                        </div><!-- .meeting-details -->
                        <hr>
                        <div class="featured-speaker">
                            <h2 class="widget-title">Featured Speaker</h2>
                            <?php 
                            $meeting_speaker = get_field('meeting_speaker');
                            if ($meeting_speaker) : ?>
                                <?php
                                $speaker_feat_image = wp_get_attachment_image_src( get_post_thumbnail_id($meeting_speaker), 'large' );
                                $speaker_img = $speaker_feat_image?$speaker_feat_image[0]:get_template_directory_uri().'/inc/images/hero.jpg';
                                $speaker_name = get_the_title($meeting_speaker);
                                $speaker_title = get_field('speaker_title', $meeting_speaker);
                                $speaker_website = get_field('speaker_website', $meeting_speaker);
                                $speaker_email = get_field('speaker_email', $meeting_speaker);
                                $speaker_phone = get_field('speaker_phone', $meeting_speaker);
                                ?>
                                <div id="speaker-img" style="background-image:url(<?php echo $image; ?>);"></div>
                                <h4><?php echo $speaker_name; ?></h4>
                                <p class="speaker-title"><?php echo $speaker_title; ?></p>
                                <ul class="icon-list">
                                    <li data-icon="web"><a href="<?php echo $speaker_website; ?>" target="_blank"><?php echo $speaker_website; ?></a></li>
                                    <li data-icon="email"><a href="mailto:<?php echo $speaker_email; ?>"><?php echo $speaker_email; ?></a></li>
                                    <li data-icon="phone"><?php echo $speaker_phone; ?></li>
                                </ul>
                            <?php else : ?>
                                <p>No Featured Speaker.</p>
                            <?php endif; ?>
                        </div><!-- .featured-speaker -->
                        <?php // if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
                            <?php // dynamic_sidebar( 'sidebar-1' ); ?>
                        <?php // endif; ?>
                    </div>

                    <?php //the_post_navigation(); ?>

                    <?php // If comments are open or we have at least one comment, load up the comment template.
                    //if (comments_open() || get_comments_number()) : ?>
                        <!-- <div class="container">
                            <div class="col-md-10 col-md-push-1 panel">
                                <div class="panel-content">
                                    <?php //comments_template(); ?>
                                </div>
                            </div>
                        </div> -->
                    <?php // endif; ?>

                <?php // End of the loop.
                endwhile; ?>
            </div><!-- .row -->
        </main><!-- #main -->
    </div><!-- #primary -->

<?php
get_footer();
