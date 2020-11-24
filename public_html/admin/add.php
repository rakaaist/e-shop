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
            'label' => 'Type of accessory',
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
            'label' => 'URL',
            'type' => 'text',
            'validators' => [
                'validate_field_not_empty'
            ],
            'extra' => [
                'attr' => [
                    'placeholder' => 'Type image url...'
                ]
            ]
        ],
        'description' => [
            'type' => 'textarea',
            'label' => 'Description',
            'validators' => [
                'validate_field_not_empty'
            ],
            'extra' => [
                'attr' => [
                    'placeholder' => 'Type something'
                ]
            ]
        ],
        'price' => [
            'type' => 'number',
            'label' => 'Price',
            'validators' => [
                'validate_field_not_empty'
            ],
            'extra' => [
                'attr' => [
                    'placeholder' => 'Price'
                ]
            ]
        ]
    ],
    'buttons' => [
        'submit' => [
            'title' => 'Upload',
            'type' => 'submit',
        ]
    ]
];

$clean_inputs = get_clean_input($form);

if ($clean_inputs) {

    if (validate_form($form, $clean_inputs)) {

        $message = 'Successful upload!';
        $data = file_to_array(ITEM_FILE);
        $data[] = $clean_inputs;
        $json = array_to_file($data, ITEM_FILE);
        header("location: /index.php");
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
<?php require ROOT . '/app/templates/nav.php'; ?>
<body class="add-background">
<main>
    <?php require ROOT . '/core/templates/form.tpl.php'; ?>
    <?php if (isset($message)): ?>
        <p><?php print $message; ?></p>
    <?php endif; ?>
</main>
</body>
</html>
