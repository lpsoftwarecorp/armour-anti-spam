<?php
if ( ! defined( 'ABSPATH' ) ) exit;

$currentStats = json_decode(get_option('wpa_stats'), true);
?>

<div class="wpa-card">

    <div class="wpa-card__head">
        <span class="dashicons dashicons-chart-bar"></span>
        <h2 class="wpa-card__title">Spam Blocked</h2>
    </div>

    <div class="wpa-card__body">
        <table class="wpa-stats">
            <thead>
                <tr>
                    <th>Source</th>
                    <th>Today</th>
                    <th>This Week</th>
                    <th>This Month</th>
                    <th>All Time</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($currentStats)){
                    foreach ($currentStats as $source=>$statData): ?>
                        <tr>
                            <td class="wpa-source"><?php echo esc_html( ucfirst($source) ); ?></td>
                            <td class="wpa-stat-num"><?php echo esc_html( @wpa_check_date($statData['today']['date'],'today') ? $statData['today']['count'] : '0' ); ?></td>
                            <td class="wpa-stat-num"><?php echo esc_html( @wpa_check_date($statData['week']['date'],'week') ? $statData['week']['count'] : '0' ); ?></td>
                            <td class="wpa-stat-num"><?php echo esc_html( @wpa_check_date($statData['month']['date'],'month') ? $statData['month']['count'] : '0' ); ?></td>
                            <td class="wpa-stat-num"><?php echo esc_html( $statData['all_time'] ); ?></td>
                        </tr>
                    <?php endforeach;
                } else { ?>
                    <tr><td colspan="5" class="wpa-empty">No records found yet.</td></tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

</div>
