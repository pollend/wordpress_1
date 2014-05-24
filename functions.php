<?php


    //places a home link on the page
    function gray_menu_args( $args ) {
         $args['show_home'] = true;
         return $args;
    }
    add_filter( 'wp_page_menu_args', 'gray_menu_args' );

    //sets the title of the page
    function gray_title($title, $sep){
        global $paged, $page;

        if ( is_feed() )
            return $title;

        $title .= bloginfo('name')  ;

         $title  =  $title . " Page " . $paged;

        return $title;
    }
    add_filter( 'wp_title', 'gray_title', 10, 2 );



    //enqueue scripts
    function gray_script_style()
    {
        //add javascript to pages with comment form
        wp_enqueue_script( 'comment-reply' );

        //get debounce script to prevent user event spam
        wp_enqueue_script( "debounce", get_template_directory_uri()."/js/debounce.js",array("jquery"),'1.1');

        //enqueue jquery and main javascript
        wp_enqueue_script('jquery');   

        //get main script
        wp_enqueue_script( "gray_main", get_template_directory_uri()."/js/main.js",array("jquery","debounce","transit",'history'),'1.0.0');
    
        //image overlay script
        wp_enqueue_script("gray_imageOverlay",get_template_directory_uri()."/js/imageOverlay.js",array("gray_main"),'1.0.0');

        //register style sheet
        wp_enqueue_style( 'gray_style', get_stylesheet_uri(), array(), '1.0.0' );

        //register style sheet
        wp_enqueue_style( 'gray_carousel_style',get_template_directory_uri() . "/presentation.css", array(), '1.0.0' );

        //register style sheet
        wp_enqueue_style( 'gray_imageoverlay_style', get_template_directory_uri() . "/imageOverlay.css", array(), '1.0.0' );


        //transit
         wp_enqueue_script( 'transit', get_template_directory_uri() . "/js/transit.js", array(), '1' );

         //html 5 history
        wp_enqueue_script( 'history',  get_template_directory_uri() ."/js/native.history.js",array('jquery'),'1');
    }
    add_action( 'wp_enqueue_scripts', 'gray_script_style' );

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