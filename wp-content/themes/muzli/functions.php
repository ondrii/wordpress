<?php 

    add_action('after_setup_theme','muzli_setup');
    function muzli_setup() {
        /**
         * Theme support
         */
        add_theme_support('menus');
        add_theme_support('post-thumbnails');
        add_theme_support('title-tag');
        // add_theme_support( 'post-formats', array( 'aside', 'gallery', 'quote', 'video' ) );
        add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );
        

        /**
         * Menus
         */
        register_nav_menus(array(
            'primary' => 'Primary Menu',
        ));

        /**
         * Editor Style 
         */
        add_editor_style('css/editor-style.css');

        /**
         * Shortcodes
         */
      
        add_shortcode('button', 'muzli_button_shortcoder');
        function muzli_button_shortcoder($atts, $content = 'Empty text') {

            // set defaults
            $atts = shortcode_atts(array(
                'color' => '',
                'link' => '#',
            ),$atts);

            // create css class from color
            if ( $atts['color'] ) $atts['color'] = 'btn-'.$atts['color'];


            // outside or internal link?
            $parsed = wp_parse_url( $atts['link'] );

            if ( !isset($parsed['scheme']) ) {
                $atts['link'] = home_url( $atts['link'] );
            }


            // create the html
            $html = '<a href="'.esc_attr($atts['link']).'" class="btn '. esc_attr($atts['color']) .' animate">';
            $html .= esc_html($content);
            $html .= '</a>';

            return $html;
        }


        add_shortcode('simple_gallery', 'muzli_gallery_shortcode');
        function muzli_gallery_shortcode($atts) {

            // set defaults
            $atts = shortcode_atts(array(
                'gallery_class' => 'image-grid group',
                'img_class' => 'gallery-img',
            ),$atts);

            $media = get_attached_media('image');

            $html = '<div class="'. esc_attr($atts['gallery_class']) .'">';
            foreach ( $media as $img )
            {
                $html .=
                '<img src="'. esc_url( wp_get_attachment_image_url($img->ID, 'full') ) .'"
                    class="'. esc_attr( $atts['img_class'] ) .'"
                    alt="'. esc_attr( $img->post_title ) .'">';
            }
            $html .= '</div>';
            
            return $html;
        }
    }

    // change contact form 7 ajax loader icon
    // !!! AKTUALNE MI TO NEJAKE NEFUNGUJE !!!!
    add_filter('wpcf7_ajax_loader', 'muzli_wpcf7_loader');
    function muzli_wpcf7_loader( $url ) {
        // die($url);
        return 'http://localhost:8888/wordpress/wp-content/themes/muzli/screenshot.png';
    }
?>

<?php 
     add_filter( 'body_class', 'muzli_body_classes' );
    //  function muzli_body_classes( $classes )
    //  {
    //      global $post;
    //      $classes = [ $post->post_name ];
    //      return $classes;
    //  }

    function muzli_body_classes( $classes )
    {
        $slug = get_post_field( 'post_name', get_post() );
        $classes = array( $slug );
        return $classes;
    }


    add_filter('the_content','muzli_after_content');
    function muzli_after_content($content){
        $content .= '<p>- Most written on iPhone. Sokeres!</p>';
        return $content;
    }
?>


<?php 
    add_action('wp_enqueue_scripts', 'muzli_theme_scripts');
    function muzli_theme_scripts()
    {
        wp_enqueue_script(
            'muzli-app', 
            get_template_directory_uri().'/js/app.js',
            array('jquery'),
            '',
            true
        );

        wp_enqueue_style(
            'muzli-style', 
            get_stylesheet_uri()
        );

        wp_enqueue_style(
            'muzli-animations', 
            get_template_directory_uri().'/css/animations.css'
        );

        wp_enqueue_style(
            'muzli-fonts', 
            'http://fonts.googleapis.com/css?family=Montserrat:400,700'
        );
    }
?>

<?php 
    // add_action('wp_enqueue_scripts', 'add_theme_scripts');
    // function add_theme_scripts()
    // {
    //     wp_register_script(
    //         'muzli-app', 
    //         get_template_directory_uri().'/js/app.js',
    //         array('jquery'),
    //         '',
    //         true
    //     );

    //     wp_enqueue_script('muzli-app');
    // }
?>



 
<?php 

    function log_me( $message )
    {
        if ( true !== WP_DEBUG ) return false;
        if ( is_array($message) || is_object($message) ) {
            return error_log( json_encode($message) );
        }
        return error_log( $message );
    }

?>


