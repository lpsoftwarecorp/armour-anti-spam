<?php
if ( ! defined( 'ABSPATH' ) ) exit;

function wpa_load_scripts(){
    if( get_option('wpa_disable_jquery') === 'yes' ) {
        wp_enqueue_script( 'wpascript', plugins_url( '/js/wpa_vanilla.js', __FILE__ ), array(), $GLOBALS['wpa_version'], true );
    } else {
        wp_enqueue_script( 'wpascript', plugins_url( '/js/wpa.js', __FILE__ ), array('jquery'), $GLOBALS['wpa_version'], true );
    }

    wp_add_inline_script( 'wpascript', 'wpa_field_info = JSON.parse(atob("'.base64_encode(json_encode(wpa_field_info())).'"));');
    wp_enqueue_style( 'wpa-css', plugins_url( '/css/wpa.css', __FILE__ ), array(), $GLOBALS['wpa_version']);
}

function wpa_plugin_menu(){
    $GLOBALS['wpa_admin_page_hook'] = add_menu_page( 'Armour Anti-Spam', 'Armour Anti-Spam', 'edit_pages', 'armour-anti-spam', 'wpa_options','dashicons-shield');
}

function wpa_admin_assets($hook){
    if ( empty($GLOBALS['wpa_admin_page_hook']) || $hook !== $GLOBALS['wpa_admin_page_hook'] ) {
        return; // only load on the Armour Anti-Spam settings page
    }
    wp_enqueue_style( 'wpa-admin-css', plugins_url( '/css/wpa_admin.css', __FILE__ ), array(), $GLOBALS['wpa_version'] );
}

function wpa_options(){
	$wpa_tabs = array(
				'settings' => array('name'=>'Settings','path'=>'wpa_settings.php'),
				'stats' => array('name'=>'Statistics','path'=>'wpa_stats.php')
	);

	$wpa_tabs = apply_filters( 'wpa_tabs_filter', $wpa_tabs);

	include 'views/wpa_main.php';
}

function wpa_save_settings(){	
	if ( isset($_POST['wpa_nonce']) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['wpa_nonce'] ) ), 'wpa_save_settings')) {		
		if (empty($_POST['wpa_field_name'])){
			$return['status']   = 'error';
			$return['body'] 	= "Spam Trap Field Name can't be empty";
		} else {
			update_option('wpa_field_name',sanitize_title_with_dashes( wp_unslash( $_POST['wpa_field_name'] ) ));
			if (isset($_POST['wpa_error_message'])){
				update_option('wpa_error_message',sanitize_text_field( wp_unslash( $_POST['wpa_error_message'] ) ));
			}
			if (isset($_POST['wpa_disable_test_widget'])){
				update_option('wpa_disable_test_widget',sanitize_text_field( wp_unslash( $_POST['wpa_disable_test_widget'] ) ));
			}
			if (isset($_POST['wpa_disable_jquery'])){
				update_option('wpa_disable_jquery', sanitize_text_field( wp_unslash( $_POST['wpa_disable_jquery'] ) ));
			}

			if (isset($_POST['wpa_enable_timer'])){
				update_option('wpa_enable_timer', sanitize_text_field( wp_unslash( $_POST['wpa_enable_timer'] ) ));
			}
			if (isset($_POST['wpa_min_time'])){
				update_option('wpa_min_time', absint($_POST['wpa_min_time']));
			}
			if (isset($_POST['wpa_require_interaction'])){
				update_option('wpa_require_interaction', sanitize_text_field( wp_unslash( $_POST['wpa_require_interaction'] ) ));
			}

			$stop_words_warning = '';
			if (isset($_POST['wpa_stop_words'])){
				$stop_words = sanitize_textarea_field( wp_unslash( $_POST['wpa_stop_words'] ) );
				update_option('wpa_stop_words', $stop_words);
				$invalid = wpa_validate_stop_words($stop_words);
				if (!empty($invalid)){
					$stop_words_warning = ' Warning: '.count($invalid).' invalid regex pattern(s) will be ignored: '.implode(', ', $invalid);
				}
			}

			$GLOBALS['wpa_field_name'] 				= get_option('wpa_field_name');
			$GLOBALS['wpa_error_message'] 			= get_option('wpa_error_message');

			$return['status']   = 'ok';
			$return['body'] 	= 'Settings Saved'.$stop_words_warning;
		}
	} else {
		$return['status']   = 'error';
		$return['body'] 	= 'Sorry, your nonce did not verify. Please try again.';
	}
	return $return;
}

