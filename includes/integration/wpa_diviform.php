<?php
if ( ! defined( 'ABSPATH' ) ) exit; 


	foreach($_POST as $param => $value){ // phpcs:ignore WordPress.Security.NonceVerification.Missing -- reading third-party form data; spam trap cannot nonce-verify a form it does not own
		if(strpos($param, 'et_pb_contactform_submit') === 0){
			$is_divi_form = 'true';
			$divi_form_additional = str_replace('et_pb_contactform_submit', '', $param);
		}
	}

	if(!empty($is_divi_form) && $is_divi_form == 'true'){
		if (wpa_check_is_spam($_POST)){ // phpcs:ignore WordPress.Security.NonceVerification.Missing -- reading third-party form data; spam trap cannot nonce-verify a form it does not own
			do_action('wpa_handle_spammers','divi_form', $_POST); // phpcs:ignore WordPress.Security.NonceVerification.Missing -- reading third-party form data; spam trap cannot nonce-verify a form it does not own
			echo "<div id='et_pb_contact_form" . esc_attr( $divi_form_additional ) . "'><p>" . esc_html( $GLOBALS['wpa_error_message'] ) . "</p><div></div></div>";
			die();
		} else { // REMOVE OUR TEST FIELD BEFORE SENDING TO DIVI
			$fields_data_json  = str_replace( '\\', '', wp_unslash( $_POST['et_pb_contact_email_fields'.$divi_form_additional] ) ); // phpcs:ignore WordPress.Security.NonceVerification.Missing, WordPress.Security.ValidatedSanitizedInput.InputNotValidated, WordPress.Security.ValidatedSanitizedInput.InputNotSanitized -- third-party Divi form JSON; value is unslashed then parsed via json_decode() and fields validated structurally
			$fields_data_array = json_decode( $fields_data_json, true );
			if (is_array($fields_data_array)) {
				$filteredArray = array_filter($fields_data_array, function ($item) {
				    return $item['field_id'] !== 'alt_s' 
            && $item['field_id'] !== $GLOBALS['wpa_field_name'];
				});
				$_POST['et_pb_contact_email_fields'.$divi_form_additional] = json_encode( $filteredArray, JSON_UNESCAPED_UNICODE );
			}
		}
	}

