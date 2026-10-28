<link rel="stylesheet" href="../../css/style.css">
<div class="nav-wrapper">
    <div class="nav-links">
        <a href="../customers/index.php">Customers</a>
        <a href="../items/index.php">Items</a>
        <a href="../sales/index.php">Sales</a>
    </div>
</div>

<h1>Sales</h1>

<?php

require_once '../../models/Sale.php';

$s = new Sale();
$sales = $s->getAll();

if (!empty($sales)) {
    echo '<table  class="styled-table">';
    echo '<thead><tr>';
    foreach (array_keys((array) $sales[0]) as $column) {
        echo '<th>' . htmlspecialchars($column) . '</th>';
    }
    echo '</tr></thead><tbody>';

    foreach ($sales as $sale) {
        echo '<tr>';
        foreach ((array) $sale as $value) {
            echo '<td>' . htmlspecialchars((string) $value) . '</td>';
        }
        echo '</tr>';
    }

    echo '</tbody></table>';
} else {
    echo '<p>No sales found.</p>';
}