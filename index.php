<?php get_header(); ?>

<?php if($_GET['empty'] == "next_post"):?>

	<?php  
	query_posts('page_id='. $_GET["page_id"] .'&paged=' . $_GET["paged"]  ); 
	get_template_part( 'posts', 'index' ); ?>

<?php else: ?>
	<?php //get_template_part( 'Presentation', 'index' ); ?>
	<div id="blog-container">
		<div id="contentContainer">
		<?php 
			query_posts('page_id='. $_GET["page_id"] .'&paged=' . $_GET["paged"]  ); 
			get_template_part( 'posts', 'index' ); ?>
		</div>

		<div id="sidebarContainer">
			<?php get_sidebar(); ?>
		</div>
	</div>

<script type="text/javascript" src=" <?php echo bloginfo('template_directory') . "/js/blog.js?ver=1.0.0"; ?>"></script>


<?php endif; ?>

<div id="pageination-container">
	<div class="navigator">

 		<a class="arrow" href="<?php echo get_site_url() . "?paged=" .(get_query_var( 'paged' )-1). "&page_id=" . get_query_var( 'page_id' ) ?>"><</a>

		<?php
		for ($i =  get_query_var( 'paged' )-4; $i <= (get_query_var( 'paged' )+ 4); $i++) {
		   
			if($i ==  get_query_var( 'paged' ))
			{
				 ?>
			   <a class="selected" href=""><?php echo $i; ?></a>
			   <?php
			}
		   else if($i >= 0 && $i < $wp_query->max_num_pages)
		   {
			   ?>
			   <a href="<?php echo get_site_url() . "?paged=" .$i. "&page_id=" . get_query_var( 'page_id' ) ?>"><?php echo $i; ?></a>
			   <?php
			}


			if($i >= 0  && $i < $wp_query->max_num_pages-1 && $i <  (get_query_var( 'paged' )+ 4) )
			{
				echo ",";
			}

		}
		?>

		<a class="arrow" href="<?php echo get_site_url() . "?paged=" .(get_query_var( 'paged' )+1). "&page_id=" . get_query_var( 'page_id' ) ?>">></a>
	</div>
</div>