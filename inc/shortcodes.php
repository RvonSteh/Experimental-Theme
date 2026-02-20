<?php

if (!defined('ABSPATH')) {
    exit;
}


function np_form_data_shortcode()
{
    $create_account_data_column = fsac_get_table_data_columns('fsac_credit_accounts');
    $create_account_data = fsac_get_table_data('fsac_credit_accounts');
?>
    <form class="create-data-form">

        <div class="form-field">
            <label for="therapist">Therapeut</label>
            <input id="therapist" type="text">
        </div>
        <div class="form-field">
            <label for="credit_type">Creadit Type</label>
            <select name="" id="credit_type">
                <option value="default">Standard</option>
                <option value="pet">Haustier</option>
                <option value="family">Familie</option>
            </select>
        </div>
        <div class="form-field">
            <label for="balance">Balance</label>
            <input id="balance" type="text">
        </div>
        <div class="form-field">
            <label for="has_abo">Habe ein Abo</label>
            <input id="has_abo" type="checkbox">
        </div>
        <button type="submit">Daten speichern</button>
    </form>
<?php
}

add_shortcode('np_form_data', 'np_form_data_shortcode');
