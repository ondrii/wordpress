<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="<?php bloginfo('charset')?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?php bloginfo('name') ?></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>
            <?php 
                wp_title('/',true,'right');
                if(is_front_page()) echo ' / '.get_bloginfo('description');
            ?>
        </title>

        <?php 
            wp_head() ;
        ?>

    </head>
    <body <?php body_class() ?>>


        <?php 
            log_me(['sevas','pipa']);
        ?>

        <header class="site-header">
                <!-- Jedna verzia, kde som si poskusal moznosti wp_nav_menu -->
                <?php  
                    // wp_nav_menu(array(
                    //     'theme_location' => 'primary',
                    //     'menu_class' => 'menu',
                    //     'container' => 'nav',
                    //     'container_class' => 'container',
                    //     'link_before' => '<span class="icon">',
                    //     'link_after' => '</span>',
                    //     'items_wrap' => '<ul class="%2$s">%3$s</ul>'
                    // ));
                ?> 

            <!-- Pekna z verzii ako mozem cisto nahodit menu -->
            <nav class="container">
                <?php  
                    wp_nav_menu(array(
                        'theme_location' => 'primary',
                        'menu_class' => 'menu',
                        'container' => false
                    ));
                ?>
            </nav>
            
            <!-- Pekna z verzii, kde si mozem ziskat aj data cez 'id', co je aktualne 'main-navigation' -->
            <!-- <nav class="container"> -->
              <?php  
                    // wp_nav_menu(array(
                    //     'menu' => 'main-navigation',
                    //     'menu_class' => 'menu',
                    //     'container' => false
                    // ));
                ?>
            <!-- </nav> -->


            <!-- <nav class="container"> -->
              <?php  
                    // $menu_items = wp_get_nav_menu_items('main-navigation');
                    // foreach($menu_items as $item){
                    //     echo '<pre>';
                    //     print_r( $item->title );
                    //     echo '</pre>';
                    //     echo '<pre>';
                    //     print_r( $item->url );
                    //     echo '</pre>';
                    // }
                ?>
            <!-- </nav> -->



        </header>

        <main>
            <section class="content container">