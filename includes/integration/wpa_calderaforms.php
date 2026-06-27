<?php
if ( ! defined( 'ABSPATH' ) ) exit; 

	function wpa_calderaforms_extra_validation(  ) { 
	   	if (wpa_check_is_spam($_POST)){ // phpcs:ignore WordPress.Security.NonceVerification.Missing -- reading third-party form data; spam trap cannot nonce-verify a form it does not own
			do_action('wpa_handle_spammers','calderaforms', $_POST); // phpcs:ignore WordPress.Security.NonceVerification.Missing -- reading third-party form data; spam trap cannot nonce-verify a form it does not own
			die( esc_html( $GLOBALS['wpa_error_message'] ) );
		}
	};
	add_action( 'caldera_forms_pre_load_processors', 'wpa_calderaforms_extra_validation', 10, 0 );
