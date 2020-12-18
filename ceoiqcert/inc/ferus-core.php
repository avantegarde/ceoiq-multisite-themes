<?php
/**
 * Add async and defer attributes to enqueued scripts where needed.
 */
/* function my_async_scripts( $tag, $handle, $src ) {
    // the handles of the enqueued scripts we want to async
    $async_scripts = array( 'ferus-core-ga-maps', );

    if ( in_array( $handle, $async_scripts ) ) {
        return '<script type="text/javascript" src="' . $src . '" async defer></script>' . "\n";
    }

    return $tag;
}
add_filter( 'script_loader_tag', 'my_async_scripts', 10, 3 ); */

/******************************************************************************/
/* Enqueue Styles and Scripts */
/******************************************************************************/
function ferus_core_enqueue_custom_scripts() {
    /* CSS */
    wp_enqueue_style('lato', 'https://fonts.googleapis.com/css?family=Lato:300,400,400i,700,700i');
    //wp_enqueue_style('theme-font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    wp_enqueue_style('ferus-core-bootstrap-css', get_template_directory_uri() . '/css/bootstrap.min.css');
    wp_enqueue_style('slick-style', get_template_directory_uri() . '/css/slick.css');
    wp_enqueue_style('slick-theme-style', get_template_directory_uri() . '/css/slick-theme.css');
    //wp_enqueue_style('lightbox-css', get_template_directory_uri() . '/css/lightbox.min.css');
    wp_enqueue_style('featherlight', get_template_directory_uri() . '/css/featherlight.min.css');
    wp_enqueue_style('featherlight-gallery', get_template_directory_uri() . '/css/featherlight.gallery.min.css');
    wp_enqueue_style('ferus-core-default-style', get_template_directory_uri() . '/css/ferus-core.css');
    wp_enqueue_style('ferus-core-custom-style', get_template_directory_uri() . '/css/custom.css');
    wp_enqueue_style('animate-css', get_template_directory_uri() . '/css/animate.min.css');
    if ( is_page_template( 'page_calculator.php' ) ) {
        wp_enqueue_style('KJE', get_template_directory_uri() . '/css/KJE.css');
        wp_enqueue_style('KJE-specific', get_template_directory_uri() . '/css/KJESiteSpecific.css');
    }
    if ( is_page_template( 'page_dashboard.php' ) ) {
        wp_enqueue_script('jscalendar', get_template_directory_uri() . '/js/jsCalendar.min.js', array(), 1.0, true);
        wp_enqueue_style('jscalendar', get_template_directory_uri() . '/css/jsCalendar.min.css');
    }
    /* JS */
    //wp_enqueue_script('ferus-core-bootstrap-js', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), 1.0, true);
    wp_enqueue_script('ferus-core-slick', get_template_directory_uri() . '/js/slick.min.js', array('jquery'), 1.0, true);
    //wp_enqueue_script('ferus-core-lightbox', get_template_directory_uri() . '/js/lightbox.min.js', array('jquery'), 1.0, true);
    wp_enqueue_script('ferus-core-featherlight', get_template_directory_uri() . '/js/featherlight.min.js', array('jquery'), 1.0, true);
    wp_enqueue_script('ferus-core-featherlight-gallery', get_template_directory_uri() . '/js/featherlight.gallery.min.js', array('jquery'), 1.0, true);
    wp_enqueue_script('ferus-core-eqcss', get_template_directory_uri() . '/js/EQCSS.min.js', array(), 1.0, true);
    wp_enqueue_script('ferus-core-masonry', get_template_directory_uri() . '/js/masonry.pkgd.min.js', array('jquery'), 1.0, true);
    //wp_enqueue_script('ferus-core-ga-maps', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyBohpt4_O_uzCiTYWnxxWT-CXJ2-SIsGWY&libraries=places&callback=initMap', array('jquery'), 1.0, true);
    wp_enqueue_script('ferus-core-custom-script', get_template_directory_uri() . '/js/ferus-core.js', array('jquery'), 1.0, true);

}

add_action('wp_enqueue_scripts', 'ferus_core_enqueue_custom_scripts');

/* Admin Styles and Scripts */
function ferus_core_enqueue_custom_admin_scripts() {
    wp_enqueue_style('ferus_core-custom-admin-style', get_template_directory_uri() . '/css/ferus-core-admin.css');
}

add_action('admin_enqueue_scripts', 'ferus_core_enqueue_custom_admin_scripts');

/**
 * Bloack wp-admin access to all users except admins
 */
/*add_action( 'init', 'blockusers_init' );
function blockusers_init() {
    if ( is_admin() && ! current_user_can( 'administrator' ) &&
        ! ( defined( 'DOING_AJAX' ) && DOING_AJAX ) ) {
        wp_redirect( home_url() );
        exit;
    }
}*/

/**
 * Disable Admin Bar for all users but admin
 */
add_action('after_setup_theme', 'remove_admin_bar');

function remove_admin_bar() {
    if (!current_user_can('administrator') && !is_admin()) {
        show_admin_bar(false);
    }
}

/**
 * Redirect logged out users to the login page
 * &
 * Redirect the login page to landlord members for logged in users
 */
/* add_action( 'template_redirect', 'redirect_logged_out_users' );

function redirect_logged_out_users() {

    if ( is_page('landlord-members') && ! is_user_logged_in() ) {
        wp_redirect( '/login/' );
        exit;
    } else if ( is_page('owner-members') && ! is_user_logged_in() ) {
        wp_redirect( '/login/' );
        exit;
    } else if ( is_page('login') && is_user_logged_in() ) {
        wp_redirect( '/owner-members/' );
        exit;
    }
} */
/**
 * Add Post Formats to posts
 */
add_theme_support( 'post-formats', array( 'image', 'quote', 'video', 'audio', 'chat' ) );

/**
 * Disable WYSIWYG for pages
 */
add_filter( 'user_can_richedit', 'patrick_user_can_richedit');

function patrick_user_can_richedit($c) {
    global $post_type;

    if ('page' == $post_type)
        return false;
    return $c;
}

/**
 * Register Custom Image Sizes
 */
add_image_size('slider-thumb', 200, 100, array('center', 'center')); // Hard crop center

// Remove auto p from content (needed for proper html content in pages)
//remove_filter( 'the_content', 'wpautop' );
//remove_filter( 'the_excerpt', 'wpautop' );
function remove_wpautop_on_pages() {
    if ( is_page() ) {
        remove_filter( 'the_content', 'wpautop' );
        remove_filter( 'the_excerpt', 'wpautop' );
    }
}
add_action( 'wp_head', 'remove_wpautop_on_pages' );

/**
 * Register Menu Locations
 */
