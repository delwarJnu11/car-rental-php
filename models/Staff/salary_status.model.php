<?php

class SalaryStatus
{
    public $id;
    public $salary_status_name;

    // constructor function
    public function __construct($id, $salary_status_name)
    {
        $this->id = $id;
        $this->salary_status_name = $salary_status_name;
    }

    // Create Salary Status
    public function create_salary_status()
    {
        global $db, $tx;
        $stmnt = $db->prepare("INSERT INTO {$tx}salary_status(id, salary_status_name)VALUES(?, ?)");
        $stmnt->bind_param("is", $this->id, $this->salary_status_name);
        return $stmnt->execute();
    }

    // Get All Salary Status
    public static function get_all_salary_status()
    {
        global $db, $tx;
        $stmnt = $db->prepare("SELECT * FROM {$tx}salary_status");
        $stmnt->execute();
        $result = $stmnt->get_result();
        if ($result) {
            $all_salary_status = $result->fetch_all(MYSQLI_ASSOC);
            return $all_salary_status;
        } else {
            return [];
        }
    }

    // Get Signle Salary Status
    public static function get_salary_status($id)
    {
        global $db, $tx;
        $stmnt = $db->prepare("SELECT * FROM {$tx}salary_status WHERE id = ?");
        $stmnt->bind_param("i", $id);
        $stmnt->execute();
        $result = $stmnt->get_result();
        if ($result) {
            $salary_status = $result->fetch_object();
            return $salary_status;
        } else {
            return [];
        }
    }

    // Update Salary Status
    public function update_salary_status()
    {
        global $db, $tx;
        $stmnt = $db->prepare("UPDATE {$tx}salary_status SET salary_status_name = ? WHERE id = ?");
        $stmnt->bind_param("si", $this->salary_status_name, $this->id);
        return $stmnt->execute();
    }

    // Delete Salary Status
    public static function delete_salary_status($id)
    {
        global $db, $tx;
        $stmnt = $db->prepare("DELETE FROM {$tx}salary_status WHERE id = ?");
        $stmnt->bind_param("i", $id);
        return $stmnt->execute();
    }
}
