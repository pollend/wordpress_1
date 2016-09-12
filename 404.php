<?php get_header(); ?>

    <div class="row error-404 post-box">
		<div class="main-post-body small-12">
			<div class="title"> 404</div>
			<div class="sub-title">Page not found</div>
			<div class="error-message">
				<p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'twentysixteen' ); ?></p>
			</div>
			<div class="search-container">
				<?php get_search_form(); ?>
			</div>
		</div>
    </div>

<?php get_footer(); ?>
