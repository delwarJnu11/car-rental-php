<?php

class Maintenance_statusController {

    function index() {
        view("maintenance");
    }

    // create a new maintenance status
    function create() {
        view("maintenance");
    }

    // Save Maintenance Status
    function save() {
        $name = htmlspecialchars(strip_tags($_POST['name']));

        if ($name) {
            $maintenance_status = new MaintenanceStatus(null, $name);
            $result = $maintenance_status->create_status();
            if ($result) {
                redirect('index');
            }
        }
    }

    // Edit Maintenance Status
    function edit() {
        view("maintenance");
    }

    // Update Maintenance Status
    function update() {
        $id = htmlspecialchars(strip_tags($_POST['id']));
        $name = htmlspecialchars(strip_tags($_POST['name']));

        if ($id && $name) {
            $maintenance_status = new MaintenanceStatus($id, $name);
            $result = $maintenance_status->update_status();
            if ($result) {
                redirect('index');
            }
        }
    }
}