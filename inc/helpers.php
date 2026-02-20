<?php

if (!defined('ABSPATH')) {
    exit;
}

function get_np_template_part($slug, $name = null, $args = [])
{
    $template = '';

    if ($name) {
        $template_name = "{$slug}-{$name}.php";
    } else {
        $template_name = "{$slug}.php";
    }

    $templatePath = file_exists(NP_THEME_TEMPLATE_PATH . $template_name) ? NP_THEME_TEMPLATE_PATH . $template_name : null;

    if ($templatePath) {
        ob_start();
        include $templatePath;
        $template = ob_get_clean();
        echo $template;
    }
}
function fsac_get_table_data($table_name)
{
    global $wpdb;
    $table = $wpdb->prefix . $table_name;
    $results = $wpdb->get_results("SELECT * FROM $table");
    return $results;
}
function fsac_get_table_data_columns($table_name)
{
    global $wpdb;
    $table = $wpdb->prefix . $table_name;
    $columns = $wpdb->get_col("SHOW COLUMNS FROM $table", 0);
    return $columns;
}


function fsac_ceate_table__rows($table_slug, $data)
{
    global $wpdb;
    $table_name = $wpdb->prefix . $table_slug;
    $user_id = get_current_user_id();
    $reponse_data = [];

    $row_exisits = $wpdb->get_var(
        $wpdb->prepare(
            "SELECT user_id FROM {$table_name} WHERE user_id = %s LIMIT 1",
            $user_id
        )
    );
    if ($row_exisits == 0) {
        $inserted = $wpdb->insert(
            $table_name,
            $data
        );
    }

    if (isset($inserted)) {
        $reponse_data = [
            'message' => 'Benutzer wurde erfolgreich hinterlegt'
        ];
    } else {
        $reponse_data = [
            'message' => 'Benutzer existiert bereits'
        ];
    }
    return $reponse_data;
}
