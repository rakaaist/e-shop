<?php

require '../bootloader.php';

if (is_logged_in()) {
    $h1 = "Welcome {$_SESSION['email']} to Accessories Shop!";
} else {
    $h1 = 'Welcome to Accessories Shop!';
}

$nav = nav();
$data = file_to_array(DB_FILE);

if (isset($data['items'])) {
    $items_count = count($data['items']);
} else {
    $items_count = 0;
}

if ($items_count) {
    $h2 = "$items_count accessories are on sale!";
} else {
    $h2 = "No accessories are available at the moment";
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
<body>
<main>
    <h1><?php print $h1; ?></h1>
    <h2><?php print $h2; ?></h2>
    <section class="items-portfolio">
        <?php if (isset($data['items'])): ?>
            <?php foreach ($data['items'] as $item): ?>
                <div class="item-card">
                    <h2><?php print $item['title']; ?></h2>
                    <img class="item-img" src="<?php print $item['link']; ?>">
                    <p><?php print $item['price']; ?> Eur.</p>
                    <p><?php print $item['contacts']; ?></p>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </section>
</main>
</body>
</html>