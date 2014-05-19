<?php 
	if ( 'posts' == get_option( 'show_on_front' ) ): 
		include( get_home_template());
	else:

	?>

	<?php get_header(); ?>
	<?php  get_template_part( 'Presentation', 'index' ); ?>
	<?php  endif; ?>

?>
