<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Ferus_Core
 */

if (!is_active_sidebar('sidebar-1')) {
    return;
}
?>

<aside id="secondary" class="widget-area col-md-4" role="complementary">
    <div class="panel">
        <div class="panel-content">
            <?php dynamic_sidebar('sidebar-1'); ?>
        </div>
    </div>
</aside><!-- #secondary -->
