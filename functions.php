<?php

    include_once "custom-nav-walker.php";

    // function jptweak_remove_share() {
    //     remove_filter( 'the_content', 'sharing_display',19 );
    //     remove_filter( 'the_excerpt', 'sharing_display',19 );
    //     if ( class_exists( 'Jetpack_Likes' ) ) {
    //         remove_filter( 'the_content', array( Jetpack_Likes::init(), 'post_likes' ), 30, 1 );
    //     }
    // }
    // add_action( 'loop_start', 'jptweak_remove_share' );

    //places a home link on the page
    function gray_menu_args( $args ) {
         $args['show_home'] = true;
         return $args;
    }
    add_filter( 'wp_page_menu_args', 'gray_menu_args' );

    // //sets the title of the page
    // function gray_title($title, $sep){
    //     global $paged, $page;

    //     if ( is_feed() )
    //         return $title;

    //     $title .= bloginfo('name')  ;

    //      $title  =  $title . " Page " . $paged;

    //     return $title;
    // }
    // add_filter( 'wp_title', 'gray_title', 10, 2 );

  

    //enqueue scripts
    function smoke_tree_script_style()
    {

        wp_enqueue_style( 'style-name', get_template_directory_uri() ."/css/app.css" );

        //add javascript to pages with comment form
        wp_enqueue_script( 'comment-reply' );

        //wp_enqueue_script( 'bootstrap',  get_template_directory_uri() ."/static/bootstrap/bootstrap.min.js",array('jquery'),'1');

        //wp_enqueue_script( 'vue',  get_template_directory_uri() ."/static/vue/vue.min.js",'1');

        wp_enqueue_script( 'main',  get_template_directory_uri() ."/js/app.min.js",array('jquery','vue'),'1');
        wp_enqueue_script('vue',get_template_directory_uri()."/js/vue/vue.min.js");

        wp_enqueue_script('jquery');
       /* wp_enqueue_script('foundation.core',get_template_directory_uri()."/js/foundation/foundation.core.js",array('jquery'));
        wp_enqueue_script('foundation.dropdownMenu',get_template_directory_uri()."/js/foundation/foundation.dropdownMenu.js",array('jquery','foundation.core'));*/

        // wp_localize_script( 'main', 'wp', array(
        //     'root'      => esc_url_raw( rest_url() ),
        //     'base_url'  => $base_url,
        //     'base_path' => $base_path ? $base_path . '/' : '/',
        //     'nonce'     => wp_create_nonce( 'wp_rest' ),
        //     'site_name' => get_bloginfo( 'name' ),
        //     'routes'    => rest_theme_routes()
        // ) );

    }
    add_action( 'wp_enqueue_scripts', 'smoke_tree_script_style' );

    //setup the theme and register the header and feed links
    function gray_setup()
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
    add_action( 'after_setup_theme', 'gray_setup' );



    //add the admin options
    function gray_admin_menu()
    {
        include_once "admin/homeOptions.php";
        add_theme_page('gray home page', 'Theme Options', 'read', 'home', 'gray_home_options_page');
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


?>