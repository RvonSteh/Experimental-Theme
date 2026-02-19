<?php
defined('ABSPATH') || exit;


function create_db_user_data()
{

    $name = $_POST['user_data']['name'];
    $email = $_POST['user_data']['email'];
    $phone = $_POST['user_data']['phone'];
    $username = $_POST['user_data']['username'];

    wp_send_json_success([
        'message' => 'Etwas ist angekommen',
        'name' => $name,
        'email' => $email,
        'phone' => $phone,
        'username' => $username
    ]);
}


add_action('wp_ajax_create_db_user_data', 'create_db_user_data');
add_action('wp_ajax_nopriv_create_db_user_data', 'create_db_user_data');
