<?php
/**
 * Template Name: Landing Page
 *
 * The default full-width template
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Ferus_Core
 */

get_header(); ?>

<?php while (have_posts()) : the_post(); ?>
    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">

        <?php the_content(); ?>

        </main><!-- #main -->
    </div><!-- #primary -->
<?php endwhile; // End of the loop. ?>

<?php
get_footer();
