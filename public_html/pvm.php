<?php

require '../bootloader.php';

$nav = nav();

$data = file_to_array(DB_FILE);
$users = $data['users'] ?? [];
$items = $data['items'] ?? [];

foreach ($users as $user) {
    if ($user['email'] === $_SESSION['email']) {
        $buyer = $user;
    }
}

if (isset($_POST['product_id'])) {
    foreach ($items as $item_id => $item) {
        if ($item['id'] == $_POST['product_id']) {
            $product_id = $item_id;
            $product = $item;

            foreach ($users as $user) {
                if ($user['email'] === $item['email'])
                    $seller = $user;
            }
        }
    }
}

if (isset($product_id)) {
    unset($data['items'][$product_id]);
    $json = array_to_file($data, DB_FILE);
}

$unique_no = uniqid();
$invoice_number = "No. PG-$unique_no";
$date = date('Y-m-d');

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
    <h1>VAT Invoice</h1>
    <h2><?php print $invoice_number; ?></h2>
    <h3><?php print $date; ?></h3>
    <section class="invoice">
        <article class="item-card">
            <h4>Buyer:</h4>
            <div>
                <h5><?php print $buyer['name'] . ' ' . $buyer['surname']; ?></h5>
                <h5><?php print $buyer['email']; ?></h5>
                <h5><?php print $buyer['address']; ?></h5>
                <h5><?php print $buyer['phone']; ?></h5>
            </div>
        </article>
        <article class="item-card">
            <h4>Seller</h4>
            <?php if (isset($seller)): ?>
                <div>
                    <h5><?php print $seller['name'] . ' ' . $seller['surname']; ?></h5>
                    <h5><?php print $seller['email']; ?></h5>
                    <h5><?php print $seller['address']; ?></h5>
                    <h5><?php print $seller['phone']; ?></h5>
                </div>
            <?php endif; ?>
        </article>
    </section>
    <?php if (isset($product)): ?>
        <section class="invoice item-card">
            <article>
                <h5><?php print $product['title']; ?></h5>
                <h5>Price: <?php print $product['price']; ?></h5>
                <h5>Contacts: <?php print $product['contacts']; ?></h5>
            </article>
            <article>
                <img class="img" src="<?php print $product['link']; ?>">
            </article>
        </section>
    <?php endif; ?>
</main>
</body>
</html>