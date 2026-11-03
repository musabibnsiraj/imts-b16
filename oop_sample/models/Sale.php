<?php
include_once 'BaseModel.php';

class Sale extends BaseModel
{
    public $customer_id;
    public $sales_date;
    public $email;
    public $phone;

    public function getTableName()
    {
        return "sales";
    }

    public function getAll()
    {
        return $this->pm->run("SELECT id, sales_date, customer_id, total FROM " . $this->getTableName());
    }


    public function addNewRec()
    {
        $param = array(
            ':sales_date' => $this->sales_date,
            ':customer_id' => $this->customer_id,
            ':total' => $this->total
        );
        return $this->pm->run(
            "INSERT INTO sales(sales_date, customer_id, total) VALUES(:sales_date, :customer_id, :total)",
            $param
        );
    }

    public function updateRec()
    {
        $param = array(
            ':id' => $this->id,
            ':sales_date' => $this->sales_date,
            ':customer_id' => $this->customer_id,
            ':total' => $this->total
        );
        return $this->pm->run(
            "UPDATE sales SET sales_date = :sales_date, customer_id = :customer_id, total = :total WHERE id = :id",
            $param
        );
    }
}
