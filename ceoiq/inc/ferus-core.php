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
 * Remove Dashboard Metabox Widgets
 */
add_action('wp_dashboard_setup', 'cert_remove_dashboard_widget' );
function cert_remove_dashboard_widget() {
    global $wp_meta_boxes;
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);		
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity']);
    remove_meta_box( 'wpseo-dashboard-overview', 'dashboard', 'normal' );
    remove_meta_box( 'rg_forms_dashboard', 'dashboard', 'normal' );
}
/**
 * Remove items from the admin bar
 */
function remove_from_admin_bar($wp_admin_bar) {
    if (!current_user_can('administrator') && !is_admin()) {
        $wp_admin_bar->remove_node('my-sites');
    }
    $wp_admin_bar->remove_node('updates');
    $wp_admin_bar->remove_node('comments');
    $wp_admin_bar->remove_node('new-content');
    $wp_admin_bar->remove_node('wp-logo');
    $wp_admin_bar->remove_node('search');
    $wp_admin_bar->remove_node('customize');
    // Plugins
    $wp_admin_bar->remove_node('breeze-topbar');
    $wp_admin_bar->remove_node('wpseo-menu');
    
}
add_action('admin_bar_menu', 'remove_from_admin_bar', 9999);
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
 * Register Consultants Post Type
 */
