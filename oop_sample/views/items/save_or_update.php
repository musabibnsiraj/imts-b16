<?php
require_once '../../models/Item.php';
//
$item = new Item();
$item->id = $_POST['id'] ?? '';
$item->name = $_POST['name'];
$item->price = $_POST['price'];
$result = $item->save();
//
if($result != -1)
{
    header('location: index.php');
}
?>