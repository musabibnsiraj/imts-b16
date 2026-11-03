<?php

require_once '../../models/Sale.php';

$sale = new Sale();
$result = $sale->deleteRec($_GET['id'] ?? '');

if ($result != -1) {
    header('Location: index.php');
    exit;
}

echo 'Unable to delete sale.';
