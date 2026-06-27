<?php
if ( ! defined( 'ABSPATH' ) ) exit; 


	add_filter( 'frm_validate_entry', 'wpa_formidable_extra_validation', 10, 2 );

	function wpa_formidable_extra_validation($errors, $values){
		if (wpa_check_is_spam($_POST)){ // phpcs:ignore WordPress.Security.NonceVerification.Missing -- reading third-party form data; spam trap cannot nonce-verify a form it does not own
			do_action('wpa_handle_spammers','formidable', $_POST); // phpcs:ignore WordPress.Security.NonceVerification.Missing -- reading third-party form data; spam trap cannot nonce-verify a form it does not own
			$errors['my_error'] = $GLOBALS['wpa_error_message'];
		}
		return $errors;
	}

