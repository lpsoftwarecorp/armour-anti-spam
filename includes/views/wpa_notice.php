<?php
if ( ! defined( 'ABSPATH' ) ) exit;
add_action('admin_notices', 'wpa_admin_notices');

if (isset($_GET['wpa_reviews_notice_hide']) == 1){ // phpcs:ignore WordPress.Security.NonceVerification.Recommended -- toggles a cosmetic notice-dismissal flag only; no sensitive action
    update_option('wpa_reviews_notice_hide','yes');
}

function wpa_admin_notices(){
    // Promotional notices removed during LP Software rebrand.
    // TODO (LP Software): add own review / support notices here when available.
}
