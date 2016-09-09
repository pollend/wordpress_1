<?php get_header(); ?>

	<div class="row">
	    <div class="small-9 columns">
	    <?php
                 while (have_posts())
                { 
                    the_post();
                    switch(get_post_type()){
                        case "game":
                            get_template_part( 'posts', 'game' );
                            break;
                        case "post":
                            get_template_part( 'posts', 'index' );
                            break;
                    }
                }	
               ?>
		</div>

        <div class="small-3 columns">
            <?php get_sidebar(); ?>
        </div>
	</div>

<?php get_footer(); ?>