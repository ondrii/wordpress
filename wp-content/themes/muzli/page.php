<?php get_header() ?>

<?php if (have_posts()) :?>
    <?php while (have_posts()) : the_post() ?>
        <?php the_content() ?>

        <?php the_post_thumbnail('full', array('class' => 'bigass')) ?>
        
       



    <?php endwhile ?>
<?php else : ?>


<?php endif ?>

<?php get_footer() ?>