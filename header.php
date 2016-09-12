
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

    <head profile="http://gmpg.org/xfn/11"><?php wp_head(); ?>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <?php if (is_search()) { ?>
           <meta name="robots" content="noindex, nofollow" /> 
        <?php } ?>

        <title>
         <?php wp_title('|'); ?>
        </title>
        
        <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
    </head>



<body <?php body_class(); ?> id="app">

    <?php //background overlay used for image enlarger ?>
    <div id="overlay-backdrop"></div>
    <div id="overlay-enlarged-image-container">
        <div id="overlay-image">
            <img id="image-overlay-image"></img>
            <div id="image-over-loading"></div>
            <a id="image-overlay-close" href="#"><div class="overlay-controls"></div></a>
            <div id="image-overlay-caption" class="overlay-controls">
                <div class="num-images"></div>

                <div class="image-caption"></div>

            </div>
            <a href="#" id="image-overlay-left"><div class="click-area"></div><div class="button" class="overlay-controls"></div></a>
            <a href="#" id="image-overlay-right"><div class="click-area"></div><div class="button" class="overlay-controls"></div></a>

        </div>
    </div>


    <div class="row">
        <div class="header-title small-12">
            <?php if(get_header_image() == "") : ?>
                <a href="<?php echo home_url(); ?>/"><?php bloginfo('name'); ?></a>
            <?php else: ?>
                <img src="<?php header_image(); ?>" height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" alt="" />
            <?php endif; ?>
        </div>  
    </div>

    <div class="row">
        <div class="top-bar stacked-for-medium header-container">
        <!-- <div class="top-bar" id="top-header"> -->
            
                <?php wp_nav_menu();?>
            
          <!-- </div> -->
          <!-- <div class="top-bar-right">
            <?php //get_search_form(); ?>
          </div> -->
        </div>
    </div>