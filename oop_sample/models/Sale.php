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
        return $this->pm->run(
            "SELECT sales.id, sales.sales_date, customers.name AS customer_name, sales.total
             FROM sales
             INNER JOIN customers ON sales.customer_id = customers.id"
        );
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

    public function getDetailById($id)
    {
        $param = array(':sale_id' => $id);
        return $this->pm->run("SELECT s.id, s.sales_date, s.total, c.name as customer_name FROM sales s, customers c where s.customer_id = c.id and s.id = :sale_id", $param, true);
    }

    public function updateTotal()
    {
        $param = array(':sale_id' => $this->id, ':id' => $this->id);
        $this->pm->run("UPDATE sales set total = (SELECT SUM(price * qty) FROM sales_items where sale_id = :sale_id) where id = :id", $param);
    }
}
