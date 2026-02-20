<?php
defined('ABSPATH') || exit;


function create_db_user_data()
{

    $user_id = get_current_user_id();
    $therapist = $_POST['user_data']['therapist'];
    $credit_type = $_POST['user_data']['credit_type'];
    $balance = $_POST['user_data']['balance'];
    $has_abo = $_POST['user_data']['balance'];
    $table_slug = 'fsac_credit_accounts';

    $create_row_data = [
        'user_id'   => $user_id,
        'therapist'   => $therapist,
        'credit_type' => $credit_type,
        'has_abo'     => $has_abo,
        'balance'     => $balance
    ];
    $reponse_created_row = fsac_ceate_table__rows($table_slug,  $create_row_data);

    wp_send_json_success([
        'message' => $reponse_created_row['message']
    ]);
}


add_action('wp_ajax_create_db_user_data', 'create_db_user_data');
add_action('wp_ajax_nopriv_create_db_user_data', 'create_db_user_data');
