<?php

require '../bootloader.php';

if (is_logged_in()) {
    $h1 = "Welcome {$_SESSION['email']} to Accessories Shop!";
} else {
    $h1 = 'Welcome to Accessories Shop!';
}

$nav = nav();
$items = file_to_array(ITEM_FILE);

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
    <section class="items-portfolio">
        <?php foreach ($items as $item): ?>
            <div class="item-card">
                <h2><?php print $item['title']; ?></h2>
                <div>
                    <img class="item-img" src="<?php print $item['link']; ?>">
                </div>
                <p><?php print $item['description']; ?></p>
                <p><?php print $item['price']; ?> Eur.</p>
            </div>
        <?php endforeach; ?>
    </section>
</main>
</body>
</html>