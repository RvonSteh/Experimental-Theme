<?php

if (!defined('ABSPATH')) {
    exit;
}


function np_form_data_shortcode()
{

?>
    <form class="create-data-form">
        <div class="form-field">
            <label for="name">Name</label>
            <input id="name" type="text">
        </div>
        <div class="form-field">
            <label for="email">E-Mail</label>
            <input id="email" type="text">
        </div>
        <div class="form-field">
            <label for="phone">Telefon</label>
            <input id="phone" type="text">
        </div>
        <div class="form-field">
            <label for="username">Benutzername</label>
            <input id="username" type="text">
        </div>
        <button type="submit">Daten speichern</button>
    </form>
<?php
}

add_shortcode('np_form_data', 'np_form_data_shortcode');
