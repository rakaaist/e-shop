<?php

require '../../bootloader.php';

$nav = nav();
$data = file_to_array(DB_FILE);
$items = $data['items'] ?? [];
$h1 = 'My accessories!';

foreach ($data['users'] as $user) {
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
    <h1><?php print $h1; ?></h1>
    <h2><?php print $h2; ?></h2>
    <section class="items-portfolio">
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
    </section>
</main>
</body>
</html>