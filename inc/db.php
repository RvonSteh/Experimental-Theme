<?php
defined('ABSPATH') || exit;


add_action('after_switch_theme', 'mychild_create_test_table');

function mychild_create_test_table()
{
    $ver = get_option('mychild_my_table_ver');
    $target = '1.0';

    if ($ver === $target) return;

    global $wpdb;
    $table_name = $wpdb->prefix . 'my_table';

    require_once ABSPATH . 'wp-admin/includes/upgrade.php';

    $sql = "CREATE TABLE $table_name (
    id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    PRIMARY KEY  (id)
  ) " . $wpdb->get_charset_collate() . ";";

    dbDelta($sql);

    update_option('mychild_my_table_ver', $target);
}
