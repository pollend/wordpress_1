<?php get_header(); ?>



    <?php get_template_part( 'Presentation', 'index' ); ?> 
    
    <div class="row">
        <div class="small-12  medium-9 large-expand columns">
            <?php 
            //query_posts('page_id='. get_query_var( 'page_id' ) .'&paged=' .  get_query_var( 'paged' )  ); 
            query_posts(
                array(
                    'post_type' => array( 'post', 'game' ),
                    'page_id' =>  get_query_var( 'page_id' ),
                    'paged' =>  get_query_var( 'paged' )
                ));

            if (have_posts())
            { 
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
            }
            
             ?>
        </div>

        <div class="small-12 medium-3 large-expand columns">
            <?php get_sidebar(); ?>
        </div>
        <div class="small-12">
            <ul class="pagination" role="navigation" aria-label="Pagination">
                <?php
                $current_page = get_query_var( 'paged' );
                if($current_page == 0)
                    $current_page = 1;?>

                <?php if($current_page != 1): ?>
                    <li class="pagination-previous" > <a href="<?php echo get_site_url() . "?paged=" .($current_page-1). "&page_id=" . get_query_var( 'page_id' ) ?>" >Previous</a></li>
                <?php else: ?>
                    <li class="pagination-previous disabled" >Previous</li>
                <?php endif; ?>

                <?php
                for ($i = $current_page-4; $i <= ($current_page+ 4); $i++) {
                   
                    if($i ==  ($current_page))
                    {
                         ?>

                         <li class="current"><?php echo $i; ?></li>
                       <?php
                    }
                   else if($i >= 1 && $i < $wp_query->max_num_pages)
                   {
                       ?>

                        <li><a href="<?php echo get_site_url() . "?paged=" .$i. "&page_id=" . get_query_var( 'page_id' ) ?>"><?php echo $i; ?></a></li>
                       <?php
                    }
                }
                ?>

                <?php if($current_page != ($wp_query->max_num_pages-1)): ?>
                    <li class="pagination-next" > <a href="<?php echo get_site_url() . "?paged=" .($current_page + 1). "&page_id=" . get_query_var( 'page_id' ) ?>">Next</a></li>
                <?php else: ?>
                    <li class="pagination-next disabled" > Next</li>
                <?php endif; ?>

                 
            </ul>
        </div>
    </div>

 


<?php get_footer(); ?>
