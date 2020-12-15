<?php
/**
 * Speakers Archive Template
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Ferus_Core
 */

get_header();
?>

<section id="page-header">
    <div class="container header-content">
        <h1 class="page-title">Speakers</h1>
    </div>
</section>

<div id="page-wrap" class="container">
    <div class="row">

        <div id="primary" class="content-area page-body col-md-12">

            <main id="main" class="site-main speakers-wrap row" role="main">
                <?php
                if (have_posts()) :
                    while (have_posts()) : the_post(); ?>

                        <?php
                        $feat_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'post-med' );
                        $image = $feat_image[0] ? $feat_image[0] : get_template_directory_uri() . '/inc/images/bg-repeat-light.jpg';
                        $speaker_title = get_field('speaker_title');
                        $speaker_website = get_field('speaker_website');
                        $speaker_email = get_field('speaker_email');
                        $speaker_phone = get_field('speaker_phone');
                        $speaker_meetings = get_field('speaker_meetings');
                        ?>
                        <div class="speaker-item col-xs-12 col-sm-6 col-md-4">
                            <article id="speaker-<?php echo $post->ID; ?>" class="speaker-<?php echo $post->ID; ?>">
                                <div class="speaker-img" style="background-image: url(<?php echo $image; ?>);"></div>
                                <div class="speaker-content">
                                    <!-- <div class="category">
                                        <?php // the_category( ' | ', '', $post->ID ); ?>
                                    </div> -->
                                    <h2 class="speaker-name">
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </h2>
                                    <p class="speaker-title"><?php echo $speaker_title; ?></p>
                                    <ul class="icon-list">
                                        <li data-icon="web"><a href="<?php echo $speaker_website; ?>" target="_blank"><?php echo $speaker_website; ?></a></li>
                                        <li data-icon="email"><a href="mailto:<?php echo $speaker_email; ?>"><?php echo $speaker_email; ?></a></li>
                                        <li data-icon="phone"><?php echo $speaker_phone; ?></li>
                                    </ul>
                                    <?php if ($speaker_meetings) : ?>
                                        <h4>Meetings</h4>
                                        <ul class="icon-list">
                                            <?php foreach( $speaker_meetings as $meeting ): ?>
                                                <?php
                                                $meeting_date = get_field('meeting_date',$meeting);
                                                ?>
                                                <li data-icon="meeting"><?php echo $meeting_date; ?></li>
                                            <?php endforeach; ?>
                                        </ul>
                                        <?php wp_reset_postdata(); ?>
                                    <?php endif; ?>
                                    <!-- <div class="speaker-bio">
                                        <?php //the_excerpt(); ?>
                                    </div> -->
                                    <!-- <a href="<?php the_permalink(); ?>" data-button="arrow">Learn More</a> -->
                                </div>
                            </article>
                        </div>
                    <?php endwhile;
                else :
                    get_template_part('template-parts/content', 'post-none');
                endif; ?>
            </main><!-- #main -->

            <div class="pagination">
                <?php
                global $wp_query;
                $big = 999999999; // need an unlikely integer
                $translated = __( 'Page', 'mytextdomain' ); // Supply translatable string
                echo paginate_links( array(
                'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                'format' => '?paged=%#%',
                'current' => max( 1, get_query_var('paged') ),
                'total' => $wp_query->max_num_pages,
                'before_page_number' => '<span class="screen-reader-text">'.$translated.' </span>',
                'prev_text' => '<',
                'next_text' => '>'
                ) );
                ?>
            </div>

        </div><!-- #primary -->
        <?php //get_sidebar(); ?>
    </div><!-- .row -->
</div><!-- .container -->


<?php get_footer(); ?>

<!-- <span id="inifiniteLoader"><i class="fa fa-circle-o-notch"></i> Loading...</span>
<script type="text/javascript">
    jQuery(document).ready(function($) {
        var count = 2;
        var total = <?php echo $wp_query->max_num_pages; ?>;
        $(window).scroll(function(){
            if  ($(window).scrollTop() == $(document).height() - $(window).height()){
                if (count > total){
                    return false;
                }else{
                    loadArticle(count);
                }
                count++;
            }
        });

        function loadArticle(pageNumber){
            $('span#inifiniteLoader').addClass('active').show('fast');
            $.ajax({
                url: "<?php bloginfo('wpurl') ?>/wp-admin/admin-ajax.php",
                type:'POST',
                data: "action=infinite_scroll&page_no="+ pageNumber + '&loop_file=loop&cat=<?php echo $catID; ?>&tag=<?php echo $tagID; ?>&author=<?php echo $authorID; ?>',
                success: function(html) {
                    $('span#inifiniteLoader').removeClass('active').fadeOut('1000');
                    var $newItems = $(html);
                    var $grid = $('.posts-grid-wrapper');
                    $grid.append($newItems);
                    colMatchHeight();
                    //Use the line below if you have masonry blogroll
                    $grid.append( $newItems ).masonry( 'appended', $newItems );
                }
            });
            return false;
        }

    });// END document.ready
</script> -->
