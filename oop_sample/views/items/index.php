<link rel="stylesheet" href="../../css/style.css">
<div class="nav-wrapper">
    <div class="nav-links">
        <a href="../customers/index.php">Customers</a>
        <a href="../items/index.php">Items</a>
        <a href="../sales/index.php">Sales</a>
    </div>
</div>
<h1>Items</h1>

<?php

require_once '../../models/Item.php';

$i = new Item();
$items = $i->getAll();

if (!empty($items)) {
    echo '<table  class="styled-table">';
    echo '<thead><tr>';
    foreach (array_keys((array) $items[0]) as $column) {
        echo '<th>' . htmlspecialchars(ucfirst($column)) . '</th>';
    }
    echo '</tr></thead><tbody>';

    foreach ($items as $item) {
        echo '<tr>';
        foreach ((array) $item as $value) {
            echo '<td>' . htmlspecialchars((string) $value) . '</td>';
        }
        echo '</tr>';
    }

    echo '</tbody></table>';
} else {
    echo '<p>No items found.</p>';
}