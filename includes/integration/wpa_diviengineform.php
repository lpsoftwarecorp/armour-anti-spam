<?php
if ( ! defined( 'ABSPATH' ) ) exit; 


	function my_df_before_process($form_id,$post_array,$form_type){
			if (wpa_check_is_spam($_POST)){ // phpcs:ignore WordPress.Security.NonceVerification.Missing -- reading third-party form data; spam trap cannot nonce-verify a form it does not own
				foreach($_POST as $param => $value){ // phpcs:ignore WordPress.Security.NonceVerification.Missing -- reading third-party form data; spam trap cannot nonce-verify a form it does not own
					if(strpos($param, 'divi-form-submit') === 0){
					$is_divi_engine_form = 'true';
					$divi_engine_form_additional = str_replace('divi-form-submit', '', $param);
				}
				}
				do_action('wpa_handle_spammers','divi_engine_form', $_POST); // phpcs:ignore WordPress.Security.NonceVerification.Missing -- reading third-party form data; spam trap cannot nonce-verify a form it does not own
				if (isset($_SERVER["REQUEST_URI"]) && substr( sanitize_text_field( wp_unslash( $_SERVER["REQUEST_URI"] ) ), -strlen("admin-ajax.php")) === "admin-ajax.php"){
					// ajax post
					$result = array( 'result' => 'failed', 'redirect' => '', 'message' => '<B>' . esc_html($GLOBALS['wpa_error_message']) . '</B>', 'message_position' => 'after_button');
					wp_send_json( $result );
				}
				else
				{
					echo "<div id='fb_form" . esc_attr( $divi_engine_form_additional ) . "'><p>" . esc_html( $GLOBALS['wpa_error_message'] ) . "</p><div></div></div>";
				}

				die();
			}	
	}
	add_action( 'df_before_process', 'my_df_before_process', 10, 3 );

