<?php
include_once 'BaseModel.php';

class Customer extends BaseModel
{
    public $name;
    public $mobile;

    public function getTableName()
    {
        return "customers";
    }

    public function getAll()
    {
        // Retrieve all records from the database
        return $this->pm->run("SELECT id, name, mobile FROM " . $this->getTableName());
    }

    public function addNewRec()
    {
        // Add a new record to the database
        $param = array(':name' => $this->name, ':mobile' => $this->mobile);
        return $this->pm->run("INSERT INTO customers(name, mobile) values(:name, :mobile)", $param);
    }

    public function updateRec() {
        // Update the record in the database

        $param = array(':id' => $this->id, ':name' => $this->name, ':mobile' => $this->mobile);
        return $this->pm->run("UPDATE customers SET name = :name, mobile = :mobile WHERE id = :id", $param);
    }
}
