<?php

	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if ( post_password_required() ) { ?>
		This post is password protected. Enter the password to view comments.
	<?php
		return;
	}
?>

<?php if ( have_comments() ) : ?>
	
	<h2 id="comments"><?php comments_number('Total Comments(0)', 'Total Comments(`)','Total Comments(%)' );?></h2>

	<div class="navigation">
		<div class="next-posts"><?php previous_comments_link() ?></div>
		<div class="prev-posts"><?php next_comments_link() ?></div>
	</div>

	<ol class="commentlist">
		<?php wp_list_comments(array('avatar_size' => 70)); ?>
	</ol>

	<div class="navigation">
		<div class="next-posts"><?php previous_comments_link() ?></div>
		<div class="prev-posts"><?php next_comments_link() ?></div>
	</div>
	
 <?php else : // this is displayed if there are no comments so far ?>

	<?php if ( comments_open() ) : ?>
		<!-- If comments are open, but there are no comments. -->

	 <?php else : // comments are closed ?>
	 	<?php  if(!is_page()): ?>
			<p>Comments are closed.</p>
		<?php endif; ?>

	<?php endif; ?>
	
<?php endif; ?>

<?php if ( comments_open() ) : ?>
	<div id="comment-main-container">
		<?php comment_form(array('cancel_reply_link' => '<div id="cancel-button"></div>')); ?>
	</div>

<?php endif; ?>
