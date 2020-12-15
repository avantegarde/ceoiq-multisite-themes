<?php
/**
 * Meetings Archive Template
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Ferus_Core
 */

get_header();
?>

<section id="page-header">
    <div class="container header-content">
        <h1 class="page-title">Meetings</h1>
    </div>
</section>

<div id="page-wrap" class="container">
    <div class="row">

        <div id="primary" class="content-area page-body col-md-8">

            <main id="main" class="site-main" role="main">
                <?php
                if (have_posts()) :
                    while (have_posts()) : the_post(); ?>

                        <?php
                        $feat_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'post-med' );
                        $image = $feat_image?$feat_image[0]:get_template_directory_uri().'/inc/images/bg-repeat-light.jpg';
                        ?>
                        <article id="meeting-<?php echo $post->ID; ?>" class="meeting-item meeting-<?php echo $post->ID; ?>">
                            <h2 class="meeting-title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h2>
                            <div class="meeting-img" style="background-image: url(<?php echo $image; ?>);"></div>
                            <div class="meeting-content">
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
                                $meeting_speaker = get_field('meeting_speaker');
                                if($meeting_speaker) {
                                    $speaker_name = get_the_title($meeting_speaker);
                                    $featured_speaker = '<li data-icon="speaker">'.$speaker_name.'</li>';
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
                                    <?php echo $featured_speaker; ?>
                                </ul>
                                <a href="<?php the_permalink(); ?>" data-button="arrow">View Meeting</a>
                            </div>
                        </article>
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
        <?php get_sidebar(); ?>
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
