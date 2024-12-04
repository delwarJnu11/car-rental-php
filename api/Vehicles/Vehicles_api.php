<?php

class VehiclesApi
{
    // Get All Vehicles Api
    function index()
    {
        // Send JSON response
        header('Content-Type: application/json');

        $vehicles = Vehicle::get_vehicles();

        // check Vehicle found or not
        if ($vehicles) {
            echo json_encode([
                "success" => true,
                "message" => "Vehicles Successfully found.",
                "Status" => 200,
                "vehicles" => $vehicles
            ]);
        } else {
            echo json_encode([
                "success" => false,
                "message" => "Vehicles not found.",
                "Status" => 404,
                "vehicles" => []
            ]);
        }
    }

    // Get Single Vehicle Api
    function vehicle()
    {
        // Send JSON response
        header('Content-Type: application/json');

        $id = isset($_GET['id']) ? $_GET['id'] : null;

        if ($id) {
            $vehicle = Vehicle::get_vehicle($id);

            if ($vehicle) {
                echo json_encode([
                    "success" => true,
                    "message" => "Vehicle successfully found.",
                    "Status" => 200,
                    "vehicle" => $vehicle
                ]);
            } else {
                echo json_encode([
                    "success" => false,
                    "message" => "Vehicle not found.",
                    "Status" => 404,
                    "vehicles" => []
                ]);
            }
        } else {
            echo json_encode([
                "success" => false,
                "message" => "ID not found.",
                "Status" => 404,
                "vehicle" => []
            ]);
        }
    }
}
