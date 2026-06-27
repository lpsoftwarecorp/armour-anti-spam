<?php
if ( ! defined( 'ABSPATH' ) ) exit; 


	add_filter( 'wpforms_process_before', 'wpa_wpforms_extra_validation', 10, 2 );

	function wpa_wpforms_extra_validation($entry, $form_data){
		if (wpa_check_is_spam($_POST)){ // phpcs:ignore WordPress.Security.NonceVerification.Missing -- reading third-party form data; spam trap cannot nonce-verify a form it does not own
			do_action('wpa_handle_spammers','wpforms', $_POST); // phpcs:ignore WordPress.Security.NonceVerification.Missing -- reading third-party form data; spam trap cannot nonce-verify a form it does not own
			wpforms()->process->errors[ $form_data['id'] ][ '0' ] = $GLOBALS['wpa_error_message'];
		}
	}

