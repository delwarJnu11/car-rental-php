<?php

class FuelController {
    //index page
    function index() {
        view("fuels");
    }

    // create a new fuel record
    function create() {
        view("fuels");
    }

    // Save Fuel Record
    function save() {
        $vehicle_id = htmlspecialchars(strip_tags($_POST['vehicle_id']));
        $fuel_type_id = htmlspecialchars(strip_tags($_POST['fuel_type_id']));
        $quantity = htmlspecialchars(strip_tags($_POST['quantity']));
        $cost_per_unit = htmlspecialchars(strip_tags($_POST['price_per_unit']));
        $station_name = htmlspecialchars(strip_tags($_POST['filling_station_name']));
        $location = htmlspecialchars(strip_tags($_POST['location']));
        $description = htmlspecialchars(strip_tags($_POST['description']));

        if ($vehicle_id && $fuel_type_id && $quantity && $cost_per_unit && $station_name && $location && $description) {
            $fuel = new Fuel(null, $vehicle_id, $_SESSION['driver_id'], $fuel_type_id, $quantity, $cost_per_unit, ($quantity * $cost_per_unit), $station_name, $location, $description);
            $fuel_id = $fuel->create();
            if ($fuel_id) {
                $expense = new Expense(null, $vehicle_id, 'fuel', ($quantity * $cost_per_unit), $description, null, $fuel_id);
                $result = $expense->create();
                if ($result) {
                    redirect('index');
                }
            }
        }
    }
}