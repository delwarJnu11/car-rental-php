<?php

class Commission_typeController
{

    // Show all commission Types
    function index()
    {
        view("owners");
    }

    // create 
    function create()
    {
        view("owners");
    }

    // save
    function save()
    {
        if (isset($_POST['create'])) {
            $type_name = htmlspecialchars(strip_tags($_POST['commission_type']));
            if ($type_name) {
                $commission_type = new CommissionType(null, $type_name);
                $result = $commission_type->create_commission_type();
                if ($result) {
                    redirect("index");
                }
            }
        }
    }

    // Edit 
    function edit($id)
    {
        view("owners", CommissionType::get_commission_type($id));
    }

    // update
    function update()
    {
        if (isset($_POST['update'])) {
            $id = $_POST['id'];
            $type_name = htmlspecialchars(strip_tags($_POST['commission_type']));
            if ($type_name) {
                $update_type = new CommissionType($id, $type_name);
                $result = $update_type->update_commission_type();
                if ($result) {
                    redirect("index");
                }
            }
        }
    }
}
