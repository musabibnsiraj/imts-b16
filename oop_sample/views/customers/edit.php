<?php
require_once '../../models/Customer.php';
$c = new Customer();
$customer = $c->getById($_GET['id']);

// echo '</tr>';
// print("<pre>");
// var_dump($customer);
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

<h1>Edit Customer</h1>

<form action="save_or_update.php" method="post" class="customer-form">
    <input type="hidden" name="id" value="<?php echo $customer['id']; ?>" />
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" id="name" name="name" value="<?php echo $customer['name']; ?>" />
    </div>
    <div class="form-group">
        <label for="mobile">Mobile</label>
        <input type="text" id="mobile" name="mobile" value="<?php echo $customer['mobile']; ?>" />
    </div>
    <button type="submit" class="btn">Update Customer</button>
</form>