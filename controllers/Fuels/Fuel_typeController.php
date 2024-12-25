<?php

class Fuel_typeController {

    // index page
    function index() {
        view("fuels");
    }

    // create a new fuel type
    function create() {
        view("fuels");
    }

    // Save Fuel Type
    function save() {
        $name = htmlspecialchars(strip_tags($_POST['name']));

        if ($name) {
            $fuel_type = new FuelType(null, $name);
            $result = $fuel_type->create();
            if ($result) {
                redirect('index');
            }
        }
    }

    // Edit Fuel Type
    function edit() {
        view("fuels");
    }

    // Update Fuel Type
    function update() {
        $id = htmlspecialchars(strip_tags($_POST['id']));
        $name = htmlspecialchars(strip_tags($_POST['name']));

        if ($id && $name) {
            $fuel_type = new FuelType($id, $name);
            $result = $fuel_type->update_fuel_type();
            if ($result) {
                redirect('index');
            }
        }
    }
}