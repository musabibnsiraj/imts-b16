<link rel="stylesheet" href="../../css/style.css">

<div class="nav-wrapper">
    <div class="nav-links">
        <a href="../customers/index.php">Customers</a>
        <a href="../items/index.php">Items</a>
        <a href="../sales/index.php">Sales</a>
    </div>
</div>

<h1>Customers</h1>
<a href="create.php" class="btn">Add Customer</a>

<?php

require_once '../../models/Customer.php';

$c = new Customer();
$customers = $c->getAll();

// print("<pre>");
// var_dump($customers);
// print("</pre>");
// die;


if (!empty($customers)) {
    echo '<table class="styled-table">';
    echo '<thead><tr>';
    foreach (array_keys((array) $customers[0]) as $heading) {
        echo '<th>' . htmlspecialchars(ucfirst($heading)) . '</th>';
    }
    echo '<th>Actions</th>';
    echo '</tr></thead><tbody>';

    foreach ($customers as $customer) {
        $customerData = (array) $customer;
        $customerId = $customerData['id'] ?? $customerData['customer_id'] ?? null;
        echo '<tr>';
        foreach ($customerData as $value) {
            echo '<td>' . htmlspecialchars((string) $value) . '</td>';
        }
        echo '<td><a href="edit.php?id=' . urlencode((string) $customerId) . '" class="btn">Edit</a></td>';
        echo '</tr>';
    }

    echo '</tbody></table>';
} else {
    echo '<p>No customers found.</p>';
}
