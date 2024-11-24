<?php

class StaffTask
{
    public $id;
    public $task_assign_by_staff_id;
    public $task_assign_to_staff_id;
    public $vehicle_no;
    public $task_status_id;
    public $task_description;
    public $task_assign_date;
    public $task_completion_date;

    // constructor
    public function __construct($id, $assign_by, $assign_to, $vehicle_no, $task_status_id, $task_description, $task_assign_date, $task_completion_date)
    {
        $this->id = $id;
        $this->task_assign_by_staff_id = $assign_by;
        $this->task_assign_to_staff_id = $assign_to;
        $this->vehicle_no = $vehicle_no;
        $this->task_status_id = $task_status_id;
        $this->task_description = $task_description;
        $this->task_assign_date = $task_assign_date;
        $this->task_completion_date = $task_completion_date;
    }

    // Create Task for a Staff
    public function create_task()
    {
        global $db, $tx;
        $stmnt =  $db->prepare("INSERT INTO {$tx}staff_task(id, task_assign_by_staff_id,task_assign_to_staff_id, vehicle_no, task_status_id, task_description, task_assign_date, task_completion_date)VALUES(?, ?, ?, ?, ?, ?, ?, ?)");
        $stmnt->bind_param("iiiiisss", $this->id, $this->task_assign_by_staff_id, $this->task_assign_to_staff_id, $this->vehicle_no, $this->task_status_id, $this->task_description, $this->task_assign_date, $this->task_completion_date);
        return $stmnt->execute();
    }

    // Get All Staff's Task
    public static function get_tasks()
    {
        global $db, $tx;
        $stmnt = $db->prepare("SELECT st.*, s.first_name, s.last_name, u.first_name as ufname, u.last_name as ulname, ts.task_status_name FROM {$tx}staff_task st JOIN {$tx}staff s ON st.task_assign_to_staff_id = s.id JOIN {$tx}users u ON st.task_assign_by_staff_id = u.id JOIN {$tx}task_status ts ON st.task_status_id = ts.id");
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
    public static function get_task($value)
    {
        global $db, $tx;
        $type = is_numeric($value) ? "i" : "s";
        $stmnt = $db->prepare("SELECT * FROM {$tx}staff_task WHERE id = ? OR vehicle_no = ?");
        $stmnt->bind_param($type . $type, $value, $value);
        $stmnt->execute();
        $result = $stmnt->get_result();
        if ($result) {
            $task = $result->fetch_object();
            return $task;
        } else {
            return [];
        }
    }

    // Update staff task for Authority
    public function update_task_for_authority()
    {
        global $db, $tx;
        $stmnt = $db->prepare("UPDATE {$tx}staff_task SET task_assign_to_staff_id = ?,task_description = ?, task_assign_date = ?, task_completion_date = ? WHERE id = ?");
        $stmnt->bind_param("isssi", $this->task_assign_to_staff_id, $this->task_description, $this->task_assign_date, $this->task_completion_date, $this->id);
        return $stmnt->execute();
    }

    // Update staff task for Staff
    public function update_task_for_staff()
    {
        global $db, $tx;
        $stmnt = $db->prepare("UPDATE {$tx}staff_task SET task_status_id = ? WHERE id = ?");
        $stmnt->bind_param("ii", $this->task_status_id, $this->id);
        return $stmnt->execute();
    }
}
