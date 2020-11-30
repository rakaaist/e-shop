<?php

require '../bootloader.php';
$nav = nav();

if (is_logged_in()) {
    header("location: /index.php");
    exit();
}

$form = [
    'attr' => [
        'method' => 'POST'
    ],
    'fields' => [
        'name' => [
            'label' => 'Name',
            'type' => 'text',
            'validators' => [
                'validate_field_not_empty',
                'validate_letters_only'
            ]
        ],
        'surname' => [
            'label' => 'Surname',
            'type' => 'text',
            'validators' => [
                'validate_field_not_empty',
                'validate_letters_only'
            ]
        ],
        'email' => [
            'label' => 'Email',
            'type' => 'email',
            'validators' => [
                'validate_field_not_empty',
                'validate_email'
            ]
        ],
        'address' => [
            'label' => 'Address',
            'type' => 'text',
            'validators' => [
                'validate_field_not_empty'
            ]
        ],
        'phone' => [
            'label' => 'Phone number',
            'type' => 'text',
            'validators' => [
                'validate_field_not_empty',
                'validate_numeric_value'
            ]
        ],
        'password' => [
            'label' => 'Password',
            'type' => 'password',
            'validators' => [
                'validate_field_not_empty',
                'validate_password_length',
                'validate_password_format'
            ]
        ],
        'password_repeat' => [
            'label' => 'Repeat password',
            'type' => 'password',
            'validators' => [
                'validate_field_not_empty',
            ]
        ],
    ],
    'buttons' => [
        'submit' => [
            'title' => 'Register',
            'type' => 'submit',
        ]
    ],
    'validators' => [
        'validate_fields_match' => [
            'password',
            'password_repeat'
        ]
    ]
];

$clean_inputs = get_clean_input($form);
$message = '';

if ($clean_inputs) {

    if (validate_form($form, $clean_inputs)) {

        $validate_user = validate_user_unique($clean_inputs['email'], $form['fields']['email']);

        if ($validate_user) {

            $message = 'Successful registration!';
            unset($clean_inputs['password_repeat']);
            $clean_inputs['items'] = 0;
            $clean_inputs['reserved_items'] = [];
            $data = file_to_array(ROOT . '/app/data/db.json');
            $data['users'][] = $clean_inputs;
            $json = array_to_file($data, ROOT . '/app/data/db.json');
            header("location: /login.php");
        }
    } else {
        $message = 'Something went wrong!';
    }
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forms</title>
    <link rel="stylesheet" href="media/style.css">
</head>
<?php require ROOT . '/app/templates/nav.php'; ?>
<body class="register-background">
<main>
    <?php require ROOT . '/core/templates/form.tpl.php'; ?>
    <?php if (isset($message)): ?>
        <p><?php print $message; ?></p>
    <?php endif; ?>
</main>
</body>
</html>