register_nav_menus( array(
    'footer' => 'Footer',
    'menu404' => '404 Page'
) );

/**
 * Append Search to Menu
 */
/*add_filter('wp_nav_menu_items','add_search_box_to_menu', 10, 2);
function add_search_box_to_menu( $items, $args ) {
    if( $args->theme_location == 'menu-1' )
        return $items."<li class='menu-header-search'><form action='http://example.com/' id='searchform' method='get'><input type='text' name='s' id='s' placeholder='Search'></form></li>";

    return $items;
}*/

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function ferus_core_sidebar_init() {
    register_sidebar( array(
        'name'          => __( 'Sidebar Left', 'ferus_core' ),
        'id'            => 'sidebar-2',
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '<!-- ',
        'after_title'   => ' -->',
    ) );
    register_sidebar( array(
        'name'          => __( 'Toolbar', 'ferus_core' ),
        'id'            => 'toolbar',
        'before_widget' => '<div class="widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<!-- ',
        'after_title'   => ' -->',
    ) );
    register_sidebar( array(
        'name'          => __( 'Page Header', 'ferus_core' ),
        'id'            => 'page-header',
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '<!-- ',
        'after_title'   => ' -->',
    ) );
    register_sidebar( array(
        'name'          => __( 'Page Top', 'ferus_core' ),
        'id'            => 'page-top',
        'before_widget' => '<div id="%1$s" class="%2$s '. ferus_core_widget_count('page-top') .'">',
        'after_widget'  => '</div>',
        'before_title'  => '<!-- ',
        'after_title'   => ' -->',
    ) );
    register_sidebar( array(
        'name'          => __( 'Page Inner-Top', 'ferus_core' ),
        'id'            => 'inner-top',
        'before_widget' => '<div id="%1$s" class="%2$s '. ferus_core_widget_count('inner-top') .'">',
        'after_widget'  => '</div>',
        'before_title'  => '<!-- ',
        'after_title'   => ' -->',
    ) );
    register_sidebar( array(
        'name'          => __( 'Page Inner-Bottom', 'ferus_core' ),
        'id'            => 'inner-bottom',
        'before_widget' => '<div id="%1$s" class="%2$s '. ferus_core_widget_count('inner-bottom') .'">',
        'after_widget'  => '</div>',
        'before_title'  => '<!-- ',
        'after_title'   => ' -->',
    ) );
    register_sidebar( array(
        'name'          => __( 'Page Bottom', 'ferus_core' ),
        'id'            => 'page-bottom',
        'before_widget' => '<div id="%1$s" class="%2$s '. ferus_core_widget_count('page-bottom') .'">',
        'after_widget'  => '</div>',
        'before_title'  => '<!-- ',
        'after_title'   => ' -->',
    ) );
    register_sidebar( array(
        'name'          => __( 'Banner Bottom', 'ferus_core' ),
        'id'            => 'banner-bottom',
        'before_widget' => '<div id="%1$s" class="%2$s '. ferus_core_widget_count('banner-bottom') .'">',
        'after_widget'  => '</div>',
        'before_title'  => '<!-- ',
        'after_title'   => ' -->',
    ) );
    register_sidebar( array(
        'name'          => __( 'Profile Intro', 'ferus_core' ),
        'id'            => 'profile-intro',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<!-- ',
        'after_title'   => ' -->',
    ) );
    register_sidebar( array(
        'name'          => __( 'Profile Sidebar', 'ferus_core' ),
        'id'            => 'profile-sidebar',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<!-- ',
        'after_title'   => ' -->',
    ) );
    /*register_sidebar( array(
        'name'          => __( 'Footer Left', 'ferus_core' ),
        'id'            => 'footer-left',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<!-- ',
        'after_title'   => ' -->',
    ) );
    register_sidebar( array(
        'name'          => __( 'Footer Right', 'ferus_core' ),
        'id'            => 'footer-right',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<!-- ',
        'after_title'   => ' -->',
    ) );*/
    register_sidebar( array(
        'name'          => __( 'Workshop Modal', 'ferus_core' ),
        'id'            => 'workshop-modal',
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '<!-- ',
        'after_title'   => ' -->',
    ) );
    register_sidebar( array(
        'name'          => __( 'Virtual Programs Modal', 'ferus_core' ),
        'id'            => 'vprogram-modal',
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '<!-- ',
        'after_title'   => ' -->',
    ) );
}

add_action('widgets_init', 'ferus_core_sidebar_init');

/**
 * Remove wpautop from widgets
 */
add_filter( 'widget_display_callback', 'widget_wpautop_widget_display_callback', 10, 3 );
function widget_wpautop_widget_display_callback( $instance, $widget, $args ) {
    $instance['filter'] = false;
    return $instance;
}

/**
 * Count number of widgets in a sidebar
 * Used to add classes to widget areas so widgets can be displayed one, two, three or four per row
 */
function ferus_core_widget_count( $sidebar_id ) {
    // If loading from front page, consult $_wp_sidebars_widgets rather than options
    // to see if wp_convert_widget_settings() has made manipulations in memory.
    global $_wp_sidebars_widgets;
    if ( empty( $_wp_sidebars_widgets ) ) :
        $_wp_sidebars_widgets = get_option( 'sidebars_widgets', array() );
    endif;

    $sidebars_widgets_count = $_wp_sidebars_widgets;

    if ( isset( $sidebars_widgets_count[ $sidebar_id ] ) ) :
        $widget_count = count( $sidebars_widgets_count[ $sidebar_id ] );
        $widget_classes = 'widget-count-' . count( $sidebars_widgets_count[ $sidebar_id ] );
        if ( $widget_count % 4 == 0 || $widget_count > 6 ) :
            // Four widgets per row if there are exactly four or more than six
            $widget_classes .= ' widget-col-4';
        elseif ( $widget_count >= 3 ) :
            // Three widgets per row if there's three or more widgets
            $widget_classes .= ' widget-col-3';
        elseif ( 2 == $widget_count ) :
            // Otherwise show two widgets per row
            $widget_classes .= ' widget-col-2';
        endif;

        return $widget_classes;
    endif;
}

/**
 * Enable Shortcodes in Widgets
 */
add_filter('widget_text', 'do_shortcode');

/**
 * Return the widget title only if the first character is not "!"
 */
add_filter('widget_title', 'remove_widget_title');
function remove_widget_title($widget_title) {
    if (substr($widget_title, 0, 1) == '!')
        return;
    else
        return ($widget_title);
}

/**
 * Truncate Titles
 */
