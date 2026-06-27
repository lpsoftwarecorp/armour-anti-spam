<?php
if ( ! defined( 'ABSPATH' ) ) exit; 


	add_filter( 'wpcf7_validate', 'wpa_contactform7_extra_validation', 10, 2 );

	function wpa_contactform7_extra_validation($result, $tags){
		if ( empty( $result->get_invalid_fields() ) ) { // only check spam if validation passed
		 	if (wpa_check_is_spam($_POST)){ // phpcs:ignore WordPress.Security.NonceVerification.Missing -- reading third-party form data; spam trap cannot nonce-verify a form it does not own
				do_action('wpa_handle_spammers','contactform7', $_POST); // phpcs:ignore WordPress.Security.NonceVerification.Missing -- reading third-party form data; spam trap cannot nonce-verify a form it does not own
				$result->invalidate('', $GLOBALS['wpa_error_message']);
			}
		}	
		return $result;
	}

