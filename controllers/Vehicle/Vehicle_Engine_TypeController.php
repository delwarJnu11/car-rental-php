<?php

class Vehicle_Engine_TypeController
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
            $engine_name = htmlspecialchars(strip_tags($_POST['vehicle_engine']));

            if ($engine_name) {
                $vehicleEngine = new VehicleEngineType(null, $engine_name);
                $result = $vehicleEngine->create_vehicle_engine_type();
                if ($result) {
                    redirect("index");
                }
            }
        }
    }

    // Edit Vehicle Type name
    function edit($id)
    {
        view("vehicle", VehicleEngineType::get_vehicle_engine_type($id));
    }

    // Update Vehicle Status
    function update()
    {
        if (isset($_POST['update'])) {
            $id = htmlspecialchars(strip_tags($_POST['id']));
            $engine_name = htmlspecialchars(strip_tags($_POST['vehicle_engine']));

            if ($id && $engine_name) {
                $vehicle_engine = new VehicleEngineType($id, $engine_name);
                $result  = $vehicle_engine->update_vehicle_engine_type();

                if ($result) {
                    redirect("index");
                }
            }
        }
    }
}
