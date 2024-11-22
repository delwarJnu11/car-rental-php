<?php

class DesignationController
{
    function index()
    {
        view("staff");
    }

    function create()
    {
        view("staff");
    }

    // save Designation
    function save()
    {
        if (isset($_POST['create'])) {
            $designation_name = htmlspecialchars(strip_tags($_POST['designation']));

            if ($designation_name) {
                $designation = new Designation(null, $designation_name);
                $result = $designation->create_designation();

                if ($result) {
                    redirect("index");
                }
            }
        }
    }

    // Edit Designation
    function edit($id)
    {
        view("staff", Designation::get_designation($id));
    }

    // Edit Designation
    function update()
    {
        if (isset($_POST['update'])) {
            $id = $_POST['id'];
            $designation_name = htmlspecialchars(strip_tags($_POST['designation']));

            if ($designation_name) {
                $designation = new Designation($id, $designation_name);
                $result = $designation->update_designation();

                if ($result) {
                    redirect("index");
                }
            }
        }
    }
}
