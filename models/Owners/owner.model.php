<?php

class Owner
{
    public $id;
    public $first_name;
	public $last_name;
	public $phone;
	public $email;
	public $password;
	public $role_id;
	public $image;
    public $commission_rate;
    public $commission_type_id;

    // constructor function 
    public function __construct($id, $fname, $lname, $phone, $email, $password, $role_id, $image, $commission_rate, $commission_type_id)
    {
        $this->id = $id;
        $this->first_name = $fname;
        $this->last_name = $lname;
        $this->phone = $phone;
        $this->email = $email;
        $this->password = $password;
        $this->role_id = $role_id;
        $this->image = $image;
        $this->commission_rate = $commission_rate;
        $this->commission_type_id = $commission_type_id;
    }

    // Create a owner profile
    public function create_owner()
    {
        global $db, $tx;
        $stmnt = $db->prepare("INSERT INTO {$tx}vehicle_owner(id, first_name, last_name, phone, email, password, role_id, image, commission_rate, commission_type_id)VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmnt->bind_param("isssssisdi", $this->id, $this->first_name, $this->last_name, $this->phone, $this->email, $this->password, $this->role_id, $this->image, $this->commission_rate, $this->commission_type_id);
        $result = $stmnt->execute();
		if ($result) {
			return $db->insert_id;
		} else {
			return false;
		}
    }

    // Get All Owners
    public static function get_owners()
    {
        global $db, $tx;
        $stmnt = $db->prepare("SELECT * FROM {$tx}vehicle_owner");
        $stmnt->execute();
        $result = $stmnt->get_result();
        if ($result) {
            $owners = $result->fetch_all(MYSQLI_ASSOC);
            return $owners;
        } else {
            return [];
        }
    }

    // Get All Owners
    public static function get_owner($id)
    {
        global $db, $tx;
        $stmnt = $db->prepare("SELECT * FROM {$tx}vehicle_owner WHERE id = ?");
        $stmnt->bind_param("i", $id);
        $stmnt->execute();
        $result = $stmnt->get_result();
        if ($result) {
            $owner = $result->fetch_object();
            return $owner;
        } else {
            return [];
        }
    }

    // update Owner
    public function update_owner()
    {
        global $db, $tx;
        $stmnt = $db->prepare("UPDATE {$tx}vehicle_owner SET first_name = ?, last_name = ?, phone = ?, email = ?, commission_rate = ?, commission_type_id = ? WHERE id = ?");
        $stmnt->bind_param("ssssdis", $this->first_name, $this->last_name, $this->phone, $this->email, $this->commission_rate, $this->commission_type_id, $this->id);
        return $stmnt->execute();
    }

    // Delete Owner
    public static function delete_owner($id)
    {
        global $db, $tx;
        $stmnt = $db->prepare("DELETE FROM {$tx}vehicle_owner WHERE id = ?");
        $stmnt->bind_param("i", $id);
        return $stmnt->execute();
    }
}
