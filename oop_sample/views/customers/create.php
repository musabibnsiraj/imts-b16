<link rel="stylesheet" href="../../css/style.css">

<div class="nav-wrapper">
    <div class="nav-links">
        <a href="../customers/index.php">Customers</a>
        <a href="../items/index.php">Items</a>
        <a href="../sales/index.php">Sales</a>
    </div>
</div>
<h1>Craete Customer</h1>

<form action="save_or_update.php" method="post" class="customer-form">
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" id="name" name="name" />
    </div>
    <div class="form-group">
        <label for="mobile">Mobile</label>
        <input type="text" id="mobile" name="mobile" />
    </div>
    <button type="submit" class="btn">Save Customer</button>
</form>