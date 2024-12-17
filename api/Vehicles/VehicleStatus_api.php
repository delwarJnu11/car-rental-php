<?php

class VehicleStatusApi {

    // Get Single Vehicle Status
    function find_status() {
        $field_name = $_GET['field_name'];
        $value = $_GET['value'];

        echo json_encode(["success" => VehicleStatus::get_vehicle_status($field_name, $value)]);
    }

}