<link rel="stylesheet" href="../../css/style.css">

<div class="nav-wrapper">
    <div class="nav-links">
        <a href="../customers/index.php">Customers</a>
        <a href="../items/index.php">Items</a>
        <a href="../sales/index.php">Sales</a>
    </div>
</div>
<h1>Customers</h1>

<?php

require_once '../../models/Customer.php';

$c = new Customer();
$customers = $c->getAll();

if (!empty($customers)) {
    echo '<table class="styled-table">';
    echo '<thead><tr>';
    foreach (array_keys((array) $customers[0]) as $heading) {
        echo '<th>' . htmlspecialchars(ucfirst($heading)) . '</th>';
    }
    echo '</tr></thead><tbody>';

    foreach ($customers as $customer) {
        echo '<tr>';
        foreach ((array) $customer as $value) {
            echo '<td>' . htmlspecialchars((string) $value) . '</td>';
        }
        echo '</tr>';
    }

    echo '</tbody></table>';
} else {
    echo '<p>No customers found.</p>';
}