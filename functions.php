<?php

    //ouput header style and dump into page
    function gray_header_style(){
        ?>
        <!--style type="text/css">
            body{
                <?php if(get_theme_mod("gray_cover_background_image")) : ?>
                     background:url("<?php echo get_theme_mod('gray_cover_background_image'); ?>") center no-repeat fixed;
                <?php else: ?>
                    background: rgb(25,88,160); /* Old browsers */
                    background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgdmlld0JveD0iMCAwIDEgMSIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+CiAgPHJhZGlhbEdyYWRpZW50IGlkPSJncmFkLXVjZ2ctZ2VuZXJhdGVkIiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgY3g9IjUwJSIgY3k9IjUwJSIgcj0iNzUlIj4KICAgIDxzdG9wIG9mZnNldD0iMCUiIHN0b3AtY29sb3I9IiMxOTU4YTAiIHN0b3Atb3BhY2l0eT0iMSIvPgogICAgPHN0b3Agb2Zmc2V0PSIxMDAlIiBzdG9wLWNvbG9yPSIjMDAxYTZiIiBzdG9wLW9wYWNpdHk9IjEiLz4KICA8L3JhZGlhbEdyYWRpZW50PgogIDxyZWN0IHg9Ii01MCIgeT0iLTUwIiB3aWR0aD0iMTAxIiBoZWlnaHQ9IjEwMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+);
                    background: url("<?php echo get_theme_mod('gray_pattern_repeat'); ?>") repeat top left,-moz-radial-gradient(center, ellipse cover,  <?php echo get_theme_mod('gray_gradient_one'); ?> 0%, <?php echo get_theme_mod('gray_gradient_two'); ?> 100%); /* FF3.6+ */
                    background: url("<?php echo get_theme_mod('gray_pattern_repeat'); ?>") repeat top left,-webkit-gradient(radial, center center, 0px, center center, 100%, color-stop(0%,<?php echo get_theme_mod('gray_gradient_one'); ?>), color-stop(100%,<?php echo get_theme_mod('gray_gradient_two'); ?>)); /* Chrome,Safari4+ */
                    background: url("<?php echo get_theme_mod('gray_pattern_repeat'); ?>") repeat top left,-webkit-radial-gradient(center, ellipse cover,  <?php echo get_theme_mod('gray_gradient_one'); ?> 0%,<?php echo get_theme_mod('gray_gradient_two'); ?> 100%); /* Chrome10+,Safari5.1+ */
                    background: url("<?php echo get_theme_mod('gray_pattern_repeat'); ?>") repeat top left,-o-radial-gradient(center, ellipse cover, <?php echo get_theme_mod('gray_gradient_one'); ?> 0%,<?php echo get_theme_mod('gray_gradient_two'); ?> 100%); /* Opera 12+ */
                    background: url("<?php echo get_theme_mod('gray_pattern_repeat'); ?>") repeat top left,-ms-radial-gradient(center, ellipse cover,  <?php echo get_theme_mod('gray_gradient_one'); ?> 0%,<?php echo get_theme_mod('gray_gradient_two'); ?> 100%); /* IE10+ */
                    background: url("<?php echo get_theme_mod('gray_pattern_repeat'); ?>") repeat top left,radial-gradient(ellipse at center, <?php echo get_theme_mod('gray_gradient_one'); ?> 0%,<?php echo get_theme_mod('gray_gradient_two'); ?> 100%); /* W3C */
                    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#1958a0', endColorstr='#001a6b',GradientType=1 ); /* IE6-8 fallback on horizontal gradient */
                <?php endif; ?>
            }

            #title a{
                color : #<?php echo get_theme_mod("header_textcolor") ; ?>;
                text-decoration: none;
            }
        </style-->

        <?php

    }

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

    function gray_background_customizer()
    {
          /* Supply a list of built-in background that come with your theme */
            $backgrounds = array(
                'images/strip.png'
            );

            global  $wp_customize;
            $control =  $wp_customize->get_control( 'gray_pattern_repeat' );

            foreach ( (array) $backgrounds as $background )
                $control->print_tab_image( esc_url_raw( get_stylesheet_directory_uri() . '/' . $background ) );
    }

    //setup the customizer
    function gray_customizer($wp_customizer)
    {
        //full background image
        $wp_customizer->add_section(
            'gray_cover_background_image',
            array(
                'title' => 'cover background image',
                'description' => 'full background image.',
                'priority' => 35,
            )
        );

        $wp_customizer->add_setting( 'gray_cover_background_image' ,  array( 'transport' => 'postMessage'));

        $wp_customizer->add_control(
        new WP_Customize_Image_Control(
                $wp_customizer,
                'gray_cover_background_image',
                array(
                    'label' => 'Image Upload',
                    'section' => 'gray_cover_background_image',
                    'settings' => 'gray_cover_background_image'
                )
            )
        );

        //background color and image
        $wp_customizer->add_section(
            'gray_pattern_background',
            array(
                'title' => 'Pattern Background',
                'description' => 'background color and pattern.',
                'priority' => 35,
            )
        );

        $wp_customizer->add_setting('gray_pattern_repeat', array('transport' => 'postMessage') );
         $wp_customizer->add_control(
             new WP_Customize_Image_Control(
                $wp_customizer,
                'gray_pattern_repeat',
                array(
                    'label' => 'Image Upload',
                    'section' => 'gray_pattern_background',
                    'settings' => 'gray_pattern_repeat'
                )
            )
        );

        $control = $wp_customizer->get_control( 'gray_pattern_repeat' );

        $control->add_tab( 'builtins', 'Built-ins',gray_background_customizer );


        $wp_customizer->add_setting(
        'gray_gradient_one',
            array(
                'default' => '#1958a0',
                'transport' => 'postMessage'
            )
        );

        $wp_customizer->add_control(new WP_Customize_Color_Control($wp_customizer, 'gray_gradient_one', array(
            'section'    => 'gray_pattern_background',
            'settings'   => 'gray_gradient_one',
        )));

        $wp_customizer->add_setting(
        'gray_gradient_two',
            array(
                'default' => '#001a6b',
                'transport' => 'postMessage'
            )
        );

        $wp_customizer->add_control(new WP_Customize_Color_Control($wp_customizer, 'gray_gradient_two', array(
        'section'    => 'gray_pattern_background',
        'settings'   => 'gray_gradient_two',
        )));

         if ( $wp_customizer->is_preview() && ! is_admin() ) {
            add_action( 'wp_footer', 'gray_customizer_preview', 21);
        }

        //send messages to post
        $wp_customizer->get_setting( 'blogname' )->transport         = 'postMessage';
        $wp_customizer->get_setting( 'blogdescription' )->transport  = 'postMessage';
        $wp_customizer->get_setting( 'header_textcolor' )->transport = 'postMessage';
    }
    add_action( 'customize_register', 'gray_customizer' );
    //create the varibles for the customizer preview
    function gray_customizer_preview(){
        ?>
        <script type="text/javascript">
            var color_one = "<?php echo  get_theme_mod('gray_gradient_one'); ?>";
            var color_two= "<?php echo get_theme_mod('gray_gradient_two'); ?>";
            var background_image= "<?php echo get_theme_mod('gray_pattern_repeat'); ?>" ;
            var cover_background_image =  "<?php echo get_theme_mod('gray_cover_background_image'); ?>" ;
        </script>
        <?php
    }

    //customizer preview script
    function gray_customizer_live_preview()
    {
        wp_enqueue_script( 
              'mytheme-themecustomizer',            //Give the script an ID
              get_template_directory_uri().'/js/preview.js',//Point to file
              array( 'jquery','customize-preview' ),    //Define dependencies
              '',                       //Define a version (optional) 
              true                      //Put script in footer?
        );
    }
    add_action( 'customize_preview_init', 'gray_customizer_live_preview' );

    //enqueue scripts
    function gray_script_style()
    {
        //add javascript to pages with comment form
        if ( is_singular() ) 
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

        //image overly style sheet
        wp_enqueue_style( 'gray_imageOverlay', get_template_directory_uri() . "/imageOverlay.css", array(), '1.0.0' );

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

        add_theme_support( 'custom-header', array('wp-head-callback'  => 'gray_header_style'));

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
  


?>