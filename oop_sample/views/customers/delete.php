<?php

require_once '../../models/Customer.php';

$customer = new Customer();
$result = $customer->deleteRec($_GET['id'] ?? '');

if ($result != -1) {
    header('Location: index.php');
    exit;
}

echo 'Unable to delete customer.';
