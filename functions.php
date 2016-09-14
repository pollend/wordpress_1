<?php


// Register Custom Post Type
function theme_setup() {
    //allow custom backgrounds to be set
    add_theme_support( 'custom-background' );
    //enable featured image
    add_theme_support( 'post-thumbnails' );
}
add_action( 'init', 'theme_setup', 0 );



//places a home link on the page
function gray_menu_args( $args ) {
     $args['show_home'] = true;
     return $args;
}
add_filter( 'wp_page_menu_args', 'gray_menu_args' );



//enqueue scripts
function smoke_tree_script_style()
{
    //add javascript to pages with comment form
    wp_enqueue_script( 'comment-reply' );

    wp_enqueue_style( 'fonts', 'https://fonts.googleapis.com/css?family=Arvo|Poiret+One|Unica+One', false );
    wp_enqueue_script('transit',"http://ricostacruz.com/jquery.transit/jquery.transit.min.js",array('jquery'));
    wp_enqueue_script('jquery');
    wp_enqueue_script( 'main',  get_template_directory_uri() ."/js/app.min.js",array('jquery','transit','foundation.min'),'1',true);

    // Theme stylesheet.
    wp_enqueue_style( 'theme-style', get_stylesheet_uri() );

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




function clamp($number, $minValue, $maxValue) {
    return max($minValue, min($maxValue, $number)); 
}


/**
 * Implement the Custom comment walker feature.
 *
 * @since Twenty Fifteen 1.0
 */
require get_template_directory() . '/inc/custom-comment-walker.php';

/**
 * Implement the Custom comment walker feature.
 *
 * @since Twenty Fifteen 1.0
 */
require get_template_directory() . '/inc/custom-template.php';

require get_template_directory() . '/inc/theme-customizer-page.php';


/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

?>