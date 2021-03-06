<div id="sidebar">

    <?php if ( dynamic_sidebar('Sidebar Widgets')) : else : ?>
    
    
    	<?php wp_list_pages('title_li=<h3>Pages</h3>' ); ?>
    
    	<h3>Archives</h3>
    	<ul>
    		<?php wp_get_archives('type=monthly'); ?>
    	</ul>
        
        <h3>Categories</h3>
        <ul>
    	   <?php wp_list_categories('show_count=1&title_li='); ?>
        </ul>
        
    	<?php wp_list_bookmarks(); ?>
    
    	<h3>Meta</h3>
    	<ul>
    		<?php wp_register(); ?>
    		<li><?php wp_loginout(); ?></li>
    		<li><a href="http://wordpress.org/" title="Powered by WordPress, state-of-the-art semantic personal publishing platform.">WordPress</a></li>
    		<?php wp_meta(); ?>
    	</ul>
    	
    	<h3>Subscribe</h3>
    	<ul>
    		<li><a href="<?php bloginfo('rss2_url'); ?>">Entries (RSS)</a></li>
    		<li><a href="<?php bloginfo('comments_rss2_url'); ?>">Comments (RSS)</a></li>
    	</ul>
	
	<?php endif; ?>

</div>