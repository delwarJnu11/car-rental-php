<?php

class MaintenanceController {

    function index() {
        view("maintenance");
    }

    // create a new maintenance
    function create() {
        view("maintenance");
    }

    // save new created maintenance
    function save() {
        $maintenance_status_id = MaintenanceStatus::get_single_status_id("Pending");
        $vehicle_id = htmlspecialchars(strip_tags($_POST['vehicle_id']));
        $cost = htmlspecialchars(strip_tags($_POST['cost']));
        $description = htmlspecialchars(strip_tags($_POST['description']));

        $maintenance = new Maintenance(null, $vehicle_id, $maintenance_status_id, $cost, $description);

        if ($maintenance->create()) {
            redirect("index");
        }
    }
}