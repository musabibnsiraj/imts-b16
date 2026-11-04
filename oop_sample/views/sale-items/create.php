<link rel="stylesheet" href="../../css/style.css">

<div class="nav-wrapper">
    <div class="nav-links">
        <a href="../customers/index.php">Customers</a>
        <a href="../items/index.php">Items</a>
        <a href="../sales/index.php">Sales</a>
    </div>
</div>

<?php
require_once '../../models/Item.php';
$i = new Item();
$items = $i->getAll();
$saleId = $_GET['sale_id'] ?? '';
?>

<h1>Add Sale Item</h1>

<form action="save_and_update.php" method="post" class="customer-form">
    <input type="hidden" name="sale_id" value="<?php echo htmlspecialchars((string) $saleId); ?>">

    <div class="form-group">
        <label for="item_id">Item</label>
        <select id="item_id" name="item_id" required>
            <option value="">Select an item</option>
            <?php foreach ($items as $item) : ?>
                <option value="<?php echo htmlspecialchars((string) $item['id']); ?>">
                    <?php echo htmlspecialchars($item['name'] . ' - LKR ' . $item['price']); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="form-group">
        <label for="qty">Quantity</label>
        <input type="number" id="qty" name="qty" min="1" required>
    </div>

    <button type="submit" class="btn">Save Sale Item</button>
</form>

<a href="index.php?sale_id=<?php echo urlencode((string) $saleId); ?>" class="btn">Back to Sale</a>