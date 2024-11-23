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
            $task_status_id = htmlspecialchars(strip_tags($_POST['task_status']));
            $task_assign_date = htmlspecialchars(strip_tags($_POST['assign_date']));
            $task_deadline_date = htmlspecialchars(strip_tags($_POST['deadline_date']));
            $description = htmlspecialchars(strip_tags($_POST['description']));

            if ($task_assign_user_id && $task_assign_staff_id && $task_status_id && $task_assign_date && $task_deadline_date && $description) {
                // assign new task
                $newTask = new StaffTask(null, $task_assign_user_id, $task_assign_staff_id, $task_status_id, $description, $task_assign_date, $task_deadline_date);
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
        view("staff", StaffTask::get_task($id));
    }
}
