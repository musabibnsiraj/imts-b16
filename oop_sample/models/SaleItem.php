<?php

require_once 'BaseModel.php';
require_once 'Sale.php';

class SaleItem extends BaseModel
{
    public $saleId;
    public $itemId;
    public $price;
    public $qty;

    protected function getTableName()
    {
        return "sales_items";
    }

    public function getAll()
    {
        $param = array(':sale_id' => $this->saleId);
        return $this->pm->run("SELECT si.id, i.name as item_name, si.price, si.qty FROM sales_items si, items i where si.item_id = i.id and si.sale_id = :sale_id", $param);
    }

    protected function addNewRec()
    {
        $param = array(':sale_id' => $this->saleId, ':item_id' => $this->itemId, ':price' => $this->price, ':qty' => $this->qty);
        return $this->pm->run("INSERT INTO sales_items(sale_id, item_id, price, qty) values(:sale_id, :item_id, :price, :qty)", $param);
    }

    protected function updateRec()
    {
        $param = array(':item_id' => $this->itemId, ':qty' => $this->qty, ':id' => $this->id);
        return $this->pm->run("UPDATE sales_items SET item_id = :item_id, qty = :qty WHERE id = :id", $param);
    }

    public function deleteAllBySaleId($saleId)
    {
        $param = array(':sale_id' => $saleId);
        $this->pm->run('DELETE FROM sales_items WHERE sale_id = :sale_id', $param);
    }
}