function FeaturedTitle($text) {
    $chars_limit = 100;
    $chars_text = strlen($text);
    $text = $text . " ";
    $text = substr($text, 0, $chars_limit);
    $text = substr($text, 0, strrpos($text, ' '));

    if ($chars_text > $chars_limit) {
        $text = $text . "...";
    }
    return $text;
}

/**
 * Truncates text.
 *
 * Cuts a string to the length of $length and replaces the last characters
 * with the ending if the text is longer than length.
 *
 * @param string  $text String to truncate.
 * @param integer $length Length of returned string, including ellipsis.
 * @param string  $ending Ending to be appended to the trimmed string.
 * @param boolean $exact If false, $text will not be cut mid-word
 * @param boolean $considerHtml If true, HTML tags would be handled correctly
 * @return string Trimmed string.
 *
 * Usage:
 * $excerpt_length = 250;
 * $content = apply_filters('the_content', get_the_content());
 * $excerpt = truncate( $content, $excerpt_length, '', false, true );
 *
 */
function truncate($text, $length = 100, $ending = '...', $exact = true, $considerHtml = false) {
    if ($considerHtml) {
        // if the plain text is shorter than the maximum length, return the whole text
        if (strlen(preg_replace('/<.*?>/', '', $text)) <= $length) {
            return $text;
        }

        // splits all html-tags to scanable lines
        preg_match_all('/(<.+?>)?([^<>]*)/s', $text, $lines, PREG_SET_ORDER);

        $total_length = strlen($ending);
        $open_tags = array();
        $truncate = '';

        foreach ($lines as $line_matchings) {
            // if there is any html-tag in this line, handle it and add it (uncounted) to the output
            if (!empty($line_matchings[1])) {
                // if it's an "empty element" with or without xhtml-conform closing slash (f.e. <br/>)
                if (preg_match('/^<(\s*.+?\/\s*|\s*(img|br|input|hr|area|base|basefont|col|frame|isindex|link|meta|param)(\s.+?)?)>$/is', $line_matchings[1])) {
                    // do nothing
                    // if tag is a closing tag (f.e. </b>)
                } else if (preg_match('/^<\s*\/([^\s]+?)\s*>$/s', $line_matchings[1], $tag_matchings)) {
                    // delete tag from $open_tags list
                    $pos = array_search($tag_matchings[1], $open_tags);
                    if ($pos !== false) {
                        unset($open_tags[$pos]);
                    }
                    // if tag is an opening tag (f.e. <b>)
                } else if (preg_match('/^<\s*([^\s>!]+).*?>$/s', $line_matchings[1], $tag_matchings)) {
                    // add tag to the beginning of $open_tags list
                    array_unshift($open_tags, strtolower($tag_matchings[1]));
                }
                // add html-tag to $truncate'd text
                $truncate .= $line_matchings[1];
            }

            // calculate the length of the plain text part of the line; handle entities as one character
            $content_length = strlen(preg_replace('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|&#x[0-9a-f]{1,6};/i', ' ', $line_matchings[2]));
            if ($total_length+$content_length> $length) {
                // the number of characters which are left
                $left = $length - $total_length;
                $entities_length = 0;
                // search for html entities
                if (preg_match_all('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|&#x[0-9a-f]{1,6};/i', $line_matchings[2], $entities, PREG_OFFSET_CAPTURE)) {
                    // calculate the real length of all entities in the legal range
                    foreach ($entities[0] as $entity) {
                        if ($entity[1]+1-$entities_length <= $left) {
                            $left--;
                            $entities_length += strlen($entity[0]);
                        } else {
                            // no more characters left
                            break;
                        }
                    }
                }
                $truncate .= substr($line_matchings[2], 0, $left+$entities_length);
                // maximum lenght is reached, so get off the loop
                break;
            } else {
                $truncate .= $line_matchings[2];
                $total_length += $content_length;
            }

            // if the maximum length is reached, get off the loop
            if($total_length>= $length) {
                break;
            }
        }
    } else {
        if (strlen($text) <= $length) {
            return $text;
        } else {
            $truncate = substr($text, 0, $length - strlen($ending));
        }
    }

    // if the words shouldn't be cut in the middle...
    if (!$exact) {
        // ...search the last occurance of a space...
        $spacepos = strrpos($truncate, ' ');
        if (isset($spacepos)) {
            // ...and cut the text in this position
            $truncate = substr($truncate, 0, $spacepos);
        }
    }

    // add the defined ending to the text
    $truncate .= $ending;

    if($considerHtml) {
        // close all unclosed html-tags
        foreach ($open_tags as $tag) {
            $truncate .= '</' . $tag . '>';
        }
    }

    return $truncate;

}

/**
 * Remove "Private" and "Protected" from post and page titles
 * @param $title
 * @return mixed
 */
/* function the_title_trim_private($title) {
    $title = attribute_escape($title);
    $findthese = array(
        '#Protected:#',
        '#Private:#'
    );
    $replacewith = array(
        '',
        ''
    );
    $title = preg_replace($findthese, $replacewith, $title);
    return $title;
}
add_filter('the_title', 'the_title_trim_private'); */

/**
 * Search Filter - remove specific pages from search
 */
/*function page_search_filter( $query ) {
  if ( $query->is_search && $query->is_main_query() ) {
    $query->set( 'post__not_in', array( 63,65,88,90 ) );
  }
}
add_action( 'pre_get_posts', 'page_search_filter' );*/

/**
 * Featured Image in admin post list
 */
add_filter('manage_posts_columns', 'add_thumbnail_column', 5);

function add_thumbnail_column($columns) {
    $columns['new_post_thumb'] = __('Featured Image');
    return $columns;
}

add_action('manage_posts_custom_column', 'display_thumbnail_column', 5, 2);

function display_thumbnail_column($column_name, $post_id) {
    switch ($column_name) {
        case 'new_post_thumb':
            $post_thumbnail_id = get_post_thumbnail_id($post_id);
            if ($post_thumbnail_id) {
                $post_thumbnail_img = wp_get_attachment_image_src($post_thumbnail_id, 'thumbnail');
                echo '<img width="100" src="' . $post_thumbnail_img[0] . '" />';
            }
            break;
    }
}
/******************************************************************************
 * Featured Image Header Height Meta Box
 * Display/Hide the Page Title
 ******************************************************************************/
function header_height_get_meta( $value ) {
    global $post;

    $field = get_post_meta( $post->ID, $value, true );
    if ( ! empty( $field ) ) {
        return is_array( $field ) ? stripslashes_deep( $field ) : stripslashes( wp_kses_decode_entities( $field ) );
    } else {
        return false;
    }
}

function header_height_add_meta_box() {
    add_meta_box(
        'header_height-header-height',
        __( 'Header Height', 'header_height' ),
        'header_height_html',
        'page',
        'side',
        'default'
    );
}
add_action( 'add_meta_boxes', 'header_height_add_meta_box' );

