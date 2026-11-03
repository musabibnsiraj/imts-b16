<?php
require_once '../../models/Sale.php';

$sale = new Sale();
$sale->id = $_POST['id'] ?? '';
$sale->sales_date = $_POST['sales_date'] ?? '';
$sale->customer_id = $_POST['customer_id'] ?? '';
$sale->total = $_POST['total'] ?? 0;
$result = $sale->save();

if ($result != -1) {
    header('Location: index.php');
    exit;
}

echo 'Unable to save sale.';
