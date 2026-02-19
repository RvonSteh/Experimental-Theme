<?php
defined('ABSPATH') || exit;

function np_create_premuim_user_table($wpdb, $table_name)
{

    $sql = "CREATE TABLE {$table_name} (
    id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL,
    phone VARCHAR(50) DEFAULT NULL,
    username VARCHAR(100) NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY  (id)
) {$wpdb->get_charset_collate()};";


    dbDelta($sql);
}
