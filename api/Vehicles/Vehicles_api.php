<?php

class VehiclesApi {
    // Get All Vehicles Api
    function index() {
        // Send JSON response
        header('Content-Type: application/json');

        $vehicles = Vehicle::get_vehicles();

        // check Vehicle found or not
        if ($vehicles) {
            echo json_encode([
                "success" => true,
                "message" => "Vehicles Successfully found.",
                "Status" => 200,
                "vehicles" => $vehicles,
            ]);
        } else {
            echo json_encode([
                "success" => false,
                "message" => "Vehicles not found.",
                "Status" => 404,
                "vehicles" => [],
            ]);
        }
    }

    // Get Single Vehicle Api
    function vehicle() {
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
                    "vehicle" => $vehicle,
                ]);
            } else {
                echo json_encode([
                    "success" => false,
                    "message" => "Vehicle not found.",
                    "Status" => 404,
                    "vehicles" => [],
                ]);
            }
        } else {
            echo json_encode([
                "success" => false,
                "message" => "ID not found.",
                "Status" => 404,
                "vehicle" => [],
            ]);
        }
    }

    // filter vehicle by journey Date
    function available_vehicles() {
        // Send JSON response
        header('Content-Type: application/json');

        $start_date = $_GET['start_date'];
        $end_date = $_GET['end_date'];

        $available_vehicles = Vehicle::filter_vehicle($start_date, $end_date);

        // check Vehicle found or not
        if ($available_vehicles) {
            echo json_encode([
                "success" => true,
                "message" => "Available Vehicles Successfully found.",
                "Status" => 200,
                "available_vehicles" => $available_vehicles,
            ]);
        } else {
            echo json_encode([
                "success" => false,
                "message" => "Available Vehicles not found.",
                "Status" => 404,
                "available_vehicles" => [],
            ]);
        }
    }

    // Update vehicle Status
    function update_vehicle_status() {
        $vehicle_id = $_POST['vehicle_id'];
        $vehicle_status_id = $_POST['vehicle_status_id'];
        $journey_start_date = $_POST['journey_start_date'];
        $journey_end_date = $_POST['journey_end_date'];

        echo json_encode(["success" => Vehicle::update_vehicle_status($vehicle_status_id, $journey_start_date, $journey_end_date, $vehicle_id)]);
    }
}
