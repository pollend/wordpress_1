<?php get_header(); ?>

<?php if($_GET['empty'] == "next_post"):?>

	<?php  
	query_posts('page_id='. $_GET["page_id"] .'&paged=' . $_GET["paged"]  ); 
	get_template_part( 'posts', 'index' ); ?>

<?php else: ?>
	<?php get_template_part( 'Presentation', 'index' ); ?>
	<div id="blog-container">
		<div id="contentContainer">
		<?php 

			query_posts('page_id='. get_query_var( 'page_id' ) .'&paged=' .  get_query_var( 'paged' )  ); 
			get_template_part( 'posts', 'index' ); ?>
		</div>

		<div id="sidebarContainer">
			<?php get_sidebar(); ?>
		</div>
	</div>

<script type="text/javascript" src=" <?php echo bloginfo('template_directory') . "/js/blog.js?ver=1.0.0"; ?>"></script>
<script type="text/javascript" src=" <?php echo bloginfo('template_directory') . "/js/carousel.js?ver=1.0.0"; ?>"></script>



<?php endif; ?>

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
</div>