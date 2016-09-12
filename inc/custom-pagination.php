<?php

if ( ! function_exists( 'theme_main_paginator' ) ) :
    function theme_main_paginator()
    {
        global $wp_query;
        $max_pages = $wp_query->max_num_pages;
        if( $max_pages == 0)        
            return;


         $current_page = get_query_var( 'paged' );
        ?>
            <div class="small-12">
                <ul class="pagination" role="navigation" aria-label="Pagination">
                    <?php
                    if($current_page == 0)
                        $current_page = 1;?>

                    <?php if($current_page != 1): ?>
                        <li class="pagination-previous" > <a href="<?php echo get_site_url() . "?paged=" .($current_page-1). "&page_id=" . get_query_var( 'page_id' ) ?>" >Previous</a></li>
                    <?php else: ?>
                        <li class="pagination-previous disabled" >Previous</li>
                    <?php endif; ?>

                    <?php
                    for ($i = $current_page-4; $i <= ($current_page+ 4); $i++) {
                       
                        if($i ==  $current_page)
                        {
                             ?>

                             <li class="current"><?php echo $i; ?></li>
                           <?php
                        }
                       else if($i >= 1 && $i <  $max_pages)
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
        <?php

    }

endif;

?>