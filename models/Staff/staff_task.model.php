<?php

class StaffTask
{
    public $id;
    public $assign_by;
    public $task_status_id;
    public $task_description;
    public $task_assign_date;
    public $task_completion_date;

    // constructor
    public function __construct($id, $assign_by, $task_status_id, $task_description, $task_assign_date, $task_completion_date)
    {
        $this->id = $id;
        $this->assign_by = $assign_by;
        $this->task_status_id = $task_status_id;
        $this->task_description = $task_description;
        $this->task_assign_date = $task_assign_date;
        $this->task_completion_date = $task_completion_date;
    }

    // Create Task for a Staff
    public function create_task()
    {
        global $db, $tx;
        $stmnt =  $db->prepare("INSERT INTO {$tx}staff_task(id, assign_by, task_status_id, task_description, task_assign_date, task_completion_date)VALUES(?, ?, ?, ?, ?, ?)");
        $stmnt->bind_param("iisss", $this->id, $this->assign_by, $this->task_status_id, $this->task_description, $this->task_assign_date, $this->task_completion_date);
        return $stmnt->execute();
    }

    // Get All Staff's Task
    public static function get_tasks()
    {
        global $db, $tx;
        $stmnt = $db->prepare("SELECT * FROM {$tx}staff_task");
        $stmnt->execute();
        $result = $stmnt->get_result();
        if ($result) {
            $tasks = $result->fetch_all(MYSQLI_ASSOC);
            return $tasks;
        } else {
            return [];
        }
    }

    // Get Single Staff's Task
    public static function get_task($id)
    {
        global $db, $tx;
        $stmnt = $db->prepare("SELECT * FROM {$tx}staff_task WHERE id = ?");
        $stmnt->bind_param("i", $id);
        $stmnt->execute();
        $result = $stmnt->get_result();
        if ($result) {
            $tasks = $result->fetch_all(MYSQLI_ASSOC);
            return $tasks;
        } else {
            return [];
        }
    }

    // Update staff task
    public function update_task()
    {
        global $db, $tx;
        $stmnt = $db->prepare("UPDATE {$tx}staff_task SET task_status_id = ?,task_description = ?, task_completion_date = ? WHERE id = ?");
        $stmnt->bind_param("issi", $this->task_status_id, $this->task_description, $this->task_completion_date);
        return $stmnt->execute();
    }
}
