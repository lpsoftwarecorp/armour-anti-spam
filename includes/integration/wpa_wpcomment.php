<?php
if ( ! defined( 'ABSPATH' ) ) exit; 
// WP Comments


    add_filter( 'preprocess_comment', 'wpa_wpcomment_extra_validation' );

    function wpa_wpcomment_extra_validation( $commentdata ) {
        if (wpa_check_is_spam($_POST)){ // phpcs:ignore WordPress.Security.NonceVerification.Missing -- reading third-party form data; spam trap cannot nonce-verify a form it does not own
    		do_action('wpa_handle_spammers','wpcomment', $_POST); // phpcs:ignore WordPress.Security.NonceVerification.Missing -- reading third-party form data; spam trap cannot nonce-verify a form it does not own
            wp_die( esc_html( $GLOBALS['wpa_error_message'] ) );
        }
        return $commentdata;
    }

