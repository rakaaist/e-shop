<?php

require '../bootloader.php';

$nav = nav();

$data = file_to_array(DB_FILE);
$items = $data['items'] ?? [];
$items_on_sale = [];

if (is_logged_in()) {
    $h1 = "Welcome {$_SESSION['email']} to Accessories Shop!";

    foreach ($items as $item) {
        if ($item['email'] !== $_SESSION['email']) {
            $items_on_sale[] = $item;
        }
    }
} else {
    $h1 = 'Welcome to Accessories Shop!';
    $items_on_sale = $items;
}

$items_count = count($items_on_sale);

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
<body>

<?php require ROOT . '/app/templates/nav.php'; ?>

<main>
    <h1><?php print $h1; ?></h1>
    <h2><?php print $h2; ?></h2>
    <section class="items-portfolio">
        <?php foreach ($items_on_sale as $item): ?>
            <div class="item-card">
                <h2><?php print $item['title']; ?></h2>
                <img class="item-img" src="<?php print $item['link']; ?>">
                <p><?php print $item['price']; ?> Eur.</p>
                <?php if (!$item['reserved']): ?>
                    <?php if (is_logged_in()): ?>
                        <form method="post" action="admin/cart.php">
                            <input type="hidden" value="<?php print $item['id'] ?>" name="product_id">
                            <button type="submit">Buy this!</button>
                        </form>
                    <?php else: ?>
                        <button><a href="login.php">Buy this!</a></button>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </section>
</main>
</body>
</html>