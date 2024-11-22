<?php

class Vehicle_StatusController
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
            $status_name = htmlspecialchars(strip_tags($_POST['vehicle_status']));

            if ($status_name) {
                $vehicleStatus = new VehicleStatus(null, $status_name);
                $result = $vehicleStatus->create_vehicle_status();
                if ($result) {
                    redirect("index");
                }
            }
        }
    }

    // Edit Vehicle Type name
    function edit($id)
    {
        view("vehicle", VehicleStatus::get_vehicle_status($id));
    }

    // Update Vehicle Status
    function update()
    {
        if (isset($_POST['update'])) {
            $id = htmlspecialchars(strip_tags($_POST['id']));
            $status_name = htmlspecialchars(strip_tags($_POST['vehicle_status']));

            if ($id && $status_name) {
                $vehicle_status = new VehicleStatus($id, $status_name);
                $result  = $vehicle_status->update_vehicle_status();

                if ($result) {
                    redirect("index");
                }
            }
        }
    }
}
