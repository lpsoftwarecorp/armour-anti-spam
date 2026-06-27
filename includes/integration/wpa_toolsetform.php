<?php
if ( ! defined( 'ABSPATH' ) ) exit; 


	add_filter('cred_form_validate','wpa_toolsetform_extra_validation',20,2);

	function wpa_toolsetform_extra_validation($error_fields, $form_data)
	{
	    list($fields,$errors)=$error_fields;
	    if (wpa_check_is_spam($_POST)){ // phpcs:ignore WordPress.Security.NonceVerification.Missing -- reading third-party form data; spam trap cannot nonce-verify a form it does not own
			do_action('wpa_handle_spammers','toolset_form', $_POST); // phpcs:ignore WordPress.Security.NonceVerification.Missing -- reading third-party form data; spam trap cannot nonce-verify a form it does not own
			die( esc_html( $GLOBALS['wpa_error_message'] ) );
		}
	    return array($fields,$errors);
	}

