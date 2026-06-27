<?php
if ( ! defined( 'ABSPATH' ) ) exit; 
/* BB PRESS */

	add_action(	'bbp_new_topic_pre_extras','wpa_bbp_extra_validation');
	add_action(	'bbp_new_reply_pre_extras','wpa_bbp_extra_validation');

	function wpa_bbp_extra_validation(){
		if (wpa_check_is_spam($_POST)){ // phpcs:ignore WordPress.Security.NonceVerification.Missing -- reading third-party form data; spam trap cannot nonce-verify a form it does not own
			do_action('wpa_handle_spammers','bbpress', $_POST); // phpcs:ignore WordPress.Security.NonceVerification.Missing -- reading third-party form data; spam trap cannot nonce-verify a form it does not own
			bbp_add_error( 'bbp_extra_email', esc_html( $GLOBALS['wpa_error_message'] ) );
		}
	}