function header_height_html( $post) {
    wp_nonce_field( '_header_height_nonce', 'header_height_nonce' ); ?>

    <p>Change the height of the header image.</p>

    <p>
    <label for="header_height_size"><?php _e( 'Size', 'header_height' ); ?></label><br>
    <select name="header_height_size" id="header_height_size">
        <option <?php echo (header_height_get_meta( 'header_height_size' ) === 'Normal' ) ? 'selected' : '' ?>>Normal</option>
        <option <?php echo (header_height_get_meta( 'header_height_size' ) === 'Narrow' ) ? 'selected' : '' ?>>Narrow</option>
        <option <?php echo (header_height_get_meta( 'header_height_size' ) === 'Tall' ) ? 'selected' : '' ?>>Tall</option>
        <option <?php echo (header_height_get_meta( 'header_height_size' ) === 'None' ) ? 'selected' : '' ?>>None</option>
    </select>
    </p><?php
}

function header_height_save( $post_id ) {
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( ! isset( $_POST['header_height_nonce'] ) || ! wp_verify_nonce( $_POST['header_height_nonce'], '_header_height_nonce' ) ) return;
    if ( ! current_user_can( 'edit_post', $post_id ) ) return;


    if ( isset( $_POST['header_height_size'] ) )
        update_post_meta( $post_id, 'header_height_size', esc_attr( $_POST['header_height_size'] ) );
    else
        update_post_meta( $post_id, 'header_height_size', null );
}
add_action( 'save_post', 'header_height_save' );

/*
  Usage: header_height_get_meta( 'header_height_size' )
*/

/******************************************************************************
 * Custom Header Content Meta Box
 ******************************************************************************/
function custom_header_content_get_meta( $value ) {
    global $post;

    $field = get_post_meta( $post->ID, $value, true );
    if ( ! empty( $field ) ) {
        return is_array( $field ) ? stripslashes_deep( $field ) : stripslashes( wp_kses_decode_entities( $field ) );
    } else {
        return false;
    }
}

function ferus_create_custom_header_content( $post ) {

    do_meta_boxes( null, 'custom-header-content', $post );
}
add_action( 'edit_form_after_title', 'ferus_create_custom_header_content' );

function ferus_add_custom_header_content_box() {
    add_meta_box(
        'custom_header_content',
        __( 'Custom Header Content', 'custom_header_content' ),
        'ferus_render_header_metabox',
        'page',
        'custom-header-content'
    );
}
add_action( 'add_meta_boxes', 'ferus_add_custom_header_content_box' );

function ferus_render_header_metabox( $post ) {
    wp_nonce_field( '_custom_header_content_nonce', 'custom_header_content_nonce' ); ?>
    <div class="ferus-admin-group">
        <label for="custom_header_content_title"><?php _e( 'Title', 'custom_header_content' ); ?></label>
        <input type="text" name="custom_header_content_title" id="custom_header_content_title" value="<?php echo custom_header_content_get_meta( 'custom_header_content_title' ); ?>">
    </div>
    <div class="ferus-admin-group">
        <label for="custom_header_content_content"><?php _e( 'Content', 'custom_header_content' ); ?></label>
        <textarea name="custom_header_content_content" id="custom_header_content_content" rows="5"><?php echo custom_header_content_get_meta( 'custom_header_content_content' ); ?></textarea>
    </div>
    <div class="ferus-admin-group">
        <label>Content Location</label>
        <ul class="custom-content-location">
            <li>
                <input type="radio" name="custom_header_content_location" id="custom_content_location_0" value="content-center" checked>
                <label for="custom_content_location_0">Center</label>
            </li>
            <li>
                <input type="radio" name="custom_header_content_location" id="custom_content_location_1" value="content-left" <?php echo ( custom_header_content_get_meta( 'custom_header_content_location' ) === 'content-left' ) ? 'checked' : ''; ?>>
                <label for="custom_content_location_1">Left</label>
            </li>
            <li>
                <input type="radio" name="custom_header_content_location" id="custom_content_location_2" value="content-right" <?php echo ( custom_header_content_get_meta( 'custom_header_content_location' ) === 'content-right' ) ? 'checked' : ''; ?>>
                <label for="custom_content_location_2">Right</label>
            </li>
        </ul>
    </div>
    <?php
}

function custom_header_content_save( $post_id ) {
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( ! isset( $_POST['custom_header_content_nonce'] ) || ! wp_verify_nonce( $_POST['custom_header_content_nonce'], '_custom_header_content_nonce' ) ) return;
    if ( ! current_user_can( 'edit_post', $post_id ) ) return;

    if ( isset( $_POST['custom_header_content_title'] ) )
        update_post_meta( $post_id, 'custom_header_content_title', esc_attr( $_POST['custom_header_content_title'] ) );
    if ( isset( $_POST['custom_header_content_content'] ) )
        update_post_meta( $post_id, 'custom_header_content_content', esc_attr( $_POST['custom_header_content_content'] ) );
    if ( isset( $_POST['custom_header_content_location'] ) )
        update_post_meta( $post_id, 'custom_header_content_location', esc_attr( $_POST['custom_header_content_location'] ) );
}
add_action( 'save_post', 'custom_header_content_save' );

/*
	Usage: custom_header_content_get_meta( 'custom_header_content_title' )
	Usage: custom_header_content_get_meta( 'custom_header_content_content' )
    Usage: custom_header_content_get_meta( 'custom_header_content_location' )
*/
/******************************************************************************
 * Featured Articles Shortcode
 ******************************************************************************/
function featured_articles_shortcode($atts, $content = null) {
    ob_start();
    global $post;
    // Attributes
    extract(shortcode_atts(
            array(
                'posts' => '4',
                'category' => '',
                'author' => '',
            ), $atts)
    );

    // Code
    $recent_args = array(
        'post_type' => 'post',
        'category_name' => $category,
        'author_name' => $author,
        'posts_per_page' => $posts,
        'order' => 'DESC'
    );
    $recent_query = new WP_Query($recent_args); ?>
    <div class="featured-articles">
        <?php if ($recent_query->have_posts()) : ?>

            <?php while ( $recent_query->have_posts() ) : $recent_query->the_post(); ?>
                <?php
                // Get Image
                $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'post-med');
                if ($image) {
                    $image = $image[0];
                } else {
                    $image = '/wp-content/themes/ceoiq/inc/images/hero.jpg';
                }
                // Get Post Format
                $format = get_post_format() ?: 'standard';
                ?>
                <article id="post-<?php echo $post->ID; ?>" class="post-<?php echo $post->ID; ?> post-inner">

                    <a class="post-thumb" href="<?php echo get_permalink($post->ID); ?>" style="background-image: url(<?php echo $image; ?>);"></a><!-- .post-thumb -->

                    <div class="post-content">
                        <p class="author-date"><span class="author"><?php the_author(); ?></span> | <?php the_time('F d, Y'); ?></p>
                        <h2 class="post-title">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h2>
                        <!-- <p class="content-blurb">
                    <?php //echo wp_trim_words(get_the_content(), 13, '...'); ?>
                </p> -->
                        <!-- <a href="<?php // the_permalink(); ?>" data-button="arrow">Read More</a> -->
                    </div>

                </article>
            <?php endwhile; wp_reset_postdata(); ?>
        <?php else : ?>
            <div class="col-md-12 center">
                <p>Sorry! No posts found within your criteria.</p>
            </div>
        <?php endif; ?>
    </div><!-- .container -->
    <?php
    $output = ob_get_clean();
    return $output;
}

