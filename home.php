<?php
// Get the 4 most recently added products
$stmt = $pdo->prepare('SELECT * FROM products ORDER BY date_created DESC LIMIT 4');
$stmt->execute();
$recently_added_products = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt2 = $pdo->prepare('SELECT * FROM products ORDER BY RAND() LIMIT 4');
$stmt2->execute();
$featured_products = $stmt2->fetchAll(PDO::FETCH_ASSOC);
?>

<?=template_header('Home')?>

<div class="store-header-wrapper">
    <img src="Images/Store.png">
</div>

<div class="featured content-wrapper">
    <h2>Featured Products</h2>
    <div class="products">
        <?php foreach ($featured_products as $product): ?>
        <a href="index.php?page=product&id=<?=$product['product_id']?>" class="product">
            <img src="<?=$product['img']?>" width="200" height="200" alt="<?=$product['title']?>">
            <span class="name"><?=$product['title']?></span>
            <span class="price">
                &dollar;<?=$product['price']?>
            </span>
        </a>
        <?php endforeach; ?>
    </div>
</div>
<div class="recentlyadded content-wrapper">
    <h2>Recently Added Products</h2>
    <div class="products">
        <?php foreach ($recently_added_products as $product): ?>
        <a href="index.php?page=product&id=<?=$product['product_id']?>" class="product">
            <img src="<?=$product['img']?>" width="200" height="200" alt="<?=$product['title']?>">
            <span class="name"><?=$product['title']?></span>
            <span class="price">
                &dollar;<?=$product['price']?>
            </span>
        </a>
        <?php endforeach; ?>
    </div>
</div>

<?=template_footer()?>