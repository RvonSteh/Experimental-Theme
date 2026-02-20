<?php
defined('ABSPATH') || exit;


function create_db_user_data()
{

    $name = $_POST['user_data']['name'];
    $email = $_POST['user_data']['email'];
    $phone = $_POST['user_data']['phone'];
    $username = $_POST['user_data']['username'];


    global $wpdb;
    $table_name = $wpdb->prefix . 'np_premium_user';

    $user_exists = $wpdb->get_var(
        $wpdb->prepare(
            "SELECT username FROM {$table_name} WHERE username = %s LIMIT 1",
            $username
        )
    );

    if ($user_exists > 0) {
        wp_send_json_success([
            'message' => 'Benutzer exisiert bereits, bitte neuen Benutzernamen wählen',
            'user_exists' => true
        ]);
    } else {
        $inserted = $wpdb->insert(
            $table_name,
            [
                'name'       => $name,
                'email'      => $email,
                'phone'      => $phone,
                'username'   => $username,
                'created_at' => current_time('mysql')
            ],
            [
                '%s',
                '%s',
                '%d',
                '%s',
                '%s'
            ]
        );
    }

    if ($inserted === false) {
        wp_send_json_error(['message' => 'DB Fehler']);
    } else {
        wp_send_json_success([
            'message' => 'Etwas ist angekommen',
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'username' => $username
        ]);
    }
}


add_action('wp_ajax_create_db_user_data', 'create_db_user_data');
add_action('wp_ajax_nopriv_create_db_user_data', 'create_db_user_data');
