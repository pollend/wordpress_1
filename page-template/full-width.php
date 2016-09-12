<?php 
/**
 * Template Name:Full Width Template
 */
?>

<?php get_header(); ?>
	<div class="row">
		<div class="small-12 columns">
  			<?php
	            if (have_posts())
	            { 
	                while (have_posts())
	                { 
	                    the_post();
	                    get_template_part( 'content', 'page' );
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
	</div>



<?php get_footer(); ?>
