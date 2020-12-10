<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Ferus_Core
 */

get_header();
// Infinite Scroll Vars
$archive_scroll = $wp_query->get_queried_object();
$catID = '';
$tagID = '';
$authorID = '';
if ($archive_scroll->taxonomy === 'category') {
    $catID = $archive_scroll->term_id;
}
if ($archive_scroll->taxonomy === 'post_tag') {
    $tagID = $archive_scroll->term_id;
}
if ($archive_scroll->data->user_login) {
    $authorID = $archive_scroll->data->ID;
}
?>

<section id="page-header">
    <div class="container header-content">
        <h1 class="page-title">Blog</h1>
    </div>
</section>

<div id="page-wrap" class="clearfix">

    <div id="primary" class="content-area clearfix">

        <?php if ( is_active_sidebar( 'page-header' ) ) : ?>
            <div id="page-header" class="widget-area" role="complementary">
                <?php dynamic_sidebar( 'page-header' ); ?>
            </div><!-- #page-header -->
        <?php endif; ?>

        <div class="container">

            <form role="search" method="get" class="search-filter search" action="<?php echo site_url(); ?>">
                <input type="hidden" name="search-type" value="blog-search"/>
                <input type="blog-search" class="form-control search_text" name="s" action="" aria-label="..." placeholder="Search...">
                <?php $catArgs = array(
                    'show_option_all'    => 'All Categories',
                    'class'              => 'cat-drop',
                    'exclude'            => '1',
                    'selected'           => $catID,
                ); ?>
                <?php wp_dropdown_categories($catArgs); ?>
                <?php $authorArgs = array(
                    'show_option_all'         => 'All Authors', // string
                    'show_option_none'        => null, // string
                    'hide_if_only_one_author' => null, // string
                    'orderby'                 => 'display_name',
                    'order'                   => 'ASC',
                    'include'                 => null, // string
                    'exclude'                 => '1', // string
                    'multi'                   => false,
                    'show'                    => 'display_name',
                    'echo'                    => true,
                    'selected'                => false,
                    'include_selected'        => false,
                    'name'                    => 'author', // string
                    'id'                      => null, // integer
                    'class'                   => 'author-drop', // string
                    'blog_id'                 => $GLOBALS['blog_id'],
                    'who'                     => null // string
                ); ?>
                <?php wp_dropdown_users($authorArgs); ?>
                <?php $tagArgs = array(
                    'show_option_all'    => 'All Mediums',
                    'name'              => 'tag',
                    'class'              => 'tag-drop',
                    'exclude'            => '',
                    'taxonomy'           => 'post_tag',
                    'include'           => '11,12,13',
                    'selected'           => $tagID,
                ); ?>
                <?php wp_dropdown_categories($tagArgs); ?>
                <button class="button do_search">Go</button>
            </form>

        </div>

        <main id="main" class="site-main container" role="main">
            <div class="posts-grid-wrapper">
                <div class="grid-sizer"></div>

                <?php
                if (have_posts()) :
                    /* Start the Loop */
                    $count = 0;
                    while (have_posts()) : the_post(); ?>

                        <?php
                        $feat_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'post-med' );
                        $image = $feat_image[0] ? $feat_image[0] : get_template_directory_uri() . '/inc/images/bg-repeat-light.jpg';
                        $excerpt_length = 250;
                        $content = apply_filters('the_content', get_the_content());
                        $excerpt = truncate( $content, $excerpt_length, '...', false, true );
                        ?>
                        <div class="post-item post-<?php echo $count; ?> animated fadeIn">

                            <article id="post-<?php echo $post->ID; ?>" class="post-<?php echo $post->ID; ?> post-inner" style="background-image: url(<?php echo $image; ?>);">



                                <div class="post-content animated flipInX">
                                    <div class="category">
                                        <?php the_category( ' | ', '', $post->ID ); ?>
                                    </div>
                                    <p class="author-date"><?php the_author(); ?> | <?php the_time('F d, Y'); ?></p>
                                    <h2 class="post-title">
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </h2>

                                    <!-- <div class="content-blurb">
                                    <?php // echo $excerpt; ?>
                                </div> -->
                                    <!-- <a href="<?php the_permalink(); ?>" data-button="arrow">Learn More</a> -->
                                </div>
                            </article>
                        </div>

                        <?php
                        $count = $count + 1;
                        if ($count === 7) {
                            $count = 0;
                        } ?>
                    <?php endwhile;

                else :
                    get_template_part('template-parts/content', 'post-none');
                endif; ?>
            </div><!-- .row -->
        </main><!-- #main -->

        <!-- <div class="pagination">
<?php /*
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
*/ ?>
</div> -->

    </div><!-- #primary -->

    <?php // get_sidebar(); ?>
</div><!-- #page-wrap -->


<?php get_footer(); ?>

<span id="inifiniteLoader"><i class="fa fa-circle-o-notch"></i> Loading...</span>
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
</script>
