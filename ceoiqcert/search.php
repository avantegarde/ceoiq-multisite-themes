<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Ferus_Core
 */

if(isset($_GET['search-type'])) {
    $type = $_GET['search-type'];
    if($type == 'blog-search') {
        load_template(TEMPLATEPATH . '/search-blog.php');
    } else {
        load_template(TEMPLATEPATH . '/search-default.php');
    }
} else {
    load_template(TEMPLATEPATH . '/search-default.php');
}
