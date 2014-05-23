
<?php if(empty($_GET['empty'])): ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>



	<meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	
	<?php if (is_search()) { ?>
	   <meta name="robots" content="noindex, nofollow" /> 
	<?php } ?>

	<title>
	 <?php wp_title('|'); ?>
	</title>
	
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

	<head profile="http://gmpg.org/xfn/11"><?php wp_head(); ?></head>

<body <?php body_class(); ?>>

	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-51267322-1', 'smoketreestudios.com');
	  ga('send', 'pageview');

	</script>

	<div id="overlay-backdrop"></div>
	<div id="overlay-enlarged-image-container">
		<div id="overlay-image">
			<img id="image-overlay-image"></img>
			<div id="image-over-loading"></div>
			<a id="image-overlay-close" href="#"><div class="overlay-controls"></div></a>
			<div id="image-overlay-caption" class="overlay-controls">
				<div class="num-images"></div>

				<div class="image-caption"></div>

			</div>
			<a href="#" id="image-overlay-left"><div class="click-area"></div><div class="button" class="overlay-controls"></div></a>
			<a href="#" id="image-overlay-right"><div class="click-area"></div><div class="button" class="overlay-controls"></div></a>

		</div>
	</div>
	<div id="menu-container" class="up">
		<a href="#" id="minimizer"><</a>

		<div id="header">

			<div id="title">

				<?php if(get_header_image() == "") : ?>
					<a href="<?php echo home_url(); ?>/"><?php bloginfo('name'); ?></a>
				<?php else: ?>
					<img src="<?php header_image(); ?>" height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" alt="" />
				<?php endif; ?>

			</div>

			<!--div class="description"><?php bloginfo('description'); ?></div-->
		</div>
			<?php get_search_form(); ?>
			<?php wp_nav_menu(array( 'theme_location' => 'primary', 'container_class' => 'menu')); ?>
		
	</div>


	<div id="page">

	<div id="main">

	<?php get_footer(); ?>

	<?php exit(); ?>
<?php else: ?>

	<title><?php wp_title('|'); ?></title>

<?php endif; ?>
