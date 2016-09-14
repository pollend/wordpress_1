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


if ( ! function_exists( 'theme_post_thumbnail' ) ) :
/**
 * Displays an optional post thumbnail.
 *
 * Wraps the post thumbnail in an anchor element on index views, or a div
 * element when on single views.
 *
 * Create your own twentysixteen_post_thumbnail() function to override in a child theme.
 *
 * @since Twenty Sixteen 1.0
 */
function theme_post_thumbnail() {
    if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
        return;
    }

    if ( is_singular() ) : ?>
        <div class="post-thumbnail">
             <?php the_post_thumbnail( 'post-thumbnail', array( 'alt' => the_title_attribute( 'echo=0' ), "class" => 'post-format-image post-head-image') ); ?>
        </div><!-- .post-thumbnail -->

    <?php else : ?>

        <a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
            <?php the_post_thumbnail( 'post-thumbnail', array( 'alt' => the_title_attribute( 'echo=0'), "class"=>'post-format-image post-head-image' ) ); ?>
        </a>

    <?php endif; // End is_singular()
}
endif;


?>