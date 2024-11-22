<?php

class TaskStatus
{
    public $id;
    public $task_status_name;

    // constructor function
    public function __construct($id, $task_status_name)
    {
        $this->id = $id;
        $this->task_status_name = $task_status_name;
    }

    // Create Task Status
    public function create_task_status()
    {
        global $db, $tx;
        $stmnt = $db->prepare("INSERT INTO {$tx}task_status(id, task_status_name)VALUES(?, ?)");
        $stmnt->bind_param("is", $this->id, $this->task_status_name);
        return $stmnt->execute();
    }

    // Get All Task Status
    public static function get_all_task_status()
    {
        global $db, $tx;
        $stmnt = $db->prepare("SELECT * FROM {$tx}task_status");
        $stmnt->execute();
        $result = $stmnt->get_result();
        if ($result) {
            $all_task_status = $result->fetch_all(MYSQLI_ASSOC);
            return $all_task_status;
        } else {
            return [];
        }
    }

    // Get Signle Task Status
    public static function get_task_status($id)
    {
        global $db, $tx;
        $stmnt = $db->prepare("SELECT * FROM {$tx}task_status WHERE id = ?");
        $stmnt->bind_param("i", $id);
        $stmnt->execute();
        $result = $stmnt->get_result();
        if ($result) {
            $task_status = $result->fetch_object();
            return $task_status;
        } else {
            return [];
        }
    }

    // Update Task Status
    public function update_task_status()
    {
        global $db, $tx;
        $stmnt = $db->prepare("UPDATE {$tx}task_status SET task_status_name = ? WHERE id = ?");
        $stmnt->bind_param("si", $this->task_status_name, $this->id);
        return $stmnt->execute();
    }

    // Delete Task Status
    public static function delete_task_status($id)
    {
        global $db, $tx;
        $stmnt = $db->prepare("DELETE FROM {$tx}task_status WHERE id = ?");
        $stmnt->bind_param("i", $id);
        return $stmnt->execute();
    }
}
