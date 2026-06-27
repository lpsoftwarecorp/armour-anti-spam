<?php
if ( ! defined( 'ABSPATH' ) ) exit; 
add_action("wp_dashboard_setup", "wpa_dashboard_widget");
function wpa_dashboard_widget()
{
    //add_meta_box( 'wpa_dashboard_widget', 'Armour Anti-Spam Statistics', 'wpa_dashboard_widget_function', 'dashboard', 'side', 'high');
    if ( current_user_can('administrator') ) {
        add_meta_box(
            'wpa_dashboard_widget',
            'Armour Anti-Spam Statistics',
            'wpa_dashboard_widget_function',
            'dashboard',
            'side',
            'high'
        );
    }
}
 
function wpa_dashboard_widget_function(){
    ob_start();
	include('views/wpa_stats_widget.php');
	$widget_content = ob_get_contents();
	ob_end_clean ();
	$widget_content 			= apply_filters( 'wpa_widget_content', $widget_content);
	// Content is assembled from an internal template (views/wpa_stats_widget.php) whose
	// dynamic values are already escaped; it also contains a <style> block that wp_kses_post would strip.
	echo $widget_content; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}