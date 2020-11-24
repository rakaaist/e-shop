<?php

/**
 * Generates a string of attributes
 *
 * @param array $attr
 * @return string
 */
function html_attr(array $attr)
{
    $attribute_string = '';

    foreach ($attr as $attribute => $value) {
        $attribute_string .= "$attribute=\"$value\" ";
    }
    return $attribute_string;
}

/**
 * Iš duoto duomenų masyvo sukuria atributus
 * deklaruojantį tekstą skirtą HTML input elementui.
 *
 * Sumuojami atributai yra name, type, value ir visi likę
 * atributai iš $field['extra']['attr'] masyvo.
 *
 * @param string $field_name HTML input'o pavadinimas.
 * @param array $field masyvas HTML input atributų.
 * @return string input elemento atributai.
 */
function input_attr(string $field_name, array $field): string
{
    $attributes = [
            'name' => $field_name,
            'type' => $field['type'],
            'value' => $field['value'] ?? ''
        ] + ($field['extra']['attr'] ?? []);

    return html_attr($attributes);
}

/**
 * Iš duoto duomenų masyvo sukuria atributus
 * deklaruojantį tekstą HTML button elementui.
 *
 * name atributas visad turi likti 'action'.
 *
 * @param string $button_id HTML button'o value atributas.
 * @param array $button masyvas HTML button atributų.
 * @return string input elemento atributai.
 */
function button_attr(string $button_id, array $button): string
{
    $attributes = [
            'name' => 'action',
            'type' => $button['type'] ?? 'submit',
            'value' => $button_id,
        ] + ($button['extra']['attr'] ?? []);

    return html_attr($attributes);
}

/**
 * Is duoto duomenų masyvo sugeneruoja form atributus
 *
 * @param array $form
 * @return string
 */
function form(array $form): string {

    return html_attr(($form['attr'] ?? []) + ['method' => 'POST']);

    //    $defaults = [
//        'method' => 'POST'
//    ];
//
//    if (isset($form['attr'])) {
//        return $form['attr'] + $defaults;
//    } else {
//        return $defaults;
//    }
};

/**
 * Sugeneruojami select atributai
 *
 * @param string $field_name
 * @param array $field
 * @return string
 */
function select_attr(string $field_name, array $field): string
{
    $attributes = [
            'name' => $field_name,
            'type' => $field['type'],
            'value' => $field['value'] ?? ''
        ] + ($field['extra']['attr'] ?? []);

    return html_attr($attributes);
}

/**
 * Sugeneruojami option atributai
 *
 * @param string $option_id
 * @param array $field
 * @return string
 */
function option_attr(string $option_id, array $field): string
{
    $attributes = [
            'value' => $option_id
        ];

    if ($field['value'] == $option_id) {
        $attributes['selected'] = 'selected';
    }

    return html_attr($attributes);
}

/**
 * Sugeneruojami textarea atributai
 *
 * @param string $field_name
 * @param array $field
 * @return string
 */
function textarea_attr(string $field_name, array $field): string
{
    $attributes = [
            'name' => $field_name
        ] + ($field['extra']['attr'] ?? []);

    return html_attr($attributes);
}