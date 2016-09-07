<div class="row">
	<div class="meta">
		<div class="day"><?php the_time('j') ?></div>
		<em><?php the_time('M Y') ?></em>
	</div>

	<div class="title">
		<a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
	</div>
</div>
<div class="author">by: <?php echo get_the_author()?></div>

