<?php

class Staff_taskController
{

    // show all task 
    function index()
    {
        view("staff");
    }

    // create
    function create()
    {
        view("staff");
    }

    // save
    function save()
    {
        if (isset($_POST['create'])) {
            $task_assign_user_id = $_SESSION["uid"];
            $task_assign_staff_id = htmlspecialchars(strip_tags($_POST['assign_to']));
            $vehicle_no = htmlspecialchars(strip_tags($_POST['vehicle_no']));
            $task_status_id = htmlspecialchars(strip_tags($_POST['task_status']));
            $task_assign_date = htmlspecialchars(strip_tags($_POST['assign_date']));
            $task_deadline_date = htmlspecialchars(strip_tags($_POST['deadline_date']));
            $description = htmlspecialchars(strip_tags($_POST['description']));

            if ($task_assign_user_id && $task_assign_staff_id && $task_status_id && $task_assign_date && $task_deadline_date && $description) {
                // assign new task
                $newTask = new StaffTask(null, $task_assign_user_id, $task_assign_staff_id, $vehicle_no, $task_status_id, $description, $task_assign_date, $task_deadline_date);
                $result = $newTask->create_task();

                if ($result) {
                    redirect("index");
                }
            }
        }
    }

    // Edit
    function edit($id)
    {
        view("staff");
    }

    // Update
    function update()
    {
        if (isset($_POST['update'])) {
            $task_id = $_POST['id'];
            $staff_id = htmlspecialchars(strip_tags($_POST['assign_to']));
            $assign_date = htmlspecialchars(strip_tags($_POST['assign_date']));
            $deadline_date = htmlspecialchars(strip_tags($_POST['deadline_date']));
            $description = htmlspecialchars(strip_tags($_POST['description']));

            if ($staff_id && $assign_date && $deadline_date && $description) {
                $update_task = new StaffTask($task_id, "", $staff_id, "", "", $description, $assign_date, $deadline_date);
                $result = $update_task->update_task_for_authority();
                if($result){
                    redirect("index");
                }
            }
        }
    }
}
