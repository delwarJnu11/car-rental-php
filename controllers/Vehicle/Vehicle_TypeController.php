<?php

class Vehicle_TypeController
{

    // show all vehicle types
    function index()
    {
        view("vehicle");
    }

    // Create vehicle type
    function create()
    {
        view("vehicle");
    }

    // save the vehicle type
    function save()
    {
        if (isset($_POST['create'])) {
            $type_name = htmlspecialchars(strip_tags($_POST['vehicle_type']));

            if ($type_name) {
                $vehicleType = new VehicleType(null, $type_name);
                $result = $vehicleType->create_vehicle_type();
                if ($result) {
                    redirect("index");
                }
            }
        }
    }

    // Edit Vehicle Type name
    function edit($id)
    {
        view("vehicle", VehicleType::get_vehicle_type($id));
    }

    // Update Vehicle Type
    function update()
    {
        if (isset($_POST['update'])) {
            $id = htmlspecialchars(strip_tags($_POST['id']));
            $type_name = htmlspecialchars(strip_tags($_POST['vehicle_type']));

            if ($id && $type_name) {
                $vehicle_type = new VehicleType($id, $type_name);
                $result  = $vehicle_type->update_vehicle_type();

                if ($result) {
                    redirect("index");
                }
            }
        }
    }
}
