<?php

require '../../bootloader.php';

$nav = nav();

$data = file_to_array(DB_FILE);
$users = $data['users'] ?? [];
$items = $data['items'] ?? [];
$total_price = 0;
$reserved_items = [];

foreach ($users as $user_id => $user) {
    if ($user['email'] === $_SESSION['email']) {
        $buyer = $user;

        if (isset($_POST['product_id'])) {
            foreach ($items as $item_id => $item) {
                if ($item['id'] == $_POST['product_id']) {
                    $data['items'][$item_id]['reserved'] = true;
                    $product = $item;
                    $data['users'][$user_id]['reserved_items'][] = $item;
                }
            }
            $json = array_to_file($data, DB_FILE);
        }

        foreach ($user['reserved_items'] as $item) {
            $reserved_items[] = $item;
            $total_price += $item['price'];
        }
    }
}

if (isset($_POST['checkout_button'])) {
    foreach ($reserved_items as $reserved_item) {
        foreach ($items as $item_id => $item) {
            if ($item['id'] === $reserved_item['id']) {
                unset($data['items'][$item_id]);

                foreach ($users as $user_id => $user) {
                    if ($user['email'] === $_SESSION['email']) {
                        $data['users'][$user_id]['bought_items'] = $data['users'][$user_id]['reserved_items'];
                        $data['users'][$user_id]['reserved_items'] = [];
                    }
                }

            }
        }
    }

    $json = array_to_file($data, DB_FILE);
}


?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forms</title>
    <link rel="stylesheet" href="../media/style.css">
</head>
<body>

<?php require ROOT . '/app/templates/nav.php'; ?>

<main>
    <h2>My order:</h2>
        <?php if ($reserved_items !== []): ?>
    <?php foreach ($reserved_items as $item): ?>
        <section class="invoice item-card">
            <article>
                <h5><?php print $item['title']; ?></h5>
                <h5>Price: <?php print $item['price']; ?></h5>
                <h5>Contacts: <?php print $item['contacts']; ?></h5>
            </article>
            <article>
                <img class="img" src="<?php print $item['link']; ?>">
            </article>
        </section>
    <?php endforeach; ?>
        <?php else: ?>
            <h3>Your cart is empty!</h3>
        <?php endif; ?>
    <section>
        <form method="post" action="my.php">
            <h3>Total price: <?php print $total_price; ?></h3>
            <button type="submit" name="checkout_button" value="checkout">Checkout!</button>
        </form>
    </section>

</main>
</body>
</html>
