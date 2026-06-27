<?php if ( ! defined( 'ABSPATH' ) ) exit;
$wpa_stats = json_decode( get_option('wpa_stats'), true );
$wpa_all_time = ( !empty($wpa_stats) && isset($wpa_stats['total']['all_time']) ) ? intval($wpa_stats['total']['all_time']) : 0;
?>
<style type="text/css">
    .wpa_stat_box{ text-align:center; padding:10px; }
    .wpa_stat_box .wpa_stat_number{ font-size:32px; font-weight:600; line-height:1.2; }
    .wpa_stat_box .wpa_stat_label{ color:#555; margin-bottom:12px; }
</style>

<div class="wpa_stat_box">
    <div class="wpa_stat_number"><?php echo esc_html( number_format_i18n( $wpa_all_time ) ); ?></div>
    <div class="wpa_stat_label">spam submissions blocked all-time</div>
    <a href="<?php echo esc_url( admin_url( 'admin.php?page=armour-anti-spam&tab=stats' ) ); ?>" class="button button-primary">View Statistics</a>
</div>
