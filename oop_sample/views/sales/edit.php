<?php
require_once '../../models/Sale.php';
require_once '../../models/Customer.php';

$saleModel = new Sale();
$sale = $saleModel->getById($_GET['id'] ?? '');

$customerModel = new Customer();
$customers = $customerModel->getAll();
?>
<link rel="stylesheet" href="../../css/style.css">

<div class="nav-wrapper">
    <div class="nav-links">
        <a href="../customers/index.php">Customers</a>
        <a href="../items/index.php">Items</a>
        <a href="../sales/index.php">Sales</a>
    </div>
</div>

<h1>Edit Sale</h1>

<form action="save_or_update.php" method="post" class="customer-form">
    <input type="hidden" name="id" value="<?php echo htmlspecialchars((string) $sale['id']); ?>" />
    <div class="form-group">
        <label for="sales_date">Sale Date</label>
        <input type="date" id="sales_date" name="sales_date" value="<?php echo htmlspecialchars($sale['sales_date']); ?>" required />
    </div>
    <div class="form-group">
        <label for="customer_id">Customer</label>
        <select id="customer_id" name="customer_id" required>
            <?php foreach ($customers as $customer) : ?>
                <option value="<?php echo htmlspecialchars((string) $customer['id']); ?>" <?php echo (string) $customer['id'] === (string) $sale['customer_id'] ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($customer['name']); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="total">Total</label>
        <input type="number" id="total" name="total" step="0.01" min="0" value="<?php echo htmlspecialchars((string) $sale['total']); ?>" required />
    </div>
    <button type="submit" class="btn">Update Sale</button>
</form>
