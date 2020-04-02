<?php
/**
 * Handles hooks and actions for wp-login.php
 *
 */

if( !function_exists( 'easy_login_styler_enqueue' ) ):
    add_action( 'login_enqueue_scripts', 'easy_login_styler_enqueue', 10 );
    function easy_login_styler_enqueue(){
        wp_enqueue_style( 'login-styler', EASY_LOGIN_STYLER_PLUGIN_URL . 'assets/css/easy-login-styler.css', false );
    }
endif;
if( !function_exists( 'easy_login_styler_head' ) ):
    add_action( 'login_head', 'easy_login_styler_head' );
    function easy_login_styler_head(){
        $options = get_option( 'easy_login_styler_settings' );?>
    <?php
        if( is_array( $options ) && !empty( $options ) ){ ?>
            <style type="text/css">
                <?php if( isset( $options['background'] ) && !empty( $options['background'] ) ){
                    echo 'body .easy-login-styler-bg{ background-image: url("'. wp_get_attachment_image_url($options['background'], 'full') .'") !important; }';
                }
                if( isset( $options['logo'] ) && !empty( $options['logo'] ) ){
                    echo 'body #login h1 a{ background-image: url("'. wp_get_attachment_image_url($options['logo'], 'full') .'") !important; }';
                }
                if( isset( $options['css'] ) && !empty( $options['css'] ) ){
                    echo esc_textarea( $options['css'] );
                }?>
            </style>
        <?php }
    }
endif;

if( !function_exists( 'easy_login_styler_title' ) ):
    add_filter( 'login_message', 'easy_login_styler_title' );
    function easy_login_styler_title( $message ) {
        if ( empty($message) ){
            return '<h2 class="easy-login-styler-title">'. __( 'Log In', 'easy-login-styler' ) .'</h2>';
        } else {
            return $message;
        }
    }
endif;

if( !function_exists( 'easy_login_styler_url' ) ):
    add_filter( 'login_headerurl', 'easy_login_styler_url' );
    function easy_login_styler_url( $url ){
        $options = get_option( 'easy_login_styler_settings' );

        if( isset( $options['logo'] ) && !empty( $options['logo'] ) ){
            $url = esc_url( home_url( '/' ) );
        }

        return $url;
    }
endif;

if( !function_exists( 'easy_login_styler_alt' ) ):
    add_filter( 'login_headertitle', 'easy_login_styler_alt' );
    function easy_login_styler_alt( $alt ){
        $options = get_option( 'easy_login_styler_settings' );

        if( isset( $options['logo'] ) && !empty( $options['logo'] ) ){
            $alt = get_bloginfo( 'name' );
        }

        return $alt;
    }
endif;

if( !function_exists( 'easy_login_styler_footer' ) ):
    add_action( 'login_footer', 'easy_login_styler_footer' );
    function easy_login_styler_footer( $input_id ){ ?>
        <div class="easy-login-styler-bg"></div>
    <?php }
endif;
