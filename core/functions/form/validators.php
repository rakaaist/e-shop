<?php

/**
 * Funkcija patikrina ar input'o laukelis nebuvo paliktas tuščias.
 *
 * Jeigu rasta tuščia vertė - input'o duomenų masyve 'error' indeksu įrašoma
 * kilusi klaida.
 * Funkcija klaidos atveju grąžina false, kitu - true.
 *
 * @param string $field_value išvalyto input'o vertė.
 * @param array $field vieno input'o duomenų masyvas.
 * @return bool
 */
function validate_field_not_empty(string $field_value, array &$field): bool{
    if ($field_value === '') {
        $field['error'] = 'Required field!';
        return false;
    }

    return true;
}

/**
 * Function checks age - between 18 and 100
 *
 * @param int $field_value
 * @param array $field
 * @return bool
 */
function validate_age(int $field_value, array &$field): bool {
    if ($field_value < 18 || $field_value > 100) {
        $field['error'] = 'age has to be between 18 and 100';
        return false;
    }

    return true;
}

/**
 * Function checks whether there are 2 words provided
 *
 * @param string $field_value - input value
 * @param array $field - input array
 * @return bool
 */
function validate_full_name(string $field_value, array &$field): bool {
    if (str_word_count($field_value) < 2) {
        $field['error'] = 'name and surname have to be separate words';
        return false;
    }

    return true;
}

/**
 * Function checks number iput according to min and max parameters from the array
 *
 * @param int $field_value - input value
 * @param array $field - input array
 * @param array $params
 * @return bool
 */
function validate_field_range (int $field_value, array &$field, array $params): bool {
    if ($field_value < $params['min'] || $field_value > $params['max']) {
        $field['error'] = 'Number is not in range';
        return false;
    }

    return true;
}

///**
// * Function checks number to be between 50 and 100
// *
// * @param int $field_value - input value
// * @param array $field - input array
// * @return bool
// */
//function validate_field_num_50_100 (int $field_value, array &$field): bool {
//    if ($field_value < 50 || $field_value > 100) {
//        $field['error'] = 'Number has to be between 100 and 200';
//        return false;
//    }
//
//    return true;
//}


//function validate_fields_match($form_values, array &$form, $params) {
//    var_dump($form_values);
//    if ($form_values[$params[0]] !== $form_values[$params[1]]) {
//        $form['fields'][$params[1]]['error'] = 'Doesnt match';
//        return false;
//    }
//    var_dump('true');
//    return true;
//}

/**
 * Function checks whether both passwords typed are the same
 *
 * @param array $form_values
 * @param array $form
 * @param $params
 * @return bool
 */
function validate_fields_match(array $form_values, array &$form, $params) {

    foreach ($params as $field_index){
            if ($form_values[$params[0]] !== $form_values[$field_index]) {
                $form['fields'][$field_index]['error'] = strtr('Input doesnt match with @field', [
                    '@field' => $form['fields'][$params[0]]['label']
                ]);
                return false;
            }
    }

    return true;
}

/**
 * Function checks whether the option name wasn't changed in console;
 * only values provided in the array can be selected
 *
 * @param $field_input
 * @param $field
 * @return bool
 */
function validate_select($field_input, &$field){

        if (!isset($field['options'][$field_input])) {
            $field['error'] = 'not an option';

            return false;
        }

    return true;
}

/**
 * Function checks whether the email is the correct style
 *
 * @param $field_input
 * @param $field
 * @return bool
 */
function validate_email($field_input, &$field){
    if (!preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/', $field_input)) {
        $field['error'] = 'Invalid email format';
        return false;
    }

    return true;
}


