<?php

class Task_statusController
{
    function index()
    {
        view("staff");
    }

    function create()
    {
        view("staff");
    }

    // save Task Status
    function save()
    {
        if (isset($_POST['create'])) {
            $task_status = htmlspecialchars(strip_tags($_POST['task_status_name']));

            if ($task_status) {
                $task_statusObj = new TaskStatus(null, $task_status);
                $result = $task_statusObj->create_task_status();

                if ($result) {
                    redirect("index");
                }
            }
        }
    }

    // Edit Task Status
    function edit($id)
    {
        view("staff", TaskStatus::get_task_status($id));
    }

    // Edit Task Status
    function update()
    {
        if (isset($_POST['update'])) {
            $id = $_POST['id'];
            $task_status = htmlspecialchars(strip_tags($_POST['task_status_name']));

            if ($task_status) {
                $taskObj = new TaskStatus($id, $task_status);
                $result = $taskObj->update_task_status();

                if ($result) {
                    redirect("index");
                }
            }
        }
    }
}
