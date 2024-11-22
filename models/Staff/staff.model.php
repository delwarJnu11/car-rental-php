<?php

class Staff
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
    public $designation_id;
    public $date_of_hire;
    public $salary;

    // constructor function
    public function __construct($id, $first_name, $last_name, $phone, $email, $password, $national_id, $image, $house_no, $road_no, $postal_code, $state, $city, $country, $designation_id, $date_of_hire, $salary)
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
        $this->designation_id = $designation_id;
        $this->date_of_hire = $date_of_hire;
        $this->salary = $salary;
    }

    // Create New Staff
    public function create_staff()
    {
        global $db, $tx;
        $stmnt = $db->prepare("INSERT INTO {$tx}staff(id, first_name, last_name, phone, email, password, national_id, image, house_no, road_no, postal_code, state, city, country, designation_id, date_of_hire, salary)VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmnt->bind_param("isssssssssssssisd", $this->id, $this->first_name, $this->last_name, $this->phone, $this->email, $this->password, $this->national_id, $this->image, $this->house_no, $this->road_no, $this->postal_code, $this->state, $this->city, $this->country, $this->designation_id, $this->date_of_hire, $this->salary);
        return $stmnt->execute();
    }

    // Get All Staff
    public static function get_all_staff()
    {
        global $db, $tx;
        $stmnt = $db->prepare("SELECT * FROM {$tx}staff");
        $stmnt->execute();
        $result = $stmnt->get_result();
        if ($result) {
            $all_staff = $result->fetch_all(MYSQLI_ASSOC);
            return $all_staff;
        } else {
            return [];
        }
    }

    // Get Single Staff
    public static function get_staff($id)
    {
        global $db, $tx;
        $stmnt = $db->prepare("SELECT * FROM {$tx}staff WHERE id = ?");
        $stmnt->bind_param("i", $id);
        $stmnt->execute();
        $result = $stmnt->get_result();
        if ($result) {
            $staff = $result->fetch_object();
            return $staff;
        } else {
            return [];
        }
    }

    // Update Staff
    public function update_staff()
    {
        global $db, $tx;
        $stmnt = $db->prepare("UPDATE {$tx}staff SET first_name = ?, last_name = ?, phone = ?, email = ?, house_no = ?, road_no = ?, postal_code = ?, state = ?, city = ?, country = ?, designation_id = ?, salary = ? WHERE id = ?");
        $stmnt->bind_param("ssssssssssidi", $this->first_name, $this->last_name, $this->phone, $this->email, $this->house_no, $this->road_no, $this->postal_code, $this->state, $this->city, $this->country, $this->designation_id, $this->salary, $this->id);
        return $stmnt->execute();
    }

    // Delete staff
    public static function delete_staff($id)
    {
        global $db, $tx;
        $stmnt = $db->prepare("DELETE FROM {$tx}staff WHERE id = ?");
        $stmnt->bind_param("i", $id);
        return $stmnt->execute();
    }
}
