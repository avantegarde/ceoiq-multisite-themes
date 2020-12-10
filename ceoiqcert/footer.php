<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Ferus_Core
 */

?>

</div><!-- #content -->

<!-- Banner Bottom Widgets -->
<?php if ( is_active_sidebar( 'banner-bottom' ) ) : ?>
    <?php dynamic_sidebar( 'banner-bottom' ); ?>
<?php endif; ?>

<footer id="colophon" class="site-footer center" role="contentinfo">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <p class="copyright">
                    <?php echo 'Copyright &copy; ' . date('Y') . ' - ' . get_bloginfo( 'name' ); ?> <span class="hidden-xs">| </span><span class="hidden-sm"><br></span><a href="/terms-of-use/">Terms of Use</a> | <a href="/privacy-policy/">Privacy Policy</a>
                </p>
            </div>
        </div>
    </div><!-- .inner -->
</footer><!-- #colophon -->

</div><!-- #page -->

<?php if ( is_active_sidebar( 'workshop-modal' ) ) : ?>
    <div id="workshopModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <?php dynamic_sidebar( 'workshop-modal' ); ?>
                </div>
            </div><!-- .modal-content -->
        </div><!-- .modal-dialog -->
    </div><!-- .modal -->
<?php endif; ?>

<div id="loginModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <?php echo do_shortcode('[uwp_login]'); ?>
            </div>
        </div><!-- .modal-content -->
    </div><!-- .modal-dialog -->
</div><!-- .modal -->

<?php wp_footer(); ?>
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri() . '/js/EQCSS-polyfills.min.js'?>"></script><![endif]-->
</body>
</html>
