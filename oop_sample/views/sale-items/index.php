<link rel="stylesheet" href="../../css/style.css">

<div class="nav-wrapper">
    <div class="nav-links">
        <a href="../customers/index.php">Customers</a>
        <a href="../items/index.php">Items</a>
        <a href="../sales/index.php">Sales</a>
    </div>
</div>

<?php
require_once '../../models/SaleItem.php';
require_once '../../models/Sale.php';

$saleId = $_GET['sale_id'] ?? '';
$s = new Sale();
$sale = $s->getDetailById($saleId);

$si = new SaleItem();
$si->saleId = $saleId;
$saleItems = $si->getAll();
?>

<h1>Sale Details</h1>
<a href="create.php?sale_id=<?php echo urlencode((string) $saleId); ?>" class="btn">Add Sale Item</a>

<table class="styled-table">
    <thead>
        <tr>
            <th>Date</th>
            <th>Customer</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><?php echo htmlspecialchars((string) ($sale['sales_date'] ?? '')); ?></td>
            <td><?php echo htmlspecialchars((string) ($sale['customer_name'] ?? '')); ?></td>
            <td><?php echo htmlspecialchars((string) ($sale['total'] ?? '')); ?></td>
        </tr>
    </tbody>
</table>

<table class="styled-table">
    <thead>
        <tr>
            <th>Item</th>
            <th>Price</th>
            <th>Qty</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($saleItems as $saleItem) : ?>
        <tr>
            <td><?php echo htmlspecialchars((string) $saleItem['item_name']); ?></td>
            <td><?php echo htmlspecialchars((string) $saleItem['price']); ?></td>
            <td><?php echo htmlspecialchars((string) $saleItem['qty']); ?></td>
            <td class="action-buttons">
                <a href="edit.php?id=<?php echo urlencode((string) $saleItem['id']); ?>&amp;sale_id=<?php echo urlencode((string) $saleId); ?>" class="btn">Edit</a>
                <a href="delete.php?id=<?php echo urlencode((string) $saleItem['id']); ?>&amp;sale_id=<?php echo urlencode((string) $saleId); ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this sale item?');">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
    <?php if (empty($saleItems)) : ?>
        <tr>
            <td colspan="4">No sale items found.</td>
        </tr>
    <?php endif; ?>
    </tbody>
</table>