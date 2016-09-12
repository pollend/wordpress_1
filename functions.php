<?php


// Register Custom Post Type
function theme_setup() {

  add_theme_support( 'custom-background' );

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

    wp_enqueue_style( 'avro', 'https://fonts.googleapis.com/css?family=Arvo|Poiret+One|Unica+One', false );
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


function theme_hex2rgb( $color ) {
    $color = trim( $color, '#' );

    if ( strlen( $color ) === 3 ) {
        $r = hexdec( substr( $color, 0, 1 ).substr( $color, 0, 1 ) );
        $g = hexdec( substr( $color, 1, 1 ).substr( $color, 1, 1 ) );
        $b = hexdec( substr( $color, 2, 1 ).substr( $color, 2, 1 ) );
    } else if ( strlen( $color ) === 6 ) {
        $r = hexdec( substr( $color, 0, 2 ) );
        $g = hexdec( substr( $color, 2, 2 ) );
        $b = hexdec( substr( $color, 4, 2 ) );
    } else {
        return array();
    }

    return array( $r, $g,  $b );
}

function rgb2hex($rgb) {
   $hex = "#";
   $hex .= str_pad(dechex($rgb[0]), 2, "0", STR_PAD_LEFT);
   $hex .= str_pad(dechex($rgb[1]), 2, "0", STR_PAD_LEFT);
   $hex .= str_pad(dechex($rgb[2]), 2, "0", STR_PAD_LEFT);

   return $hex; // returns the hex value including the number sign (#)
}


function rgbToHsl( $r, $g, $b ) {
    $oldR = $r;
    $oldG = $g;
    $oldB = $b;
    $r /= 255;
    $g /= 255;
    $b /= 255;
    $max = max( $r, $g, $b );
    $min = min( $r, $g, $b );
    $h;
    $s;
    $l = ( $max + $min ) / 2;
    $d = $max - $min;
        if( $d == 0 ){
            $h = $s = 0; // achromatic
        } else {
            $s = $d / ( 1 - abs( 2 * $l - 1 ) );
        switch( $max ){
                case $r:
                    $h = 60 * fmod( ( ( $g - $b ) / $d ), 6 ); 
                        if ($b > $g) {
                        $h += 360;
                    }
                    break;
                case $g: 
                    $h = 60 * ( ( $b - $r ) / $d + 2 ); 
                    break;
                case $b: 
                    $h = 60 * ( ( $r - $g ) / $d + 4 ); 
                    break;
            }                               
    }
    return array( round( $h, 2 ), round( $s, 2 ), round( $l, 2 ) );
}
function hslToRgb( $h, $s, $l ){
    $r; 
    $g; 
    $b;
    $c = ( 1 - abs( 2 * $l - 1 ) ) * $s;
    $x = $c * ( 1 - abs( fmod( ( $h / 60 ), 2 ) - 1 ) );
    $m = $l - ( $c / 2 );
    if ( $h < 60 ) {
        $r = $c;
        $g = $x;
        $b = 0;
    } else if ( $h < 120 ) {
        $r = $x;
        $g = $c;
        $b = 0;         
    } else if ( $h < 180 ) {
        $r = 0;
        $g = $c;
        $b = $x;                    
    } else if ( $h < 240 ) {
        $r = 0;
        $g = $x;
        $b = $c;
    } else if ( $h < 300 ) {
        $r = $x;
        $g = 0;
        $b = $c;
    } else {
        $r = $c;
        $g = 0;
        $b = $x;
    }
    $r = clamp(( $r + $m ) * 255,0,255);
    $g = clamp(( $g + $m ) * 255,0,255);
    $b = clamp(( $b + $m  ) * 255,0,255);
    return array( floor( $r ), floor( $g ), floor( $b ) );
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
require get_template_directory() . '/inc/custom-pagination.php';

require get_template_directory() . '/inc/theme-customizer-page.php';


/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

?>