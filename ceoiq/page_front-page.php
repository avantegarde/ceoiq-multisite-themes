<?php
/**
 * Template Name: Homepage - Residential
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ferus_core
 */

get_header(); ?>

<div id="primary" class="content-area page-body">
    <main id="main" class="site-main" role="main">

        <?php while (have_posts()) : the_post(); ?>
            <?php echo the_content(); ?>
        <?php endwhile; ?>

        <section class="home-listings">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="section-title lrg center">Listings</h3>
                        <?php echo get_property_search(); ?>
                    </div>
                    <?php echo do_shortcode('[property-list availability="yes"]'); ?>
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