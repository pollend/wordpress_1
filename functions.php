<?php

    include_once "custom-nav-walker.php";
    include_once "custom-comment-walker.php";

    //places a home link on the page
    function gray_menu_args( $args ) {
         $args['show_home'] = true;
         return $args;
    }
    add_filter( 'wp_page_menu_args', 'gray_menu_args' );

  

    //enqueue scripts
    function smoke_tree_script_style()
    {

        wp_enqueue_style( 'style-name', get_template_directory_uri() ."/css/app.css" );

        //add javascript to pages with comment form
        wp_enqueue_script( 'comment-reply' );

        wp_enqueue_style( 'avro', 'https://fonts.googleapis.com/css?family=Arvo|Poiret+One|Unica+One', false );
        wp_enqueue_script('transit',"http://ricostacruz.com/jquery.transit/jquery.transit.min.js",array('jquery'));
        wp_enqueue_script('jquery');
        wp_enqueue_script( 'main',  get_template_directory_uri() ."/js/app.min.js",array('jquery','transit','foundation.min'),'1',true);

         wp_enqueue_script('foundation.min',get_template_directory_uri()."/js/foundation/foundation.min.js",array('jquery'),null,true);

    }
    add_action( 'wp_enqueue_scripts', 'smoke_tree_script_style' );

    //setup the theme and register the header and feed links
    function smoke_tree_setup()
    {
        //formats
         add_theme_support( 'post-formats',array('link','image','quote','video') );

        // Add RSS links to <head> section
        add_theme_support( 'automatic-feed-links' );


        add_theme_support( 'custom-header', array(
            'random-default'         => false,
            'flex-height'            => true,
            'flex-width'             => true,
            'height'                 => 250,
            'width'                  => 960,
            'max-width'              => 2000,
            'header-text'            => true,
            'uploads'                => true,

        ));



        register_sidebar(array(
            'name' => 'Sidebar Widgets',
            'id'   => 'sidebar-widgets',
            'description'   => 'These are widgets for the sidebar.',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h2>',
            'after_title'   => '</h2>'
        ));

        register_nav_menu( 'primary', 'Primary Menu' );
        
        if ( ! isset( $content_width ) )
         $content_width = 500;
    }
    add_action( 'after_setup_theme', 'smoke_tree_setup' );



    //add the admin options
    function gray_admin_menu()
    {
        include_once "admin/theme-settings.php";
        include_once "admin/game/game-header-meta.php";
        
        add_theme_page('gray home page', 'Theme Options', 'read', 'home', 'theme_settings');
    

    }
    add_action('admin_menu','gray_admin_menu');
  
    function gray_comments_callback( $comment, $args, $depth ) {
        ?>
        <li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
            <div id="div-comment-<?php comment_ID(); ?>" class="comment-body">
                <div class="main-comment-container">
                    <div class="comment-avatar">
                       <?php echo get_avatar( $comment, 70 ); ?>
                    </div>
                    <div class="comment-content">
                        <div class="comment-meta">
                            <div  class="comment-username"><?php   comment_author(); ?></div>
                            <div  class="comment-date"><?php comment_date('F j, Y \a\t g:i a'); ?></div>
                        </div>
                        <?php comment_text(); ?>
                    </div>
         
                    <div class="reply">
                        <?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( '<div>Reply</div>', 'gray' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
                    </div>
                </div>
            </div>
        </li>
        <?php
    }


// Register Custom Post Type
function game_post_type() {

    $labels = array(
        'name'                  => _x( 'Games', 'Post Type General Name', 'text_domain' ),
        'singular_name'         => _x( 'Game', 'Post Type Singular Name', 'text_domain' ),
        'menu_name'             => __( 'Game', 'text_domain' ),
        'name_admin_bar'        => __( 'Game', 'text_domain' ),
        'parent_item_colon'     => __( 'Parent Game:', 'text_domain' ),
        'all_items'             => __( 'All Games', 'text_domain' ),
        'add_new_item'          => __( 'Add New Game', 'text_domain' ),
        'add_new'               => __( 'Add New', 'text_domain' ),
        'new_item'              => __( 'New Game', 'text_domain' ),
        'edit_item'             => __( 'Edit Game', 'text_domain' ),
        'update_item'           => __( 'Update Game', 'text_domain' ),
        'view_item'             => __( 'View Game', 'text_domain' ),
        'search_items'          => __( 'Search Game', 'text_domain' ),
        'not_found'             => __( 'Not found', 'text_domain' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
        'items_list'            => __( 'Items list', 'text_domain' ),
        'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
        'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
    );
    $args = array(
        'label'                 => __( 'Game', 'text_domain' ),
        'description'           => __( 'Game post type.', 'text_domain' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'thumbnail', ),
        'taxonomies'            => array( 'category', 'post_tag'),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-dashboard',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'page',
    );
    register_post_type( 'game', $args );

}
add_action( 'init', 'game_post_type', 0 );

?>