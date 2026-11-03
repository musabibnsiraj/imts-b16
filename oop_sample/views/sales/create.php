<link rel="stylesheet" href="../../css/style.css">

<div class="nav-wrapper">
    <div class="nav-links">
        <a href="../customers/index.php">Customers</a>
        <a href="../items/index.php">Items</a>
        <a href="../sales/index.php">Sales</a>
    </div>
</div>

<h1>Create Sale</h1>

<?php
require_once '../../models/Customer.php';

$customerModel = new Customer();
$customers = $customerModel->getAll();
?>

<form action="save_or_update.php" method="post" class="customer-form">
    <div class="form-group">
        <label for="sales_date">Sale Date</label>
        <input type="date" id="sales_date" name="sales_date" required />
    </div>
    <div class="form-group">
        <label for="customer_id">Customer</label>
        <select id="customer_id" name="customer_id" required>
            <option value="">Select a customer</option>
            <?php foreach ($customers as $customer) : ?>
                <option value="<?php echo htmlspecialchars((string) $customer['id']); ?>">
                    <?php echo htmlspecialchars($customer['name']); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="total">Total</label>
        <input type="number" id="total" name="total" step="0.01" min="0" value="0" required />
    </div>
    <button type="submit" class="btn">Save Sale</button>
</form>
