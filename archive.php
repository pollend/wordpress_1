<?php get_header(); ?>

    
    <div class="row">
        <div class="small-12  medium-9 large-expand columns">
            <?php
            if (have_posts())
            { 

                // $post = $posts[0];
                // echo "<div class=\"archive-title\">";
                // if (is_category()) {
                //     echo "Archive for the &#8216;" .single_cat_title(); . "&#8217; Category";
                // } 
                // elseif( is_tag() ) { 
                //     echo "Archive for the &#8216;".single_cat_title(); ."&#8217; Category";
                // } 
                // elseif (is_day()) {
                //     echo "Archive for " . the_time('F jS, Y');

                // } 
                // elseif (is_month()) {
                //     echo "Archive for " . the_time('F, Y');

                // } 
                // elseif (is_year()) {
                //     echo "Archive for " . the_time('Y');

                // } 
                // elseif (is_author()) {
                //  echo "Author Archive";

                // } 
                // elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {
                //     echo "Blog Archives";
                // }
                // echo "</div>";
                


                
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
        <?php theme_main_paginator(); ?>
    </div>

<?php get_footer(); ?>
