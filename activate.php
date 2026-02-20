<?php
defined('ABSPATH') || exit;

global $wpdb;
$table_name = $wpdb->prefix . 'np_premium_user';
require_once ABSPATH . 'wp-admin/includes/upgrade.php';

$exists = $wpdb->get_var(
    $wpdb->prepare(
        "SHOW TABLES LIKE %s",
        $table_name
    )
);

if ($exists === $table_name) {
    error_log("Tabelle existiert bereits");
} else {
    np_create_premuim_user_table($wpdb, $table_name);
    error_log("Tabelle wurde erstellt");
}