add_shortcode('featured-articles', 'featured_articles_shortcode');
/******************************************************************************
 * Must Reads Shortcode
 ******************************************************************************/
function must_reads_shortcode($atts, $content = null) {
    ob_start();
    global $post;
    // Attributes
    extract(shortcode_atts(
            array(
                'posts' => '4',
                'category' => '',
            ), $atts)
    );

    // Code
    $recent_args = array(
        'post_type' => 'post',
        'category_name' => $category,
        'posts_per_page' => $posts,
        'order' => 'DESC'
    );
    $recent_query = new WP_Query($recent_args); ?>
    <div class="must-reads-wrap container">
    <div class="row">
    <?php if ($recent_query->have_posts()) : ?>
        <?php
        $postCount = $recent_args['posts_per_page'];
        $columnWidth = 'col-sm-6 col-md-3';
        if ($postCount === '1') {
            $columnWidth = 'col-md-12';
        } else if ($postCount === '2') {
            $columnWidth = 'col-sm-12 col-md-6';
        } else if ($postCount === '3' || $postCount === '6') {
            $columnWidth = 'col-sm-12 col-md-4';
        }
        ?>

        <?php while ( $recent_query->have_posts() ) : $recent_query->the_post(); ?>
            <?php
            // Get Image
            $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'post-med');
            if ($image) {
                $image = $image[0];
            } else {
                $image = '/wp-content/themes/ceoiq/inc/images/hero.jpg';
            }
            // Get Post Format
            $format = get_post_format() ?: 'standard';
            ?>
            <div class="article <?php echo $columnWidth; ?> <?php echo $format; ?>" data-col="post-item">
                <article id="post-<?php echo $post->ID; ?>" class="post-<?php echo $post->ID; ?> post-inner">

                    <!-- <div class="category">
                        <?php // the_category(' | ', '', $post->ID); ?>
                    </div> -->

                    <a class="post-thumb" href="<?php echo get_permalink($post->ID); ?>" style="background-image: url(<?php echo $image; ?>);">
                        <!-- <div class="post-format">
                    <?php if ($format === 'case-study' || $format === 'quote'): ?>
                        <i class="fa fa-pie-chart"></i> <span>Case Study</span>
                    <?php elseif ($format === 'infographic' || $format === 'image'): ?>
                        <i class="fa fa-bar-chart"></i> <span>Infographic</span>
                    <?php elseif ($format === 'video'): ?>
                        <i class="fa fa-play-circle-o"></i> <span>Video</span>
                    <?php else: ?>
                    <?php endif; ?>
                </div> -->
                    </a><!-- .post-thumb -->

                    <div class="post-content">
                        <p class="author-date"><span class="author"><?php the_author(); ?></span> | <?php the_time('F d, Y'); ?></p>
                        <h2 class="post-title">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h2>
                        <!-- <p class="content-blurb">
                            <?php //echo wp_trim_words(get_the_content(), 13, '...'); ?>
                        </p> -->
                        <!-- <a href="<?php // the_permalink(); ?>" data-button="arrow">Read More</a> -->
                    </div>

                </article>
            </div><!-- .post-item -->
        <?php endwhile; wp_reset_postdata(); ?>
    <?php else : ?>
        <div class="col-md-12 center">
            <p>Sorry! No posts found within your criteria.</p>
        </div>
    <?php endif; ?>
    </div><!-- .row -->
    </div><!-- .container -->
    <?php
    $output = ob_get_clean();
    return $output;
}

add_shortcode('must-reads', 'must_reads_shortcode');
/******************************************************************************
 * Resources Shortcode
 ******************************************************************************/
