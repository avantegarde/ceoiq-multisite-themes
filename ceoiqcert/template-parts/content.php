<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Ferus_Core
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('single-post'); ?>>
    <div class="entry-wrap">

        <header class="entry-header">
            <?php
            if ( is_single() ) :
                the_title( '<h1 class="entry-title">', '</h1>' );
            else :
                the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
            endif;

            if ( 'post' === get_post_type() ) : ?>
                <div class="entry-meta">
                    <p class="date-author">
                        <span class="date"><?php echo the_date('d-m-Y'); ?></span> |
                        <span class="author">Author: <a href="<?php echo site_url('/?search-type=blog-search&s=&cat=0&author='); ?><?php the_author_meta('ID'); ?>"><?php the_author(); ?></a></span>
                    </p>
                    <?php // ferus_core_posted_on(); ?>
                </div><!-- .entry-meta -->
                <?php
            endif; ?>
        </header><!-- .entry-header -->

        <div class="entry-content">
            <?php
            the_content( sprintf(
            /* translators: %s: Name of current post. */
                wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'ferus_core' ), array( 'span' => array( 'class' => array() ) ) ),
                the_title( '<span class="screen-reader-text">"', '"</span>', false )
            ) );

            wp_link_pages( array(
                'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'ferus_core' ),
                'after'  => '</div>',
            ) );
            ?>
        </div><!-- .entry-content -->
    </div>

</article><!-- #post-## -->
