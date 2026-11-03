<link rel="stylesheet" href="../../css/style.css">

<div class="nav-wrapper">
    <div class="nav-links">
        <a href="../customers/index.php">Customers</a>
        <a href="../items/index.php">Items</a>
        <a href="../sales/index.php">Sales</a>
    </div>
</div>
<h1>Create Item</h1>

<form action="save_or_update.php" method="post" class="customer-form">
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" id="name" name="name" />
    </div>
    
    <div class="form-group">
        <label for="price">Price</label>
        <input type="number" id="price" name="price" step="0.01"/>
    </div>
    <button type="submit" class="btn">Save Item</button>
</form>