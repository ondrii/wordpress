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
    // add_filter('wpcf7_ajax_loader', 'muzli_wpcf7_loader');
    // function muzli_wpcf7_loader( $url ) {
    //     // die($url);
    //     return 'http://localhost:8888/wordpress/wp-content/themes/muzli/screenshot.png';
    // }




    /**
     * Sidebars and widgets
     */

     // tymto som pridal button 'Stuff to delete from yout inbox'
    add_filter('widget_text','do_shortcode');

    add_action( 'widgets_init', 'muzli_widgets_init' );
    function muzli_widgets_init() {
        /* Register the 'primary' sidebar. */
        register_sidebar(
            array(
                'id'            => 'sidebar-primary',
                'name'          => 'Pre-footer Sidebar',
                'description'   => 'Shows up under every page',
                'before_widget' => '<div id="%1$s" class="widget %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<h3 class="widget-title">',
                'after_title'   => '</h3>',
            )
        );
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

    /**
     * Customizer
     */
    add_action('customize_register','muzli_customize_register');
    function muzli_customize_register($wp_customize){

        $wp_customize->add_section('copyright', array(
            'title' => 'Copyright',
            'priority' => 30,
            'description' => 'copy info usually in footer',
        ));

        $wp_customize->add_setting( 'copy_by', array(
            'default' => get_option('blogname'),
            'transport' => 'refresh', // or postMessage
            'sanitize_callback' => function ($content){
                return sanitize_text_field( $content );
            },
          ) );

        $wp_customize->add_setting( 'copy_text', array(
            'default' => 'Created with happiness',
            'transport' => 'refresh', // or postMessage
            'sanitize_callback' => function ($content)
            {
                return wp_kses($content,array(
                  'strong' => array(),
                  'a' => array(
                      'href' => array(),
                      'title' => array(),
                  ),
                ));
            },
        ) );

        $wp_customize->add_control( 'copy_by', array(
            'type' => 'text',
            'priority' => 10, // Within the section.
            'section' => 'copyright', // Required, core or custom.
            'label' => 'Copyright by',
            // 'description' => 'name of your company',
          ) );

          $wp_customize->add_control( 'copy_text', array(
            'type' => 'textarea',
            'priority' => 20, // Within the section.
            'section' => 'copyright', // Required, core or custom.
            'label' => 'Copyright text',
            // 'description' => 'text of your textarea',
          ) );

          
    }



    /**
     * Theme Settings
     */

    //---------------------------------
    //tu su pouzite nejake hooky
    add_action( 'admin_menu', 'muzli_add_admin_menu' );
    add_action( 'admin_init', 'muzli_settings_init' );

    // tieto funkcie su pridanie funkcie stranky
    function muzli_add_admin_menu(  ) { 
        // 'add_options_page' -  pridam nejake nove stranky
        // 1. argument - nazov v 'title', 
        // 2. argument - nazov polozky v menut, 
        // 'manage_options' - kto to moze uprovovat,
        // 'theme_settings' - si vycitam z dokumentacie
        // 'muzli_options_page' - je nejaky 'callback' - nejaka funkcia, ktora je zodpovedna za vykreslenie samotneho formulara, do ktoreho si pridavam nejake polozky

        add_options_page( 'Theme Settings', 'Theme Settings', 'manage_options', 'theme_settings', 'muzli_options_page' );

    }


    function muzli_settings_init(  ) { 

        register_setting( 'muzli_theme', 'muzli_settings', 'save_muzli_theme_settings' );
        
        // COPYRIGHT SECTION
            //vytvaram tu nejake sekcie
        add_settings_section(
            'muzli_copyright_section', 
            __( 'Copyright info', 'muzli' ), 
            false, 
            'muzli_theme'
        );

            //v tych sekciach vytvaram nejake 'field'-y
        add_settings_field( 
            'copyright_by', 
            __( 'Copyright by', 'muzli' ), 
            'copyright_by_render', 
            'muzli_theme', 
            'muzli_copyright_section' 
        );

        add_settings_field( 
            'copyright_text', 
            __( 'Text in footer', 'muzli' ), 
            'copyright_text_render', 
            'muzli_theme', 
            'muzli_copyright_section' 
        );

        // LOGO SECTION
        add_settings_section(
            'muzli_logo_section', 
            __( 'Upload logo', 'muzli' ), 
            false, 
            'muzli_theme'
        );

        add_settings_field( 
            'logo', 
            __( 'Choose an Image', 'muzli' ), 
            'muzli_logo_render', 
            'muzli_theme', 
            'muzli_logo_section' 
        );


    }

    function save_muzli_theme_settings( $data) {

        $data = array_map('sanitize_text_field', $data);
        $options = extend_array(get_option('muzli_settings'), $data);

        if ( !empty( $_FILES['logo']['tmp_name'] ) && file_is_displayable_image( $_FILES['logo']['tmp_name'] ) ){
            $upload = wp_handle_upload( $_FILES['logo'], array('test_form'=> false) );
            $options['logo'] = $upload['url'];
        }

        return $options;
    }


    function copyright_by_render(  ) { 

        $options = get_option( 'muzli_settings' );
        $value = isset (options['copyright_by']) ? options['copyright_by'] : '' ; 
        ?>
        <input type="text" name="muzli_settings[copyright_by]" value="<?php echo $value ?>" class="regular-text">
        <?php

    }

    
    function copyright_text_render(  ) { 

        $options = get_option( 'muzli_settings' );
        $value = isset (options['copyright_text']) ? options['copyright_text'] : '' ; 
        ?>
        <textarea name="muzli_settings[copyright_text]" id="" cols="46" rows="3"><?php echo $value ?></textarea>
        <?php

    }

    function muzli_logo_render(  ) { 

        $options = get_option( 'muzli_settings' );
        $logo = isset ($options['logo']) ? $options['logo'] : '' ; ?>

            <p><input type="file" name="logo"></p>
            
        <?php if($logo): ?>
            <p><img src="<?php esc_url( $logo ) ?>" alt="muzli-logo" class="muzli-logo"></p>
        <?php endif;

    }


 
    function muzli_options_page(  ) { 

            ?>
            <div class="wrap">
                
                <h1>Theme Settings</h1>

                <form action="options.php" method="post" enctype="multipart/form-data">
                    <?php
                        settings_fields( 'muzli_theme' );
                        do_settings_sections( 'muzli_theme' );
                        submit_button();
                    ?>
                </form>
            </div>
            <style>
                .muzli-logo {
                    border: 1px solid #ddd;
                    border-radius: 6px;
                }
            </style>

            <?php

    }

    //---------------------------------







    /**
     * Add scripts & styles
     */
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

<?php 
/**
 * jQuery style array extend
 *
 * @return array
 */
function extend_array()
{
    $args     = func_get_args();
    $extended = array();
    if ( is_array( $args ) && count( $args ) )
    {
        foreach ( $args as $array )
        {
            if ( ! is_array( $array ) ) continue;
            $extended = array_merge( $extended, $array );
        }
    }
    return $extended;
}
?>

