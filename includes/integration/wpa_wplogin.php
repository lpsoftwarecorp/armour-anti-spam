<?php
if ( ! defined( 'ABSPATH' ) ) exit;


	function wpa_wplogin_add_initiator_field() {
	    echo '<input type="hidden" id="wpa_initiator" class="wpa_initiator" name="wpa_initiator" value="" />';
	}

	add_action('lostpassword_form', 'wpa_wplogin_add_initiator_field');
	add_action('woocommerce_lostpassword_form', 'wpa_wplogin_add_initiator_field');
	 
	add_action( 'login_form', 'wpa_wplogin_add_initiator_field' );
	add_action( 'woocommerce_login_form', 'wpa_wplogin_add_initiator_field' ); // FIX FOR WOOCOMMERCE LOGIN.


	function wpa_wplogin_extra_validation( $user, $username, $password ) {
	    if ( ! empty( $_POST ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Missing -- reading third-party form data; spam trap cannot nonce-verify a form it does not own
		    if (wpa_check_is_spam($_POST)){ // phpcs:ignore WordPress.Security.NonceVerification.Missing -- reading third-party form data; spam trap cannot nonce-verify a form it does not own
		    	$postData = $_POST; // phpcs:ignore WordPress.Security.NonceVerification.Missing -- reading third-party form data; spam trap cannot nonce-verify a form it does not own
				$postData['pwd']	= '**removed**';
				do_action('wpa_handle_spammers','wplogin', $postData);
				return new WP_Error( 'error', $GLOBALS['wpa_error_message']);
			}
		}
		//return $user;
	}
	add_filter( 'authenticate', 'wpa_wplogin_extra_validation', 10, 3 );


	function wpa_lostpassword_extra_validation( $errors ) {
		if ( is_admin() ) { return; }

	    if (wpa_check_is_spam($_POST)){ // phpcs:ignore WordPress.Security.NonceVerification.Missing -- reading third-party form data; spam trap cannot nonce-verify a form it does not own
				do_action('wpa_handle_spammers','losspassword', $_POST); // phpcs:ignore WordPress.Security.NonceVerification.Missing -- reading third-party form data; spam trap cannot nonce-verify a form it does not own
				$errors->add( 'user_login', esc_html( $GLOBALS['wpa_error_message'] ) );
		}
	}
	add_action( 'lostpassword_post', 'wpa_lostpassword_extra_validation' );

