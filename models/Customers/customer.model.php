<?php

class Customer
{
    public $id;
    public $first_name;
    public $last_name;
    public $phone;
    public $email;
    public $password;
    public $national_id;
    public $image;
    public $house_no;
    public $road_no;
    public $postal_code;
    public $state;
    public $city;
    public $country;

    // contructor function 
    public function __construct($id, $first_name, $last_name, $phone, $email, $password, $national_id, $image, $house_no, $road_no, $postal_code, $state, $city, $country)
    {
        $this->id = $id;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->phone = $phone;
        $this->email = $email;
        $this->password = $password;
        $this->national_id = $national_id;
        $this->image = $image;
        $this->house_no = $house_no;
        $this->road_no = $road_no;
        $this->postal_code = $postal_code;
        $this->state = $state;
        $this->city = $city;
        $this->country = $country;
    }

    // create customer
    public function create_customer()
    {
        global $db, $tx;
        $stmnt = $db->prepare("INSERT INTO {$tx}customers(id, first_name, last_name, phone, email, password, national_id, image, house_no, road_no, postal_code, state, city, country)VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmnt->bind_param("isssssssssssss", $this->id, $this->first_name, $this->last_name, $this->phone, $this->email, $this->password, $this->national_id, $this->image, $this->house_no, $this->road_no, $this->postal_code, $this->state, $this->city, $this->country);
        return $stmnt->execute();
    }

    // Get all Customers
    public static function get_customers()
    {
        global $db, $tx;
        $stmnt = $db->prepare("SELECT * FROM {$tx}customers");
        $stmnt->execute();
        $result = $stmnt->get_result();
        if ($result) {
            $customers = $result->fetch_all(MYSQLI_ASSOC);
            return $customers;
        } else {
            return [];
        }
    }

    // Get Customer
    public static function get_customer($field_name, $value)
    {
        global $db, $tx;
        $stmnt = $db->prepare("SELECT * FROM {$tx}customers WHERE $field_name = ?");
        $stmnt->bind_param("i", $value);
        $stmnt->execute();
        $result = $stmnt->get_result();
        if ($result) {
            $customer = $result->fetch_object();
            return $customer;
        } else {
            return [];
        }
    }

    // Update Customer
    public function update_customer()
    {
        global $db, $tx;
        $stmnt = $db->prepare("UPDATE {$tx}customers SET first_name = ?, last_name = ?, phone = ?, email = ?, house_no = ?, road_no = ?, postal_code = ?, state = ? WHERE id = ?");
        $stmnt->bind_param("ssssssssi", $this->first_name, $this->last_name, $this->phone, $this->email, $this->house_no, $this->road_no, $this->postal_code, $this->state, $this->id);
        return $stmnt->execute();
    }

    // Delete Customer
    public static function delete_customer($id)
    {
        global $db, $tx;
        $stmnt = $db->prepare("DELETE FROM {$tx}customers WHERE id = ?");
        $stmnt->bind_param("i", $id);
        return $stmnt->execute();
    }
}
