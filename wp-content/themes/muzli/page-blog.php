<?php get_header() ?>

<?php if (have_posts()) :?>
    <?php while (have_posts()) : the_post() ?>
        
        <?php the_content() ?>

        <div class="post-list">
            <?php 
                // $posts = get_posts();
                // echo '<pre>';
                // print_r( $posts );
                // echo'</pre>';
            ?>
        </div>

    <?php endwhile ?>
<?php else : ?>


<?php endif ?>

<?php get_footer() ?>