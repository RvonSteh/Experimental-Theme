<?php
defined('ABSPATH') || exit;

function np_create_credits_table()
{
    global $wpdb;
    require_once ABSPATH . 'wp-admin/includes/upgrade.php';

    $charset_collate = $wpdb->get_charset_collate();

    $tables = [
        'fsac_credit_accounts' => "CREATE TABLE %s (
            id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
            user_id BIGINT(20) UNSIGNED NOT NULL,
            therapist VARCHAR(100) NOT NULL DEFAULT 'perzl',
            credit_type ENUM('default', 'pet', 'family') NOT NULL,
            balance VARCHAR(100) NOT NULL,
            has_abo TINYINT(1) NOT NULL DEFAULT 1,
            created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY  (id)
        ) $charset_collate;",

        'fsac_credit_grants' => "CREATE TABLE %s (
            id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
            user_id BIGINT(20) UNSIGNED NOT NULL,
            credit_type ENUM('default', 'pet', 'family') NOT NULL,
            credit_source ENUM('abo', 'single') NOT NULL,
            total_credits INT DEFAULT 0,
            expires_at DATE NOT NULL,
            created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY  (id)
        ) $charset_collate;",

        'fsac_credit_unlocks' => "CREATE TABLE %s (
            id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
            user_id BIGINT(20) UNSIGNED NOT NULL,
            grant_id INT NOT NULL,
            unlock_at DATE,
            credits INT DEFAULT 0,
            unlocked_at DATE,
            created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY  (id)
        ) $charset_collate;",

        'fsac_credit_transactions' => "CREATE TABLE %s (
            id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
            user_id BIGINT(20) UNSIGNED NOT NULL,
            credit_type ENUM('default', 'pet', 'family'),
            grant_id INT NOT NULL,
            action VARCHAR(100),
            amount VARCHAR(100),
            created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY  (id)
        ) $charset_collate;",
    ];

    foreach ($tables as $suffix => $createSqlTemplate) {
        $table_name = $wpdb->prefix . $suffix;

        $sql = sprintf($createSqlTemplate, $table_name);

        dbDelta($sql);

        $exists = $wpdb->get_var($wpdb->prepare("SHOW TABLES LIKE %s", $table_name));
        if ($exists === $table_name) {
            error_log("Tabelle geprüft/aktualisiert: $table_name");
        } else {
            error_log("Tabelle konnte nicht angelegt werden: $table_name");
        }
    }
}
