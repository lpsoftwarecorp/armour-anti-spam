<?php
if ( ! defined( 'ABSPATH' ) ) exit; 


	add_action( 'gform_validation', 'wpa_gravityforms_extra_validation');

	function wpa_gravityforms_extra_validation($validation_result ){
		if (wpa_check_is_spam($_POST)){ // phpcs:ignore WordPress.Security.NonceVerification.Missing -- reading third-party form data; spam trap cannot nonce-verify a form it does not own
			$form = $validation_result['form'];
			do_action('wpa_handle_spammers','gravityforms', $_POST); // phpcs:ignore WordPress.Security.NonceVerification.Missing -- reading third-party form data; spam trap cannot nonce-verify a form it does not own
			$validation_result['is_valid'] = false;
			$form['fields'][0]->failed_validation = true;
			$form['fields'][0]->validation_message = $GLOBALS['wpa_error_message'];
			$validation_result['form'] = $form;
		}
		return $validation_result;
	}