function ceoiq_resources_shortcode($atts, $content = null) {
    switch_to_blog(1);
    ob_start();
    // Attributes
    extract(shortcode_atts(
            array(
                'posts' => '-1',
                'group' => '',
                'cat' => '',
            ), $atts)
    );

    // Code
    $resource_args = array(
        'post_type' => 'resources',
        //'tag' => '',
        'meta_key' => 'ceoiq_resource_type',
        'meta_value' => $cat,
        'tax_query' => array(
            array(
                'taxonomy' => 'resource_cat',
                'field'    => 'slug',
                'terms'    => $group,
            ),
        ),
        'posts_per_page' => -1,
        'order' => 'DESC',
    );
    $resource_query = new WP_Query($resource_args); ?>
    <ul class="icon-list <?php echo $cat; ?>">
    <?php if ($resource_query->have_posts()) : ?>
        <?php while ( $resource_query->have_posts() ) : $resource_query->the_post(); ?>
            <?php
            global $post;
            // Get Image
            $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'post-med');
            if ($image) {
                $image = $image[0];
            } else {
                $image = '/wp-content/themes/ceoiq/inc/images/hero.jpg';
            }
            // Resource Details
            $r_type = get_field('ceoiq_resource_type');
            $r_external = get_field('ceoiq_resource_external');
            $r_file = get_field('ceoiq_resource_file');
            $r_desc = get_field('ceoiq_resource_description');
            if($r_external === 'yes') {
                $r_url = get_field('ceoiq_resource_url');
            } else {
                $r_url = $r_file['url'];
            }
            if($r_type === 'video') {
                // build video link with popup video
                $r_video_source = get_field('ceoiq_resource_video_source');
                $r_video_ID = get_field('ceoiq_resource_video_id');
                $r_url = '';
                if ($r_video_source === 'youtube') {
                    $r_video_url = 'https://www.youtube.com/embed/'.$r_video_ID.'?rel=0&modestbranding=1&showinfo=0';
                } elseif ($r_video_source === 'vimeo') {
                    $r_video_url = 'https://player.vimeo.com/video/'.$r_video_ID.'?color=069e24&title=0&byline=0&portrait=0';
                } else {
                    $r_video_url = get_field('ceoiq_resource_url');
                }
                $resource_link = '<a class="video-toggle" href="" data-toggle="modal" data-target="#video-'.$post->ID.'">'.get_the_title().'</a>';
            } else {
                $resource_link = '<a href="'.$r_url.'" target="_blank" rel="noopener noreferrer">'.get_the_title().'</a>';
            }
            ?>
            <li>
                <?php echo $resource_link; ?>
                <p><?php echo $r_desc; ?></p>
                <?php if ($r_type === 'video') : ?>
                    <div id="video-<?php echo $post->ID ?>" class="modal fade video-modal" tabindex="-1" role="dialog" data-url="<?php echo $r_video_url; ?>">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <iframe id="resource-iframe" src="<?php echo $r_video_url; ?>" width="720" height="480" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->
                <?php endif; ?>
            </li>
        <?php endwhile; wp_reset_postdata(); ?>
    <?php else : ?>
        <div>
            <p>Sorry! No resources found within your criteria.</p>
        </div>
    <?php endif; ?>
    </ul><!-- .resources-wrap -->
    <?php if($cat === 'video') : ?>
    <script>
    // Remove & Replace iframe url to stop video when closing popup
    jQuery(document).ready(function($) {
        $('a.video-toggle').click(function(e) {
            var target = $(this).data('target');
            var video = $(target).find('iframe');
            var url = $(target).data('url');
            showModal(target, video, url);
        } );
        function showModal(target, video, url) {
            $(target).on('show.bs.modal', function() { 
                $(video).attr('src', url);
                hideModal(target, video, url);
            });
        }
        function hideModal(target, video, url) {
            $(target).on('hide.bs.modal', function() { 
                $(video).attr('src', '');
            }); 
        }
    }); 
    </script>
    <?php endif; ?>
    <?php
    restore_current_blog();
    $output = ob_get_clean();
    return $output;
}
add_shortcode('ceoiq-resources', 'ceoiq_resources_shortcode');
/******************************************************************************
 * Content Slider Shortcode
 ******************************************************************************/
function content_slider_shortcode($atts, $content = null) {
    ob_start();
    // Attributes
    extract(shortcode_atts(
            array(
                'posts' => '4',
                'category' => '',
            ), $atts)
    );

    // Code
    $recent_args = array(
        'post_type' => 'post',
        'category_name' => $category,
        'posts_per_page' => $posts,
        'order' => 'DESC'
    );
    $recent_query = new WP_Query($recent_args);
    if ($recent_query->have_posts()) : ?>
        <div class="content_slider content-slider">
            <?php while ( $recent_query->have_posts() ) : $recent_query->the_post(); ?>
                <?php
                $feat_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );
                $image = $feat_image[0] ? $feat_image[0] : get_template_directory_uri() . '/inc/images/hero.jpg';
                ?>
                <div>
                    <div class="col-md-7 content-img" data-col="content-slide">
                        <div class="img-wrap" style="background-image:url(<?php echo $image; ?>);"></div>
                        <!-- <img src="<?php //echo get_template_directory_uri(); ?>/inc/images/home-slide-01.jpg"> -->
                    </div>
                    <div class="col-md-5 slide-content" data-col="content-slide">
                        <p class="category"><?php the_category(' | ', '', $post->ID); ?></p>
                        <h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php echo the_title(); ?></a></h3>
                        <!-- <p class="entry-excerpt"><?php // echo wp_trim_words(get_the_excerpt(), 18, '...'); ?></p> -->
                        <p class="entry-excerpt"><?php echo get_the_excerpt(); ?></p>
                        <p class="read-more"><a href="<?php the_permalink(); ?>" data-button>Learn More</a></p>
                    </div>
                </div>
            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>
            <!-- <p class="see-all-posts"><a href="<?php // echo site_url(); ?>">See All Posts</a></p> -->
        </div><!-- .recent-posts -->
    <?php else : ?>
        <p>Sorry! No posts found within your criteria.</p>
    <?php endif;
    $output = ob_get_clean();
    return $output;
}

add_shortcode('content-slider', 'content_slider_shortcode');
/******************************************************************************
 * Portfolio Shortcode
 ******************************************************************************/
function portfolio_slider_shortcode($atts, $content = null) {
    ob_start();
    // Attributes
    extract(shortcode_atts(
            array(
                'posts' => '4',
                'category' => '',
                'content' => '',
            ), $atts)
    );

    $content_pos = $content?$content:'right';
    $pos_class = 'content-pos-' . $content_pos;

    // Code
    $recent_args = array(
        'post_type' => 'post',
        'category_name' => $category,
        'posts_per_page' => $posts,
        'order' => 'DESC'
    );
    $recent_query = new WP_Query($recent_args);
    if ($recent_query->have_posts()) : ?>
        <div class="content_slider content-slider <?php echo $pos_class; ?>">
            <?php while ( $recent_query->have_posts() ) : $recent_query->the_post(); ?>
                <?php
                $feat_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );
                $image = $feat_image[0] ? $feat_image[0] : get_template_directory_uri() . '/inc/images/hero.jpg';
                $company_url = get_post_meta( get_the_ID(), 'portfolio_url', true );
                $excerpt_length = 250;
                $content = apply_filters('the_content', get_the_content());
                $excerpt = truncate( $content, $excerpt_length, '...', false, true );
                ?>
                <div>
                <?php if($content_pos === 'left') : ?>
                    <div class="col-md-5 slide-content" data-col="content-slide">
                        <h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php echo the_title(); ?></a></h3>
                        <?php //if($company_url) : ?>
                            <!-- <a class="link" href="<?php //echo 'http://' . $company_url; ?>"><?php //echo $company_url; ?></a></a> -->
                        <?php //endif; ?>
                        <div class="entry-excerpt"><?php echo $excerpt; ?></div>
                        <p class="read-more"><a href="<?php the_permalink(); ?>" data-button>Learn More</a></p>
                    </div>
                    <div class="col-md-7 content-img" data-col="content-slide">
                        <div class="img-wrap" style="background-image:url(<?php echo $image; ?>);"></div>
                    </div>
                <?php else : ?>
                    <div class="col-md-7 content-img" data-col="content-slide">
                        <div class="img-wrap" style="background-image:url(<?php echo $image; ?>);"></div>
                    </div>
                    <div class="col-md-5 slide-content" data-col="content-slide">
                        <h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php echo the_title(); ?></a></h3>
                        <a class="link" href="<?php the_permalink(); ?>">www.website.com</a></a>
                        <div class="entry-excerpt"><?php echo $excerpt; ?></div>
                        <p class="read-more"><a href="<?php the_permalink(); ?>" data-button>Learn More</a></p>
                    </div>
                <?php endif; ?>
                </div>
            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>
            <!-- <p class="see-all-posts"><a href="<?php // echo site_url(); ?>">See All Posts</a></p> -->
        </div><!-- .recent-posts -->
    <?php else : ?>
        <p>Sorry! No posts found within your criteria.</p>
    <?php endif;
    $output = ob_get_clean();
    return $output;
}

