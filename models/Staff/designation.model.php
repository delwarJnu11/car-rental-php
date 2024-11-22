<?php

class Designation
{
    public $id;
    public $designation_name;

    // constructor function
    public function __construct($id, $designation_name)
    {
        $this->id = $id;
        $this->designation_name = $designation_name;
    }

    // Create designation
    public function create_designation()
    {
        global $db, $tx;
        $stmnt = $db->prepare("INSERT INTO {$tx}staff_designations(id, designation_name)VALUES(?, ?)");
        $stmnt->bind_param("is", $this->id, $this->designation_name);
        return $stmnt->execute();
    }

    // Get All designation
    public static function get_all_designation()
    {
        global $db, $tx;
        $stmnt = $db->prepare("SELECT * FROM {$tx}staff_designations");
        $stmnt->execute();
        $result = $stmnt->get_result();
        if ($result) {
            $designations = $result->fetch_all(MYSQLI_ASSOC);
            return $designations;
        } else {
            return [];
        }
    }

    // Get Signle designation
    public static function get_designation($id)
    {
        global $db, $tx;
        $stmnt = $db->prepare("SELECT * FROM {$tx}staff_designations WHERE id = ?");
        $stmnt->bind_param("i", $id);
        $stmnt->execute();
        $result = $stmnt->get_result();
        if ($result) {
            $designation = $result->fetch_object();
            return $designation;
        } else {
            return [];
        }
    }

    // Update Designation
    public function update_designation()
    {
        global $db, $tx;
        $stmnt = $db->prepare("UPDATE {$tx}staff_designations SET designation_name = ? WHERE id = ?");
        $stmnt->bind_param("si", $this->designation_name, $this->id);
        return $stmnt->execute();
    }

    // Delete Designation
    public static function delete_designation($id)
    {
        global $db, $tx;
        $stmnt = $db->prepare("DELETE FROM {$tx}staff_designations WHERE id = ?");
        $stmnt->bind_param("i", $id);
        return $stmnt->execute();
    }
}
