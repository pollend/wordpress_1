<?php get_header(); ?>

    <?php get_template_part( 'carousel', 'index' ); ?> 
    
    <div class="row">
        <div class="small-12  medium-9 large-expand columns">
            <?php
            if (have_posts())
            { 
                while (have_posts())
                { 
                    the_post();
                    get_template_part( 'content', get_post_format() );
                    //close post
                    echo '</div>';
                }
            }
            else
            {
                get_template_part('content','none');
                
                //close post
                echo '</div>';
            }
            
            ?>
        </div>

        <div class="small-12 medium-3 large-expand columns">
            <?php get_sidebar(); ?>
        </div>
    </div>

<?php get_footer(); ?>
