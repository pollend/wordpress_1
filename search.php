<?php get_header(); ?>

    <div id="contentContainer">
    <?php if (have_posts()) : ?>

        <div id="search-result">Search Results: <?php the_search_query(); ?></div>

        <?php while (have_posts()) : the_post(); ?>
            
            <div <?php post_class() ?> style="padding:20px;" id="post-<?php the_ID(); ?>">

                    <div class="postTitle"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></div>

                    <div class="meta">
                        <em>Posted on:</em> <span class="postTime"><?php the_time('F jS, Y') ?></span> by <span class="postAuthor"><?php echo get_the_author()?></span>
                    </div>
            

                <div class="entry">

                    <?php the_excerpt(); ?>

                </div>

            </div>

        <?php endwhile; ?>

    <?php else : ?>

        <div id="search-result"><h2>No posts found.</h2></div>

    <?php endif; ?>
    </div>
    <div id="sidebarContainer">
    <?php get_sidebar(); ?>
    </div>