function consultants() {

    $labels = array(
        'name'                  => _x( 'Consultants', 'Post Type General Name', 'ferus-core' ),
        'singular_name'         => _x( 'Consultant', 'Post Type Singular Name', 'ferus-core' ),
        'menu_name'             => __( 'Consultants', 'ferus-core' ),
        'name_admin_bar'        => __( 'Consultants', 'ferus-core' ),
        'archives'              => __( 'Consultant Archives', 'ferus-core' ),
        'attributes'            => __( 'Consultant Attributes', 'ferus-core' ),
        'parent_item_colon'     => __( 'Parent Item:', 'ferus-core' ),
        'all_items'             => __( 'All Consultants', 'ferus-core' ),
        'add_new_item'          => __( 'Add New Consultant', 'ferus-core' ),
        'add_new'               => __( 'Add New', 'ferus-core' ),
        'new_item'              => __( 'New Consultant', 'ferus-core' ),
        'edit_item'             => __( 'Edit Consultant', 'ferus-core' ),
        'update_item'           => __( 'Update Consultant', 'ferus-core' ),
        'view_item'             => __( 'View Consultant', 'ferus-core' ),
        'view_items'            => __( 'View Consultants', 'ferus-core' ),
        'search_items'          => __( 'Search Consultants', 'ferus-core' ),
        'not_found'             => __( 'Not found', 'ferus-core' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'ferus-core' ),
        'featured_image'        => __( 'Featured Image', 'ferus-core' ),
        'set_featured_image'    => __( 'Set featured image', 'ferus-core' ),
        'remove_featured_image' => __( 'Remove featured image', 'ferus-core' ),
        'use_featured_image'    => __( 'Use as featured image', 'ferus-core' ),
        'insert_into_item'      => __( 'Insert into item', 'ferus-core' ),
        'uploaded_to_this_item' => __( 'Uploaded to this item', 'ferus-core' ),
        'items_list'            => __( 'Items list', 'ferus-core' ),
        'items_list_navigation' => __( 'Items list navigation', 'ferus-core' ),
        'filter_items_list'     => __( 'Filter items list', 'ferus-core' ),
    );
    $args = array(
        'label'                 => __( 'Consultant', 'ferus-core' ),
        'description'           => __( 'Consultants', 'ferus-core' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'revisions', 'custom-fields', 'page-attributes', 'post-formats', ),
        'taxonomies'            => array( 'category', 'post_tag' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-groups',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => false,
        'exclude_from_search'   => true,
        'publicly_queryable'    => true,
        'capability_type'       => 'page',
    );
    register_post_type( 'consultants', $args );

}
add_action( 'init', 'consultants', 0 );

// Use this function if 404 errors on custom post type
//flush_rewrite_rules( false );

// Register Custom Post Type
function ceoiq_company_surveys() {

    $labels = array(
        'name'                  => _x( 'Surveys', 'Post Type General Name', 'text_domain' ),
        'singular_name'         => _x( 'Survey', 'Post Type Singular Name', 'text_domain' ),
        'menu_name'             => __( 'Surveys', 'text_domain' ),
        'name_admin_bar'        => __( 'Survey', 'text_domain' ),
        'archives'              => __( 'Item Archives', 'text_domain' ),
        'attributes'            => __( 'Item Attributes', 'text_domain' ),
        'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
        'all_items'             => __( 'All Items', 'text_domain' ),
        'add_new_item'          => __( 'Add New Item', 'text_domain' ),
        'add_new'               => __( 'Add New', 'text_domain' ),
        'new_item'              => __( 'New Item', 'text_domain' ),
        'edit_item'             => __( 'Edit Item', 'text_domain' ),
        'update_item'           => __( 'Update Item', 'text_domain' ),
        'view_item'             => __( 'View Item', 'text_domain' ),
        'view_items'            => __( 'View Items', 'text_domain' ),
        'search_items'          => __( 'Search Item', 'text_domain' ),
        'not_found'             => __( 'Not found', 'text_domain' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
        'featured_image'        => __( 'Featured Image', 'text_domain' ),
        'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
        'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
        'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
        'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
        'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
        'items_list'            => __( 'Items list', 'text_domain' ),
        'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
        'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
    );
    $rewrite = array(
        'slug'                  => 'oss',
        'with_front'            => true,
        'pages'                 => true,
        'feeds'                 => true,
    );
    $args = array(
        'label'                 => __( 'Survey', 'text_domain' ),
        'description'           => __( 'Organizational Snapshot Surveys', 'text_domain' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'revisions', 'custom-fields', 'page-attributes' ),
        'taxonomies'            => array(),
        'hierarchical'          => true,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-analytics',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => false,
        'can_export'            => true,
        'has_archive'           => false,
        'exclude_from_search'   => true,
        'publicly_queryable'    => true,
        'rewrite'               => $rewrite,
        'capability_type'       => 'page',
    );
    register_post_type( 'ceoiq_surveys', $args );

}
add_action( 'init', 'ceoiq_company_surveys', 0 );



/**
 * Add "Invite Consultant" Button
 */
function invite_consultant_add_meta_box() {
	add_meta_box(
		'invite_consultant-invite-consultant',
		__( 'Invite Consultant', 'invite_consultant' ),
		'invite_consultant_html',
		'ceoiq_surveys',
		'side',
		'default'
	);
}
add_action( 'add_meta_boxes', 'invite_consultant_add_meta_box' );
function invite_consultant_html( $post) {
    wp_nonce_field( '_invite_consultant_nonce', 'invite_consultant_nonce' );
    $permalink = get_permalink($post->ID);
    ?>
    <p style="display: block; text-align: center;">
        <a href="<?php echo $permalink . '?consult-invite=1'; ?>" class="button button-primary button-large">Invite Now</a>
    </p><?php
}

/**
 * Survey Child Pages auto creation
 */
function ceoiq_add_survey_children( $post_id ) {
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
        return;

    if ( !wp_is_post_revision( $post_id )
        && 'ceoiq_surveys' == get_post_type( $post_id )
        && 'auto-draft' != get_post_status( $post_id ) ) {
        $show = get_post( $post_id );
        $parent_pw = $show->post_password?$show->post_password:'';
        if( 0 == $show->post_parent ){
            $children =& get_children(
                array(
                    'post_parent' => $post_id,
                    'post_type' => 'ceoiq_surveys'
                )
            );
            if( empty( $children ) ){
                /*$dashboard_page = array(
                    'post_type' => 'ceoiq_surveys',
                    'post_title' => 'Dashboard',
                    'post_content' => '',
                    'post_status' => 'publish',
                    'post_parent' => $post_id,
                    'post_author' => 1
                );*/
                $survey_page = array(
                    'post_type' => 'ceoiq_surveys',
                    'post_title' => 'Survey',
                    'post_content' => '',
                    'post_status' => 'publish',
                    'post_parent' => $post_id,
                    'post_author' => 1,
                    'page_template' => 'page_survey-form.php'
                );
                $results_page = array(
                    'post_type' => 'ceoiq_surveys',
                    'post_title' => 'Results',
                    'post_content' => '',
                    'post_status' => 'publish',
                    'post_parent' => $post_id,
                    'post_author' => 1,
                    'page_template' => 'page_survey-results.php',
                    'post_password' => $parent_pw
                );
                //wp_insert_post( $dashboard_page );
                wp_insert_post( $survey_page );
                wp_insert_post( $results_page );
            }
        }
    }
}
add_action( 'save_post', 'ceoiq_add_survey_children' );

/**
 * Register Virtual Programs post type
 */
function cpt_virtual_programs() {

    $labels = array(
        'name'                  => _x( 'Programs', 'Post Type General Name', 'ferus_core' ),
        'singular_name'         => _x( 'Program', 'Post Type Singular Name', 'ferus_core' ),
        'menu_name'             => __( 'Virtual Programs', 'ferus_core' ),
        'name_admin_bar'        => __( 'Post Type', 'ferus_core' ),
        'archives'              => __( 'Program Archives', 'ferus_core' ),
        'attributes'            => __( 'Program Attributes', 'ferus_core' ),
        'parent_item_colon'     => __( 'Parent Program:', 'ferus_core' ),
        'all_items'             => __( 'All Programs', 'ferus_core' ),
        'add_new_item'          => __( 'Add New Program', 'ferus_core' ),
        'add_new'               => __( 'Add New', 'ferus_core' ),
        'new_item'              => __( 'New Program', 'ferus_core' ),
        'edit_item'             => __( 'Edit Program', 'ferus_core' ),
        'update_item'           => __( 'Update Program', 'ferus_core' ),
        'view_item'             => __( 'View Program', 'ferus_core' ),
        'view_items'            => __( 'View Program', 'ferus_core' ),
        'search_items'          => __( 'Search Programs', 'ferus_core' ),
        'not_found'             => __( 'Not found', 'ferus_core' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'ferus_core' ),
        'featured_image'        => __( 'Featured Image', 'ferus_core' ),
        'set_featured_image'    => __( 'Set featured image', 'ferus_core' ),
        'remove_featured_image' => __( 'Remove featured image', 'ferus_core' ),
        'use_featured_image'    => __( 'Use as featured image', 'ferus_core' ),
        'insert_into_item'      => __( 'Insert into program', 'ferus_core' ),
        'uploaded_to_this_item' => __( 'Uploaded to this program', 'ferus_core' ),
        'items_list'            => __( 'Programs list', 'ferus_core' ),
        'items_list_navigation' => __( 'Programs list navigation', 'ferus_core' ),
        'filter_items_list'     => __( 'Filter programs list', 'ferus_core' ),
    );
    $rewrite = array(
        'slug'                  => 'virtual-programs',
        'with_front'            => true,
        'pages'                 => true,
        'feeds'                 => true,
    );
    $args = array(
        'label'                 => __( 'Program', 'ferus_core' ),
        'description'           => __( 'Program Description', 'ferus_core' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'trackbacks', 'revisions', 'custom-fields', 'page-attributes', ),
        'taxonomies'            => array( 'category', 'post_tag' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-welcome-widgets-menus',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => 'virtual-programs',
        'exclude_from_search'   => true,
        'publicly_queryable'    => true,
        'rewrite'               => $rewrite,
        'capability_type'       => 'page',
    );
    register_post_type( 'virtual_programs', $args );

}
add_action( 'init', 'cpt_virtual_programs', 0 );

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
            <?php endwhile; ?>
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
        <?php endwhile; ?>
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
 * Consultants Shortcode
 ******************************************************************************/
function consultants_shortcode($atts, $content = null) {
    ob_start();
    // Attributes
    extract(shortcode_atts(
            array(
                'posts' => '4',
                'people' => '',
            ), $atts)
    );

    $content_pos = $content?$content:'right';
    $pos_class = 'content-pos-' . $content_pos;

    // Code
    $recent_args = array(
        'post_type' => 'consultants',
        'tag' => $people,
        'posts_per_page' => $posts,
        'order' => 'ASC'
    );
    $recent_query = new WP_Query($recent_args);
    if ($recent_query->have_posts()) : ?>
        <div class="consultants">
            <?php while ( $recent_query->have_posts() ) : $recent_query->the_post(); ?>
                <?php
                $feat_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );
                $image = $feat_image[0] ? $feat_image[0] : get_template_directory_uri() . '/inc/images/hero.jpg';
                $excerpt_length = 250;
                $content = apply_filters('the_content', get_the_content());
                $excerpt = truncate( $content, $excerpt_length, '...', false, true );
                ?>
                <div class="col-xs-6 col-sm-3 person">
                    <a href="#consultant-<?php the_ID(); ?>" class="lb-gallery">
                        <img src="<?php echo $image; ?>">
                        <div style="display:none;">
                            <div id="consultant-<?php the_ID(); ?>">
                                <div class="row staff-lb">
                                    <div class="col-xs-4 img">
                                        <img src="<?php echo $image; ?>">
                                    </div>
                                    <div class="col-xs-8 content">
                                        <h3 class="name"><?php echo the_title(); ?></h3>
                                        <?php echo $content; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>
        </div><!-- .consultants -->
    <?php else : ?>
        <p>Sorry! No Consultants found within your criteria.</p>
    <?php endif;
    $output = ob_get_clean();
    return $output;
}

add_shortcode('consultants', 'consultants_shortcode');
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

/******************************************************************************
 * Add OSS Survey Query Vars
 ******************************************************************************/
function add_oss_survey_query_vars_filter( $vars ){
    $vars[] = "osscat";
    $vars[] .= "osstier";
    $vars[] .= "ossinvite";
    $vars[] .= "ossquestions";
    return $vars;
}
add_filter( 'query_vars', 'add_oss_survey_query_vars_filter' );


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
 * Pre-populate learn more form
 */
add_filter( 'gform_field_value_learn_more_service', 'populate_learn_more' );
function populate_learn_more( $value ) {
    $pagename = get_the_title();
    return $pagename;
}
/**
 * Make fields readonly on consultant invite form
 */
// update '1' to the ID of your form
add_filter( 'gform_pre_render_13', 'add_readonly_script' );
function add_readonly_script( $form ) {
    ?>
    <script type="text/javascript">
        jQuery(document).ready(function(){
            /* apply only to a input with a class of gf_readonly */
            jQuery("li.gf_readonly input").attr("readonly","readonly");
        });
    </script>
    <?php
    return $form;
}
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
 * AJAX send mail
 ******************************************************************************/
function ceoiq_send_mail(){
    $emails = urldecode( $_POST['emails'] );
    $sendto = 'notifications@ceoiq.com';
    //$sendto = explode(',', $emails);
    $subj = 'Time is Running Out!';
    $template = file_get_contents(get_template_directory_uri() . '/inc/emails/oss-reminder.html');
    $template = str_replace('[Title]', 'Time is Running Out!', $template);
    $template = str_replace('[button_link]', $_POST['tierlink'], $template);
    $template = str_replace('[button_text]', 'Take Survey', $template);
    $template = str_replace('[survey_pass]', $_POST['sp'], $template);
    $headers = array(
        'Content-Type: text/html; charset=UTF-8',
        'Bcc: '. $emails,
        'From: CEOIQ® <info@ceoiq.com>'
    );
    $body = $template;
    wp_mail( $sendto, $subj, $body, $headers );
}
add_action('wp_ajax_ceoiq_notifications', 'ceoiq_send_mail');
add_action('wp_ajax_nopriv_ceoiq_notifications', 'ceoiq_send_mail');
/******************************************************************************
 * Password Protection Form
 ******************************************************************************/
function my_password_form() {
    global $post;
    $label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
    $o = '<form action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" method="post">
    <p>' . __( "To access your CEOIQ<sup>&reg;</sup> Organizational Snapshot Survey, please enter the password you were provided." ) . '</p>
    <label for="' . $label . '">' . __( "Password:" ) . 
    '<input name="post_password" id="' . $label . '" type="password" size="20" maxlength="20" />' .
    '</label>' .
    '<input type="submit" name="Submit" value="' . esc_attr__( "Submit" ) . '" />' .
    '</form>';
    return $o;
}
add_filter( 'the_password_form', 'my_password_form' );
/******************************************************************************
 * Survey Utility Functions
 ******************************************************************************/
/**
 * Get Question Totals
 */
function get_question_totals($t_entries,$qID) {
    foreach($t_entries as $entry) {
        $q_total = (int)$q_total + (int)$entry[$qID];
    }
    return $q_total;
}
/**
 * Get Question Percentage
 */
function get_question_percent($q_totals,$t_entries) {
    $percent = ($q_totals / ($t_entries*5)) * 100;
    return round($percent, 1);
}
/**
 * Get All Tier Entries
 */
function get_tier_entries($t_entries,$qID) {
    $q_entries = array();
    foreach($t_entries as $entry) {
        array_push($q_entries, $entry[$qID]);
    }
    return $q_entries;
}
/**
 * Get Category Notes
 */
function get_cat_notes($t_entries,$qID) {
    $q_notes = array();
    foreach($t_entries as $entry) {
        array_push($q_notes, $entry[$qID]);
    }
    return $q_notes;
}
/**
 * Build Tier Labels
 */
function build_tier_labels($t_entries,$qID) {
    $q_labels = array();
    $q_num = 1;
    foreach($t_entries as $entry) {
        array_push($q_labels, '"E'.$q_num.'"');
        $q_num = $q_num+1;
    }
    $out = implode(",",$q_labels);
    return '['.$out.']';
}
/**
 * Get Category Name
 */
function get_oss_cat_title($oss_cat) {
    if($oss_cat == '1') {
        $oss_title = 'Strategy';
    } elseif($oss_cat == '2') {
        $oss_title = 'Leadership';
    } elseif($oss_cat == '3') {
        $oss_title = 'Culture';
    } elseif($oss_cat == '4') {
        $oss_title = 'Execution';
    } elseif($oss_cat == '5') {
        $oss_title = 'People';
    } elseif($oss_cat == '6') {
        $oss_title = 'Hierarchy';
    } elseif($oss_cat == '7') {
        $oss_title = 'Innovation';
    } elseif($oss_cat == '8') {
        $oss_title = 'Alliances';
    } else {
        $oss_title = 'Category Unknown';
    }
    return $oss_title;
}
/**
 * Get Category Array
 */
function get_oss_cat($catID, $notes = 'false') {
    $cat_questions = [];
    if($catID == 1) {
        //$cat_questions = array(2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22);
        $cat_questions = range(2,22);
        // below snippet for adding comment fields (when ready)
        if($notes === true) {
            //array_push($cat_questions,85);
            $cat_questions = array(85);
        }
    }elseif($catID == 2){
        //$cat_questions = [2,3];
        $cat_questions = range(23,36);
        // below snippet for adding comment fields (when ready)
        if($notes === true) {
            //array_push($cat_questions,86);
            $cat_questions = array(86);
        }
    }elseif($catID == 3){
        //$cat_questions = [4,5];
        $cat_questions = range(37,53);
        // below snippet for adding comment fields (when ready)
        if($notes === true) {
            //array_push($cat_questions,87);
            $cat_questions = array(87);
        }
    }elseif($catID == 4){
        //$cat_questions = [6,7];
        $cat_questions = range(54,71);
        // below snippet for adding comment fields (when ready)
        if($notes === true) {
            //array_push($cat_questions,88);
            $cat_questions = array(88);
        }
    }elseif($catID == 5){
        //$cat_questions = [8,9];
        $cat_questions = range(72,74);
        // below snippet for adding comment fields (when ready)
        if($notes === true) {
            //array_push($cat_questions,89);
            $cat_questions = array(89);
        }
    }elseif($catID == 6){
        //$cat_questions = [10,11];
        $cat_questions = range(75,80);
        // below snippet for adding comment fields (when ready)
        if($notes === true) {
            //array_push($cat_questions,90);
            $cat_questions = array(90);
        }
    }elseif($catID == 7){
        //$cat_questions = [12,13];
        $cat_questions = range(81,83);
        // below snippet for adding comment fields (when ready)
        if($notes === true) {
            //array_push($cat_questions,91);
            $cat_questions = array(91);
        }
    }elseif($catID == 8){
        //$cat_questions = [14,15];
        $cat_questions = array(84);
        // below snippet for adding comment fields (when ready)
        if($notes === true) {
            //array_push($cat_questions,92);
            $cat_questions = array(92);
        }
    }else{
        return false;
    }
    return $cat_questions;
}
/**
 * Get Category Totals
 */
function get_cat_totals($entries, $catID) {
    $cat_total = 0;
    $cat_questions = get_oss_cat($catID);

    foreach($entries as $entry) {
        //var_dump($entry);
        foreach($entry as $key => $val) {
            //var_dump($catID);
            if (in_array($key, $cat_questions)) {
                $cat_total = $cat_total + $val;
            }
        }
    }

    return $cat_total;
}
/**
 * Format Entries for CSV Export (remove unnessesary fields)
 */
function oss_format_entries_export($entries) {
    $format_entries = array();
    foreach($entries as $entry) {
        //unset($entry["form_id"]);
        $entry = array_diff_key($entry, [
            "form_id" => "",
            "post_id" => "",
            "date_updated" => "",
            "is_starred" => "",
            "is_read" => "",
            "ip" => "",
            "source_url" => "",
            "user_agent" => "",
            "currency" => "",
            "payment_status" => "",
            "payment_date" => "",
            "payment_amount" => "",
            "payment_method" => "",
            "transaction_id" => "",
            "is_fulfilled" => "",
            "created_by" => "",
            "transaction_type" => "",
            "status" => ""]);
        array_push($format_entries, $entry);
    }
    return $format_entries;
}
