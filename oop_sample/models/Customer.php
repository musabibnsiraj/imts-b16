<?php
include_once 'BaseModel.php';

class Customer extends BaseModel
{
    public $firstname;
    public $lastname;
    public $email;
    public $phone;

    public function getTableName()
    {
        return "customers";
    }

    public function getAll()
    {
        return $this->pm->run("SELECT id, name, mobile FROM " . $this->getTableName());
    }

    public function addNewRec() {}

    public function updateRec() {}


    // public function __construct()
    // {
    //     parent::__construct();
    // }

    // public function getAllCustomers()
    // {
    //     return $this->pm->run("SELECT * FROM customers");
    // }

    // public function getCustomerById($id)
    // {
    //     $param = array(':id' => $id);
    //     return $this->pm->run("SELECT * FROM customers WHERE id = :id", $param, true);
    // }

    // public function createCustomer($data)
    // {
    //     $param = array(
    //         ':firstname' => $data['firstname'],
    //         ':lastname' => $data['lastname'],
    //         ':email' => $data['email'],
    //         ':phone' => $data['phone']
    //     );
    //     return $this->pm->insertAndGetLastRowId("INSERT INTO customers(firstname, lastname, email, phone) VALUES(:firstname, :lastname, :email, :phone)", $param);
    // }

    // public function updateCustomer($id, $data)
    // {
    //     $param = array(
    //         ':id' => $id,
    //         ':firstname' => $data['firstname'],
    //         ':lastname' => $data['lastname'],
    //         ':email' => $data['email'],
    //         ':phone' => $data['phone']
    //     );
    //     return $this->pm->run("UPDATE customers SET firstname = :firstname, lastname = :lastname, email = :email, phone = :phone WHERE id = :id", $param);
    // }

    // public function deleteCustomer($id)
    // {
    //     $param = array(':id' => $id);
    //     return $this->pm->run("DELETE FROM customers WHERE id = :id", $param);
    // }
}
