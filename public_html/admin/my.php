<?php

require '../../bootloader.php';

$nav = nav();
$data = file_to_array(DB_FILE);
$items = $data['items'] ?? [];
$users = $data['users'] ?? [];
$h1 = 'My accessories!';


foreach ($users as $user) {
    if ($user['email'] === $_SESSION['email']) {
        $h2 = 'I am selling ' . $user['items'] . ' accessories!';
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
<body>
<main>
    <section>
        <h1><?php print $h1; ?></h1>
        <?php if (isset($h2)): ?>
            <h2><?php print $h2; ?></h2>
        <?php endif; ?>
        <div class="items-portfolio">
            <?php foreach ($items as $item): ?>
                <?php if ($item['email'] === $_SESSION['email']): ?>
                    <div class="item-card">
                        <h2><?php print $item['title']; ?></h2>
                        <img class="item-img" src="<?php print $item['link']; ?>">
                        <p><?php print $item['price']; ?> Eur.</p>
                        <p><?php print $item['contacts']; ?></p>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </section>
    <section>
        <h1>Items bought:</h1>
        <?php foreach ($users as $user): ?>
            <?php if ($user['email'] === $_SESSION['email'] && isset($user['bought_items'])): ?>
                <?php foreach ($user['bought_items'] as $item): ?>
                    <div class="item-card">
                        <h2><?php print $item['title']; ?></h2>
                        <img class="item-img" src="<?php print $item['link']; ?>">
                        <p><?php print $item['price']; ?> Eur.</p>
                        <p><?php print $item['contacts']; ?></p>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        <?php endforeach; ?>
    </section>

</main>
</body>
</html>