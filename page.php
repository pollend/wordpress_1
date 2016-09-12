
<?php get_header(); ?>



    <div class="row">
        <div class="small-12  medium-9 large-expand columns">
                
            <?php 

            if (have_posts()) : while (have_posts()) : the_post();
                    get_template_part( 'content', 'page' );
                    
                    // If comments are open or we have at least one comment, load up the comment template.
                    if ( comments_open() || get_comments_number() ) :
                        comments_template();
                    endif;

                    //close post
                    echo '</div>';

                endwhile;
            endif;

            ?>
        </div>
        <div class="small-12 medium-3 large-expand columns">
            <?php get_sidebar(); ?>
        </div> 
        <?php theme_main_paginator(); ?>
    </div>



<?php get_footer(); ?>
