<?php

require '../bootloader.php';

$table = [
    'headers' => [
        'Username',
        'Password'
    ],
    'rows' => file_to_array(DB_FILE)
];

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forms</title>
    <link rel="stylesheet" href="media/style.css">
</head>
<body>
<?php require ROOT . '/core/templates/table.tpl.php'; ?>
</body>
</html>