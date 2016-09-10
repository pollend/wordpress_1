<?php get_header(); ?>

<div class="row">
    <div class="small-12  medium-9 large-expand columns">
		<?php if (have_posts()) : ?>

 			<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
				<div class="archive-title">
			<?php /* If this is a category archive */ if (is_category()) { ?>
				Archive for the &#8216;<?php single_cat_title(); ?>&#8217; Category

			<?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
				Posts Tagged &#8216;<?php single_tag_title(); ?>&#8217;

			<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
				Archive for <?php the_time('F jS, Y'); ?>

			<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
				Archive for <?php the_time('F, Y'); ?>

			<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
				Archive for <?php the_time('Y'); ?>

			<?php /* If this is an author archive */ } elseif (is_author()) { ?>
				Author Archive

			<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
				Blog Archives
			<?php } ?>
			</div>
		
			<?php get_template_part( 'posts', get_post_format() );  ?>

				
		<?php else : ?>

			<h2>Nothing found</h2>

		<?php endif; ?>
		<script type="text/javascript" src=" <?php echo bloginfo('template_directory') . "/js/blog.js?ver=1.0.0"; ?>"></script>

	</div>

  	<div class="small-12 medium-3 large-expand columns">
		<?php get_sidebar(); ?>
	</div>
</div>


<?php get_footer(); ?>