add_shortcode('portfolio-slider', 'portfolio_slider_shortcode');
/******************************************************************************
 * Gallery Shortcode Re-format
 ******************************************************************************/
add_filter( 'post_gallery', 'my_post_gallery', 10, 2 );
function my_post_gallery( $output, $attr) {
    global $post, $wp_locale;

    static $instance = 0;
    $instance++;

    // We're trusting author input, so let's at least make sure it looks like a valid orderby statement
    if ( isset( $attr['orderby'] ) ) {
        $attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
        if ( !$attr['orderby'] )
            unset( $attr['orderby'] );
    }

    extract(shortcode_atts(array(
        'order'      => 'ASC',
        'orderby'    => 'menu_order ID',
        'id'         => $post->ID,
        'itemtag'    => 'div',
        'icontag'    => 'div',
        'captiontag' => 'div',
        'columns'    => 3,
        'size'       => 'thumbnail',
        'include'    => '',
        'exclude'    => '',
        'slideset'    => ''
    ), $attr));

    $id = intval($id);
    if ( 'RAND' == $order )
        $orderby = 'none';

    $slidesetClass = '';
    if ( $slideset == 'true')
        $slidesetClass = 'gallery-slideset';

    if ( !empty($include) ) {
        $include = preg_replace( '/[^0-9,]+/', '', $include );
        $_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

        $attachments = array();
        foreach ( $_attachments as $key => $val ) {
            $attachments[$val->ID] = $_attachments[$key];
        }
    } elseif ( !empty($exclude) ) {
        $exclude = preg_replace( '/[^0-9,]+/', '', $exclude );
        $attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
    } else {
        $attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
    }

    if ( empty($attachments) )
        return '';

    if ( is_feed() ) {
        $output = "\n";
        foreach ( $attachments as $att_id => $attachment )
            $output .= wp_get_attachment_link($att_id, $size, true) . "\n";
        return $output;
    }

    $itemtag = tag_escape($itemtag);
    $captiontag = tag_escape($captiontag);
    $columns = intval($columns);
    $itemwidth = $columns > 0 ? floor(100/$columns) : 100;
    $float = is_rtl() ? 'right' : 'left';

    $selector = "gallery-{$instance}";

    $output = apply_filters('gallery_style', "<div id='$selector' class='gallery galleryid-{$id} {$slidesetClass}'>");

    $i = 0;
    foreach ( $attachments as $id => $attachment ) {
        $img = isset($attr['link']) && 'file' == $attr['link'] ? wp_get_attachment_image($id, $size, false, false) : wp_get_attachment_image($id, $size, true, false);
        $link = isset($attr['link']) && 'file' == $attr['link'] ? wp_get_attachment_url($id) : wp_get_attachment_url($id);
        if ( $captiontag && trim($attachment->post_excerpt) ) {
            $caption = wptexturize($attachment->post_excerpt);
        }

        $output .= "<{$itemtag} class='gallery-item'>";
        $output .= "<a class='gallery-icon' href='". $link ."' data-lightbox='". $selector ."' data-title='" . $caption . "'>" . $img . "</a>";
        $output .= "</{$itemtag}>";
        if ( $columns > 0 && ++$i % $columns == 0 )
            $output .= '';
    }

    $output .= "</div>\n";

    return $output;
}

/******************************************************************************
 * Add Custom Query Vars
 * this is for searching custom variables in custom post types
 ******************************************************************************/
function add_query_vars_filter( $vars ){
    $vars[] = "format";
    //$vars[] .= "another";
    return $vars;
}
add_filter( 'query_vars', 'add_query_vars_filter' );

/**
 * Paginate Archive Index Page Links
 */
function get_pagination_links() {
    global $wp_query;
    $wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;

    return paginate_links( array(
        'base' => @add_query_arg('paged','%#%'),
        'format' => '?paged=%#%',
        'current' => $current,
        'total' => $wp_query->max_num_pages,
        'prev_next'    => false
    ) );
}
/******************************************************************************
 * Infinite Scroll Blogroll
 ******************************************************************************/
function wp_infinitepaginate(){
    $loopFile        = $_POST['loop_file'];
    $paged           = $_POST['page_no'];
    $posts_per_page  = get_option('posts_per_page');
    $searchText  = $_POST['s'];
    $category  = $_POST['cat'];
    $tag  = $_POST['tag'];
    $author  = $_POST['author'];
    $order = 'DESC';
    $post_type = 'post';
    $post_status = 'publish';

    # Load the posts
    query_posts(array('post_type' => $post_type, 'post_status' => $post_status, 'paged' => $paged, 's' => $searchText, 'cat' => $category, 'tag_id' => $tag, 'order' => $order, 'author' => $author ));
    get_template_part( $loopFile );

    exit;
}
add_action('wp_ajax_infinite_scroll', 'wp_infinitepaginate');
add_action('wp_ajax_nopriv_infinite_scroll', 'wp_infinitepaginate');
/**
 * Remove "Protected:" and "Private:" from titles
 */
function the_title_trim($title) {

	$title = attribute_escape($title);

	$findthese = array(
		'#Protected:#',
		'#Private:#'
	);

	$replacewith = array(
		'', // replace "Protected:" with
		'' // replace "Private:" with
	);
	$title = preg_replace($findthese, $replacewith, $title);
	return $title;
}
add_filter('the_title', 'the_title_trim');

/******************************************************************************
 * User Goals Shortcode
 ******************************************************************************/
