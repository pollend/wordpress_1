<?php 
/**
 * Template Name: Front Page Template DED
 */

update_option('current_page_template','front-page');
?>

<?php get_header(); ?>

<?php  get_template_part( 'Presentation', 'index' ); ?>
<?php get_footer(); ?>
