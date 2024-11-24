<?php

class CommissionType
{
    public $id;
    public $commission_type_name;

    // contructor function
    public function __construct($id, $commission_type_name)
    {
        $this->id = $id;
        $this->commission_type_name = $commission_type_name;
    }

    // create Commission type
    public function create_commission_type()
    {
        global $db, $tx;
        $stmnt = $db->prepare("INSERT INTO {$tx}commission_type(id, commission_type)VALUES(?, ?)");
        $stmnt->bind_param("is", $this->id, $this->commission_type_name);
        return  $stmnt->execute();
    }

    // Get Commission Types
    public static function get_commission_types()
    {
        global $db, $tx;
        $stmnt = $db->prepare("SELECT * FROM {$tx}commission_type");
        $stmnt->execute();
        $result = $stmnt->get_result();
        if ($result) {
            $commission_types = $result->fetch_all(MYSQLI_ASSOC);
            return $commission_types;
        } else {
            return [];
        }
    }

    // Get Single Commission Type
    public static function get_commission_type($id)
    {
        global $db, $tx;
        $stmnt = $db->prepare("SELECT * FROM {$tx}commission_type WHERE id = ?");
        $stmnt->bind_param("i", $id);
        $stmnt->execute();
        $result = $stmnt->get_result();
        if ($result) {
            $commission_type = $result->fetch_object();
            return $commission_type;
        } else {
            return [];
        }
    }

    // Update Commission Type
    public function update_commission_type()
    {
        global $db, $tx;
        $stmnt = $db->prepare("UPDATE {$tx}commission_type SET commission_type = ? WHERE id = ?");
        $stmnt->bind_param("si", $this->commission_type_name, $this->id);
        return $stmnt->execute();
    }

    // Delete Commission Type
    public static function delete_commission_type($id)
    {
        global $db, $tx;
        $stmnt = $db->prepare("DELETE FROM {$tx}commission_type WHERE id = ?");
        $stmnt->bind_param("i",  $id);
        return $stmnt->execute();
    }
}
