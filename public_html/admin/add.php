<?php

require '../../bootloader.php';
$nav = nav();

if (!is_logged_in()) {
    header("location: /login.php");
    exit();
}

$form = [
    'attr' => [
        'method' => 'POST'
    ],
    'fields' => [
        'title' => [
            'label' => '',
            'type' => 'text',
            'validators' => [
                'validate_field_not_empty'
            ],
            'extra' => [
                'attr' => [
                    'placeholder' => 'What accessory is that?'
                ]
            ]
        ],
        'link' => [
            'label' => '',
            'type' => 'text',
            'validators' => [
                'validate_field_not_empty'
            ],
            'extra' => [
                'attr' => [
                    'placeholder' => 'Image link'
                ]
            ]
        ],
        'price' => [
            'type' => 'text',
            'label' => '',
            'validators' => [
                'validate_field_not_empty',
                'validate_numeric_value'
            ],
            'extra' => [
                'attr' => [
                    'placeholder' => 'Price'
                ]
            ]
        ],
        'contacts' => [
            'type' => 'text',
            'label' => '',
            'validators' => [
                'validate_field_not_empty'
            ],
            'extra' => [
                'attr' => [
                    'placeholder' => 'Contacts (phone/ email/ skype)'
                ]
            ]
        ],
    ],
    'buttons' => [
        'submit' => [
            'title' => 'Sell my accessories!',
            'type' => 'submit',
        ]
    ]
];

$clean_inputs = get_clean_input($form);

if ($clean_inputs) {

    if (validate_form($form, $clean_inputs)) {
        $data = file_to_array(DB_FILE);

        foreach ($data['users'] as &$user) {
            if ($user['email'] === $_SESSION['email']) {
                $user['items']++;
                $clean_inputs['email'] = $user['email'];
                $clean_inputs['id'] = uniqid();
                $clean_inputs['reserved'] = false;
                $data['items'][] = $clean_inputs;
            }
        }

        $json = array_to_file($data, DB_FILE);

        header("location: /admin/my.php");
    } else {
        $message = 'Something went wrong';
    }
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forms</title>
    <link rel="stylesheet" href="../media/style.css">
</head>
<body class="add-background">
<?php require ROOT . '/app/templates/nav.php'; ?>
<main>
    <?php require ROOT . '/core/templates/form.tpl.php'; ?>
    <?php if (isset($message)): ?>
        <p><?php print $message; ?></p>
    <?php endif; ?>
</main>
</body>
</html>