function wpa_save_stats($wp_system, $data){
	$currentStats = json_decode(get_option('wpa_stats'), true) ?? array();
	$timeArray 		= array('today','week','month');	

	if (!array_key_exists($wp_system,$currentStats)){
		$currentStats[$wp_system]['today']['count']  			= 0;
		$currentStats[$wp_system]['week']['count']  			= 0;
		$currentStats[$wp_system]['month']['count']  			= 0;
		$currentStats[$wp_system]['today']['date']  			= gmdate('Ymd');
		$currentStats[$wp_system]['week']['date']  				= gmdate('Ymd');
		$currentStats[$wp_system]['month']['date']  			= gmdate('Ymd');
	}

	foreach ($timeArray as $key => $time) {
		if (wpa_check_date($currentStats['total'][$time]['date'],$time)){
			$currentStats['total'][$time]['count']  			+= 1;			
		} else {
			$currentStats['total'][$time]['count'] 			= 1;				
		}

		if (wpa_check_date($currentStats[$wp_system][$time]['date'],$time)){
			$currentStats[$wp_system][$time]['count']  			+= 1;			
		} else {
			$currentStats[$wp_system][$time]['count'] 			= 1;				
		}

		$currentStats['total'][$time]['date'] 				= gmdate('Ymd');
		$currentStats[$wp_system][$time]['date'] 			= gmdate('Ymd');
	}
	
	$currentStats['total']['all_time'] += 1;
	@$currentStats[$wp_system]['all_time'] += 1;
	update_option('wpa_stats', json_encode($currentStats));
}

function wpa_check_date($timestamp, $comparision){
	switch ($comparision) {
		case 'today':
			if (gmdate('Ymd') == $timestamp){
				return true;
			} else {
				return false;
			}
		break;

		case 'week':
			$firstWeekDay 		= gmdate("Ymd", strtotime('monday this week'));  
			$lastWeekDay 		= gmdate("Ymd", strtotime('sunday this week'));  

			if($timestamp >= $firstWeekDay && $timestamp <= $lastWeekDay) {
				return true;
			} else {
				return false;
			}
		break;

		case 'month':
			if(gmdate('Ym',strtotime($timestamp)) == gmdate('Ym')) {
				return true;
			} else {
				return false;
			}
		break;
	}
}

function wpa_unqiue_field_name(){
	$permitted_chars = 'abcdefghijklmnopqrstuvwxyz';
	return substr(str_shuffle($permitted_chars), 0, 6).wp_rand(1,9999);
}

function wpa_unqiue_field_value(){
	return wp_rand(1111, 999999);
}

function wpa_check_is_spam($form_data){
	if (
			(isset($form_data[$GLOBALS['wpa_field_name']])) &&
			(isset($form_data['alt_s'])) &&
			(empty($form_data['alt_s']))

		){
		// Spam trap passed. Apply the signed timer check (HMAC timestamp).
		if (wpa_check_too_fast($form_data)){
			return true; // TRUE MEANS SPAM (forged/missing token or submitted too fast)
		}
		// Local stop-list: catches manual/human spam that passes the bot checks.
		if (wpa_check_stop_words($form_data)){
			return true; // TRUE MEANS SPAM (matched a blacklisted word/pattern)
		}
		return false; // FALSE MEANS NOT SPAM
	} else {
		return true; // TRUE MEANS SPAM
	}
}

/*
 * HMAC timestamp token (Adaptive timer foundation).
 * Token format: "<unix_timestamp>.<hmac_sha256>" signed with the site auth salt.
 * Nothing is stored server side - the signature alone proves the timestamp is genuine.
 */
function wpa_token_secret(){
	return wp_salt('auth');
}

function wpa_generate_token(){
	$ts  = time();
	$sig = hash_hmac('sha256', (string) $ts, wpa_token_secret());
	return $ts . '.' . $sig;
}

/*
 * Returns elapsed seconds since the token was issued when the signature is valid,
 * or boolean false when the token is missing / malformed / tampered.
 */
function wpa_verify_token($token){
	if (!is_string($token) || strpos($token, '.') === false){
		return false;
	}
	list($ts, $sig) = explode('.', $token, 2);
	if (!ctype_digit($ts)){
		return false;
	}
	$expected = hash_hmac('sha256', $ts, wpa_token_secret());
	if (!hash_equals($expected, $sig)){
		return false;
	}
	return time() - (int) $ts;
}

