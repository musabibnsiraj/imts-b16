<?php

require_once '../../models/Item.php';

$item = new Item();
$result = $item->deleteRec($_GET['id'] ?? '');

if ($result != -1) {
    header('Location: index.php');
    exit;
}

echo 'Unable to delete item.';
