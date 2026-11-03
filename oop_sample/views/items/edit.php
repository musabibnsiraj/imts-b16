<?php
require_once '../../models/Item.php';
$c = new Item();
$item = $c->getById($_GET['id']);

// echo '</tr>';
// print("<pre>");
// var_dump($item);
// print("</pre>");
// die;
?>
<link rel="stylesheet" href="../../css/style.css">

<div class="nav-wrapper">
    <div class="nav-links">
        <a href="../customers/index.php">Customers</a>
        <a href="../items/index.php">Items</a>
        <a href="../sales/index.php">Sales</a>
    </div>
</div>

<h1>Edit Item</h1>

<form action="save_or_update.php" method="post" class="customer-form">
    <input type="hidden" name="id" value="<?php echo $item['id']; ?>" />
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" id="name" name="name" value="<?php echo $item['name']; ?>" />
    </div>
    <div class="form-group">
        <label for="price">Price</label>
        <input type="number" id="price" name="price" step="0.01" value="<?php echo $item['price']; ?>" />
    </div>
    <button type="submit" class="btn">Update Item</button>
</form>