function user_goals_shortcode($atts, $content = null) {
    ob_start();
    // Attributes
    extract(shortcode_atts(
            array(
                'role' => 'subscriber',
                'limit' => '-1',
            ), $atts)
    );

    // Code
    $args_users = array(
        'role'           => $role,
        'posts_per_page' => $limit,
        'order'          => 'ASC'
    ); 
    $users = get_users($args_users); 
    if ($users) : ?>
        <div class="users-goals-wrap">
            <?php foreach($users as $user) :
                //var_dump($user);
                $user_ID = $user->ID;
                $user_name = $user->display_name;
                $first_name = get_user_meta($user_ID, 'first_name', true);  
                $last_name = get_user_meta($user_ID, 'last_name', true);
                $profile_pic = get_avatar($user_ID);
                // GOALS
                $business_goal1 = uwp_get_usermeta($user_ID, 'business_goal_1');
                $business_goal2 = uwp_get_usermeta($user_ID, 'business_goal_2');
                $business_goal3 = uwp_get_usermeta($user_ID, 'business_goal_3');
                $personal_goal1 = uwp_get_usermeta($user_ID, 'personal_goal_1');
                $personal_goal2 = uwp_get_usermeta($user_ID, 'personal_goal_2');
                $personal_goal3 = uwp_get_usermeta($user_ID, 'personal_goal_3');
                $health_goal1 = uwp_get_usermeta($user_ID, 'health_goal_1');
                $health_goal2 = uwp_get_usermeta($user_ID, 'health_goal_2');
                $health_goal3 = uwp_get_usermeta($user_ID, 'health_goal_3');
            ?>
            <div class="member-goals">
                <div class="member-header">
                    <?php echo $profile_pic; ?>
                    <h3 class="member-title"><?php echo $first_name; ?>, <?php echo $last_name; ?></h3>
                </div>
                <h4>Business Goal #1:</h4>
                <p><?php echo $business_goal1?$business_goal1:'No Goal Set'; ?></p>
                <h4>Business Goal #2:</h4>
                <p><?php echo $business_goal2?$business_goal2:'No Goal Set'; ?></p>
                <h4>Business Goal #3:</h4>
                <p><?php echo $business_goal3?$business_goal3:'No Goal Set'; ?></p>

                <h4>Personal Goal #1:</h4>
                <p><?php echo $personal_goal1?$personal_goal1:'No Goal Set'; ?></p>
                <h4>Personal Goal #2:</h4>
                <p><?php echo $personal_goal2?$personal_goal2:'No Goal Set'; ?></p>
                <h4>Personal Goal #3:</h4>
                <p><?php echo $personal_goal3?$personal_goal3:'No Goal Set'; ?></p>

                <h4>Health Goal #1:</h4>
                <p><?php echo $health_goal1?$health_goal1:'No Goal Set'; ?></p>
                <h4>Health Goal #2:</h4>
                <p><?php echo $health_goal2?$health_goal2:'No Goal Set'; ?></p>
                <h4>Health Goal #3:</h4>
                <p><?php echo $health_goal3?$health_goal3:'No Goal Set'; ?></p>
            </div>

            <?php endforeach; ?>
        </div><!-- .users-goals-wrap -->
    <?php else : ?>
        <p>Sorry! No users found.</p>
    <?php endif;
    $output = ob_get_clean();
    return $output;
}

add_shortcode('user-goals', 'user_goals_shortcode');

/******************************************************************************
 * Add Featured Column to user list
 ******************************************************************************/
function new_modify_user_table($column) {
    $column['featured'] = 'Featured';
    return $column;
}
add_filter( 'manage_users_columns', 'new_modify_user_table' );

function new_modify_user_table_row( $val, $column_name, $user_id ) {
    switch ($column_name) {
        case 'featured' :
            $featured = get_the_author_meta('featured_user', $user_id);
            if($featured === '1'){
                return '<span class="dashicons dashicons-star-filled"></span>';
            } else {
                return '-';
            }
        default:
    }
    return $val;
}
add_filter( 'manage_users_custom_column', 'new_modify_user_table_row', 10, 3 );

/******************************************************************************
 * Add Featured Column to speaker list
 ******************************************************************************/
add_filter('manage_speakers_posts_columns', function($columns) {
	return array_merge($columns, ['featured' => 'Featured']);
});

add_action('manage_speakers_posts_custom_column', function($column_key, $post_id) {
	if ($column_key == 'featured') {
		$featured = get_post_meta($post_id, 'featured_speaker', true);
		if ($featured) {
			echo '<span class="dashicons dashicons-star-filled"></span>';
		} else {
			echo '-';
		}
	}
}, 10, 2);

/******************************************************************************
 * Featured User Shortcode
 ******************************************************************************/
function featured_user_shortcode($atts, $content = null) {
    ob_start();
    // Attributes
    extract(shortcode_atts(
            array(
                //'role' => 'subscriber',
                'limit' => '1',
            ), $atts)
    );

    // Code
    $args_users = array(
        //'role'           => $role,
        'meta_key' => 'featured_user',
        'meta_value' => '1',
        'posts_per_page' => $limit,
        'order'          => 'ASC'
    ); 
    $users = get_users($args_users); 
    if ($users) : ?>
        <div class="featured-member">
            <?php foreach($users as $user) :
                //var_dump($user);
                $user_ID = $user->ID;
                $user_name = $user->display_name;
                $first_name = get_user_meta($user_ID, 'first_name', true);  
                $last_name = get_user_meta($user_ID, 'last_name', true);
                $profile_pic = get_avatar($user_ID, '150', '150');
                $registered_date = date_create($user->user_registered);
                $r_date = date_format($registered_date,"M - Y");
            ?>
            <div class="profile-img">
                <?php echo $profile_pic; ?>
            </div>
            <div class="member-details">
                <h3 class="member-title"><?php echo $first_name; ?>, <?php echo $last_name; ?></h3>
                <p>Member since <strong><?php echo $r_date; ?></srong></p>
                <a href="/group-roster/" data-button="arrow">Learn More</a>
            </div>

            <?php endforeach; ?>
        </div><!-- .users-goals-wrap -->
    <?php else : ?>
        <p>Sorry! No Featured User.</p>
    <?php endif;
    $output = ob_get_clean();
    return $output;
}

add_shortcode('featured-user', 'featured_user_shortcode');

/******************************************************************************
 * Featured Speaker
 ******************************************************************************/
function featured_speaker_shortcode($atts, $content = null) {
    ob_start();
    // Attributes
    extract(shortcode_atts(
            array(
                'date' => '',
                'limit' => '1',
            ), $atts)
    );

    // Code
    $meeting_args = array(
        'post_type' => 'meetings',
        'meta_key' => 'meeting_date',
        'meta_value' => $date,
        'posts_per_page' => '1',
        'order' => 'DESC'
    );
    $meetings_query = new WP_Query($meeting_args); ?>
    <div class="featured-speaker">
    <?php if ($meetings_query->have_posts()) : ?>
        <?php while ( $meetings_query->have_posts() ) : $meetings_query->the_post(); ?>
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
        <?php endwhile; wp_reset_postdata(); ?>
    <?php else : ?>
        <p>No Featured Speaker.</p>
    <?php endif; ?>
    </div>
    <?php
    $output = ob_get_clean();
    return $output;
}

add_shortcode('featured-speaker', 'featured_speaker_shortcode');