/*
 * TRUE  = submission should be treated as spam (too fast, or token missing/forged).
 * FALSE = passes the timer check (or the timer is disabled / not applicable).
 */
function wpa_check_too_fast($form_data){
	if (get_option('wpa_enable_timer', 'yes') !== 'yes'){
		return false; // timer disabled
	}

	$min_time = (int) get_option('wpa_min_time', 3);
	if ($min_time <= 0){
		return false; // no minimum configured
	}

	$token   = isset($form_data['alt_t']) ? $form_data['alt_t'] : '';
	$elapsed = wpa_verify_token($token);

	if ($elapsed === false){
		// Spam trap field was present but the signed token is missing or forged.
		return true;
	}

	// Cache safe: only a minimum is enforced (no maximum age), so a frozen
	// timestamp on a fully cached page only grows older and keeps passing.
	if ($elapsed < $min_time){
		return true; // submitted faster than a human realistically could
	}

	return false;
}

/*
 * Local stop-list (no database, stored in the wpa_stop_words option, one entry
 * per line). A line wrapped in regex delimiters (e.g. /viagra/i) is treated as a
 * regular expression; any other line is a case-insensitive substring match.
 * Returns TRUE when submitted content matches a stop word (= spam).
 */
function wpa_check_stop_words($form_data){
	$raw = (string) get_option('wpa_stop_words', '');
	if (trim($raw) === ''){
		return false; // no list configured
	}

	$text = wpa_flatten_form_text($form_data);
	if ($text === ''){
		return false;
	}

	$lines = preg_split('/\r\n|\r|\n/', $raw);
	foreach ($lines as $line){
		$pattern = trim($line);
		if ($pattern === ''){
			continue;
		}
		if (wpa_stopword_matches($pattern, $text)){
			return true;
		}
	}
	return false;
}

/*
 * Flattens submitted values into one searchable string. Password and the plugin's
 * own helper fields are skipped to avoid false positives (e.g. a password that
 * happens to contain a stop word).
 */
function wpa_flatten_form_text($data){
	$skip_keys = array('pwd','pass','password','pass1','pass2','user_pass','alt_s','alt_t', strtolower((string) $GLOBALS['wpa_field_name']));
	$parts = array();
	foreach ((array) $data as $key => $value){
		if (in_array(strtolower((string) $key), $skip_keys, true)){
			continue;
		}
		if (is_array($value)){
			$parts[] = wpa_flatten_form_text($value);
		} elseif (is_string($value) || is_numeric($value)){
			$parts[] = (string) $value;
		}
	}
	return trim(implode(' ', $parts));
}

/*
 * TRUE if $pattern matches $text. A pattern that looks like /regex/flags is run as
 * a regular expression; otherwise it is a case-insensitive substring. Invalid
 * regex patterns are skipped safely so a bad entry never breaks spam checking.
 */
function wpa_stopword_matches($pattern, $text){
	if (strlen($pattern) >= 2 && $pattern[0] === '/' && strrpos($pattern, '/') > 0){
		if (@preg_match($pattern, '') === false){
			return false; // invalid regex - ignore
		}
		return preg_match($pattern, $text) === 1;
	}
	return stripos($text, $pattern) !== false;
}

/*
 * Returns the list of invalid regex patterns in a raw stop-words string.
 * Used to warn the admin on save. Plain (non-regex) lines are always valid.
 */
function wpa_validate_stop_words($raw){
	$invalid = array();
	$lines = preg_split('/\r\n|\r|\n/', (string) $raw);
	foreach ($lines as $line){
		$pattern = trim($line);
		if ($pattern === ''){
			continue;
		}
		if (strlen($pattern) >= 2 && $pattern[0] === '/' && strrpos($pattern, '/') > 0){
			if (@preg_match($pattern, '') === false){
				$invalid[] = $pattern;
			}
		}
	}
	return $invalid;
}

function wpa_field_info(){
	if (current_user_can('activate_plugins') && (get_option('wpa_disable_test_widget') != 'yes')){
    	$wpa_add_test = 'yes';
	} else {
		$wpa_add_test = 'no';
	}

	$return = array(
			'wpa_field_name' 	=> $GLOBALS['wpa_field_name'],
			'wpa_field_value' 	=> wpa_unqiue_field_value(),
			'wpa_add_test'		=> $wpa_add_test,
			'wpa_token'			=> wpa_generate_token(),
			'wpa_require_interaction' => get_option('wpa_require_interaction', 'yes')
	);

	return $return;
}