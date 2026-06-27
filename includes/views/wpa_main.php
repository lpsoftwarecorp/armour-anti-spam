<?php
if ( ! defined( 'ABSPATH' ) ) exit;
if (isset($_POST['submit-wpa-general-settings'])){ // phpcs:ignore WordPress.Security.NonceVerification.Missing -- nonce is verified inside wpa_save_settings() before any option is written
    $saveReturn = wpa_save_settings();
}

if (isset($_GET['tab']) && array_key_exists( sanitize_key( wp_unslash( $_GET['tab'] ) ), $wpa_tabs)){ // phpcs:ignore WordPress.Security.NonceVerification.Recommended -- read-only admin tab navigation; value is whitelisted against $wpa_tabs
  $currentTab = sanitize_key( wp_unslash( $_GET['tab'] ) ); // phpcs:ignore WordPress.Security.NonceVerification.Recommended -- read-only admin tab navigation; value is whitelisted against $wpa_tabs
} else {
  $currentTab = 'settings';
}
?>

<div class="wrap wpa-admin">

    <div class="wpa-header">
        <span class="wpa-header__icon"><span class="dashicons dashicons-shield"></span></span>
        <div>
            <h1 class="wpa-header__title">Armour Anti-Spam</h1>
            <p class="wpa-header__sub">Invisible spam trap protection</p>
        </div>
    </div>

    <?php if (isset($saveReturn)): ?>
        <div class="wpa-notice <?php echo esc_attr($saveReturn['status']); ?>">
            <span class="dashicons dashicons-<?php echo esc_attr( $saveReturn['status'] === 'ok' ? 'yes-alt' : 'warning' ); ?>"></span>
            <span><?php echo esc_html($saveReturn['body']); ?></span>
        </div>
    <?php endif; ?>

    <nav class="wpa-tabs">
        <?php foreach ($wpa_tabs as $tabKey => $tabData) { ?>
            <a href="<?php echo esc_url( admin_url( 'admin.php?page=armour-anti-spam&tab=' . $tabKey ) ); ?>" class="<?php echo $currentTab == $tabKey ? 'is-active' : ''; ?>"><?php echo esc_html( $tabData['name'] ); ?></a>
        <?php } ?>
    </nav>

    <div class="wpa-content">
        <?php include($wpa_tabs[$currentTab]['path']); ?>
    </div>

</div>
