<?php

/**
 * Function checks whether the user already exists
 *
 * @param $email
 * @param $file_name
 * @return bool
 */
function validate_user_unique($email, &$field)
{
    $db_data = file_to_array(DB_FILE);

    if (isset($db_data['users'])) {
        foreach ($db_data['users'] as $user) {
            if ($user['email'] === $email) {
                $field['error'] = 'This user already exists';

                return false;
            }
        }
    }

    return true;
}


/**
 * Function checks whether the user has already registered;
 *
 * @param $filtered_input
 * @param $form
 * @return bool
 */
function validate_login($filtered_input, &$form)
{

    $db_data = file_to_array(DB_FILE);

    foreach ($db_data['users'] as $user) {
        if (($user['email'] === $filtered_input['email'])
            && ($user['password'] === $filtered_input['password'])) {
            return true;
        }
    }

    $form['error'] = 'no user';
    return false;
}

/**
 * Function validates password min symbols
 *
 * @param $field_value
 * @param $field
 * @return bool
 */
function validate_password_min_length($field_value, &$field)
{
    if (strlen($field_value) >= 6) {
        return true;
    } else {
        $field['error'] = 'Password is too short!';
        return false;
    }
}

/**
 * Function validates the username to include at least one letter and one number
 *
 * @param $field_value
 * @param $field
 * @return bool
 */
function validate_username_letter_number($field_value, &$field)
{
    if (preg_match('/[A-Za-z]/', $field_value) && preg_match('/[0-9]/', $field_value)) {
        return true;
    } else {
        $field['error'] = 'Username must include at least one letter and one number!';
        return false;
    }
}

function validate_numeric_value($field_value, &$field)
{
    if (!is_numeric($field_value)) {
        $field['error'] = 'Numeric value only!';

        return false;
    }

    return true;
}


