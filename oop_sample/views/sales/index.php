<link rel="stylesheet" href="../../css/style.css">
<div class="nav-wrapper">
    <div class="nav-links">
        <a href="../customers/index.php">Customers</a>
        <a href="../items/index.php">Items</a>
        <a href="../sales/index.php">Sales</a>
    </div>
</div>

<h1>Sales</h1>
<a href="create.php" class="btn">Add Sale</a>

<?php

require_once '../../models/Sale.php';

$s = new Sale();
$sales = $s->getAll();

if (!empty($sales)) {
    echo '<table  class="styled-table">';
    echo '<thead><tr>';
    foreach (array_keys((array) $sales[0]) as $column) {
        $heading = $column === 'customer_name' ? 'Customer' : ucwords(str_replace('_', ' ', $column));
        echo '<th>' . htmlspecialchars($heading) . '</th>';
    }
    echo '<th>Actions</th>';
    echo '</tr></thead><tbody>';

    foreach ($sales as $sale) {
        $saleData = (array) $sale;
        $saleId = $saleData['id'] ?? null;
        echo '<tr>';
        foreach ($saleData as $value) {
            echo '<td>' . htmlspecialchars((string) $value) . '</td>';
        }
        $encodedSaleId = urlencode((string) $saleId);
        echo '<td class="action-buttons">';
        echo '<a href="../sale-items/index.php?sale_id=' . $encodedSaleId . '" class="btn">Detail</a>';
        echo '<a href="edit.php?id=' . $encodedSaleId . '" class="btn">Edit</a>';
        echo '<a href="delete.php?id=' . $encodedSaleId . '" class="btn btn-danger" onclick="return confirm(\'Are you sure you want to delete this sale?\');">Delete</a>';
        echo '</td>';
        echo '</tr>';
    }

    echo '</tbody></table>';
} else {
    echo '<p>No sales found.</p>';
}