<?php get_header(); ?>



    <!-- <?php get_template_part( 'Presentation', 'index' ); ?> -->
    <div class="row">
        <div class="small-12  medium-9 large-expand columns">
            <?php 
            query_posts('page_id='. get_query_var( 'page_id' ) .'&paged=' .  get_query_var( 'paged' )  ); 
            get_template_part( 'posts', 'index' ); ?>
        </div>

        <div class="small-12 medium-3 large-expand columns">
            <?php get_sidebar(); ?>
        </div>
    </div>

<!-- 
<div id="pageination-container">
    <div class="navigator">

        <?php
        $current_page = get_query_var( 'paged' );
        if($current_page == 0)
            $current_page = 1;
        ?>
        <?php if( $current_page != 1):?>
            <a class="arrow" href="<?php echo get_site_url() . "?paged=" .($current_page-1). "&page_id=" . get_query_var( 'page_id' ) ?>"><</a>
        <?php endif; ?>

        <?php
        for ($i = $current_page-4; $i <= ($current_page+ 4); $i++) {
           
            if($i ==  ($current_page))
            {
                 ?>
               <a class="selected" href=""><?php echo $i; ?></a>
               <?php
            }
           else if($i >= 1 && $i < $wp_query->max_num_pages)
           {
               ?>
               <a href="<?php echo get_site_url() . "?paged=" .$i. "&page_id=" . get_query_var( 'page_id' ) ?>"><?php echo $i; ?></a>
               <?php
            }
            if($i >= 1  && $i < $wp_query->max_num_pages-1 && $i <  ($current_page+ 4) )
            {
                echo ",";
            }
        }
        ?>
        
        <?php if( $current_page != ($wp_query->max_num_pages-1)):?>
            <a class="arrow" href="<?php echo get_site_url() . "?paged=" .($current_page+1). "&page_id=" . get_query_var( 'page_id' ) ?>">></a>
        <?php endif; ?>
    </div>
</div> -->


<?php get_footer(); ?>
