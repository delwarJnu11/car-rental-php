<?php

class Owner
{
    public $id;
    public $user_id;
    public $commission_rate;
    public $commission_type_id;

    // constructor function 
    public function __construct($id, $user_id, $commission_rate, $commission_type_id)
    {
        $this->id = $id;
        $this->user_id = $user_id;
        $this->commission_rate = $commission_rate;
        $this->commission_type_id = $commission_type_id;
    }

    // Create a owner profile
    public function create_owner()
    {
        global $db, $tx;
        $stmnt = $db->prepare("INSERT INTO {$tx}vehicle_owner(id, user_id, commission_rate, commission_type_id)VALUES(?, ?, ?, ?)");
        $stmnt->bind_param("iidi", $this->id, $this->user_id, $this->commission_rate, $this->commission_type_id);
        return $stmnt->execute();
    }

    // Get All Owners
    public static function get_owners()
    {
        global $db, $tx;
        $stmnt = $db->prepare("SELECT vo.*, u.first_name, u.last_name, u.email, u.phone, u.image FROM {$tx}vehicle_owner vo JOIN {$tx}users u ON vo.user_id = u.id");
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
        $stmnt = $db->prepare("SELECT vo.*, u.first_name, u.last_name, u.email, u.phone FROM {$tx}vehicle_owner vo JOIN {$tx}users u ON u.id = vo.user_id WHERE vo.id = ?");
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

    // update User Via Owner
    public static function update_owner_details($fname, $lname, $phone, $email, $user_id)
    {
        global $db, $tx;
        $stmnt = $db->prepare("UPDATE {$tx}users SET first_name = ?, last_name = ?, phone = ?, email = ? WHERE id = ?");
        $stmnt->bind_param("ssssi", $fname, $lname, $phone, $email, $user_id);
        $stmnt->execute();
    }

    // update Owner
    public function update_owner()
    {
        global $db, $tx;
        $stmnt = $db->prepare("UPDATE {$tx}vehicle_owner SET commission_rate = ?, commission_type_id = ? WHERE id = ?");
        $stmnt->bind_param("sii", $this->commission_rate, $this->commission_type_id, $this->id);
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
