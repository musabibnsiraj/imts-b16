<?php
include_once 'BaseModel.php';

class Item extends BaseModel
{
    public $firstname;
    public $lastname;
    public $email;
    public $phone;

    public function getTableName()
    {
        return "items";
    }

    public function getAll()
    {
        return $this->pm->run("SELECT id, name, price FROM " . $this->getTableName());
    }

    public function addNewRec()
    {
        $param = array(':name' => $this->name, ':price' => $this->price);
        return $this->pm->run("INSERT INTO items(name, price) values(:name, :price)", $param);
    }

    public function updateRec()
    {
        $param = array(':id' => $this->id, ':name' => $this->name, ':price' => $this->price);
        return $this->pm->run("UPDATE items SET name = :name, price = :price WHERE id = :id", $param);
    }
}
