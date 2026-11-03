<link rel="stylesheet" href="../../css/style.css">
<div class="nav-wrapper">
    <div class="nav-links">
        <a href="../customers/index.php">Customers</a>
        <a href="../items/index.php">Items</a>
        <a href="../sales/index.php">Sales</a>
    </div>
</div>
<h1>Items</h1>
<a href="create.php" class="btn">Add Item</a>

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
    echo '<th>Actions</th>';
    echo '</tr></thead><tbody>';

    foreach ($items as $item) {
        $itemData = (array) $item;
        $itemId = $itemData['id'] ?? null;
        echo '<tr>';
        foreach ($itemData as $value) {
            echo '<td>' . htmlspecialchars((string) $value) . '</td>';
        }
        $encodedItemId = urlencode((string) $itemId);
        echo '<td class="action-buttons">';
        echo '<a href="edit.php?id=' . $encodedItemId . '" class="btn">Edit</a>';
        echo '<a href="delete.php?id=' . $encodedItemId . '" class="btn btn-danger" onclick="return confirm(\'Are you sure you want to delete this item?\');">Delete</a>';
        echo '</td>';
        echo '</tr>';
    }

    echo '</tbody></table>';
} else {
    echo '<p>No items found.</p>';
}