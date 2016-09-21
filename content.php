<?php $content = get_the_content(); ?>

<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
    
    <?php cr8_base_theme_post_thumbnail(); ?>

    <div class="main-post-body">
            <?php  get_template_part( 'content', 'header' );?>

            <div class="entry">
                <?php  
                    $content = apply_filters('the_content', $content);
                    $content = str_replace(']]>', ']]&gt;', $content);
                    echo $content; 

                    ?>

            </div>

            <?php  get_template_part( 'content', 'footer' );?>
        

    </div>