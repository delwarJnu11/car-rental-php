<?php

class Salary_statusController
{
    function index()
    {
        view("staff");
    }

    function create()
    {
        view("staff");
    }

    // save Salary Status
    function save()
    {
        if (isset($_POST['create'])) {
            $salary_status = htmlspecialchars(strip_tags($_POST['salary_status_name']));

            if ($salary_status) {
                $salary_statusObj = new SalaryStatus(null, $salary_status);
                $result = $salary_statusObj->create_salary_status();

                if ($result) {
                    redirect("index");
                }
            }
        }
    }

    // Edit Salary Status
    function edit($id)
    {
        view("staff", SalaryStatus::get_salary_status($id));
    }

    // Edit Salary Status
    function update()
    {
        if (isset($_POST['update'])) {
            $id = $_POST['id'];
            $salary_status = htmlspecialchars(strip_tags($_POST['salary_status_name']));

            if ($salary_status) {
                $status = new SalaryStatus($id, $salary_status);
                $result = $status->update_salary_status();

                if ($result) {
                    redirect("index");
                }
            }
        }
    }
}
