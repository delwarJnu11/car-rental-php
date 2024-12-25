<?php

class Fuel {
    public $id;
    public $vehicle_id;
    public $driver_id;
    public $fuel_type_id;
    public $quantity;
    public $cost_per_unit;
    public $total_cost;
    public $filling_station_name;
    public $location;
    public $description;

    public function __construct($id, $vehicle_id, $driver_id, $fuel_type_id, $quantity, $cost_per_unit, $total_cost, $filling_station_name, $location, $description) {
        $this->id = $id;
        $this->vehicle_id = $vehicle_id;
        $this->driver_id = $driver_id;
        $this->fuel_type_id = $fuel_type_id;
        $this->quantity = $quantity;
        $this->cost_per_unit = $cost_per_unit;
        $this->total_cost = $total_cost;
        $this->filling_station_name = $filling_station_name;
        $this->location = $location;
        $this->description = $description;
    }

    // create a new fuel record
    public function create() {
        global $tx, $db;
        $stmnt = $db->prepare("INSERT INTO {$tx}fuel_tracking (id, vehicle_id, driver_id, fuel_type_id, quantity, cost_per_unit, total_cost, filling_station_name, location, description) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmnt->bind_param("iiiidddsss", $this->id, $this->vehicle_id, $this->driver_id, $this->fuel_type_id, $this->quantity, $this->cost_per_unit, $this->total_cost, $this->filling_station_name, $this->location, $this->description);
        $stmnt->execute();
        return $stmnt->insert_id;
    }

    // Get all fuel records
    public static function get_fuel_records() {
        global $tx, $db;
        $stmnt = $db->prepare("SELECT f.*, v.vehicle_name, ft.name as fuel_type FROM {$tx}fuel_tracking f JOIN {$tx}vehicles v ON f.vehicle_id = v.id JOIN {$tx}fuel_type ft ON f.fuel_type_id = ft.id");
        $stmnt->execute();
        $result = $stmnt->get_result();

        if ($result) {
            $fuel_records = $result->fetch_all(MYSQLI_ASSOC);
            return $fuel_records;
        } else {
            return [];
        }
    }

    // Get fuel record by id
    public static function get_fuel_record_by_id($id) {
        global $tx, $db;
        $stmnt = $db->prepare("SELECT * FROM {$tx}fuel_tracking WHERE id = ?");
        $stmnt->bind_param("i", $id);
        $stmnt->execute();
        $result = $stmnt->get_result();

        if ($result) {
            $fuel_record = $result->fetch_object();
            return $fuel_record;
        } else {
            return [];
        }
    }

    // Get fuel records by Vehicles's Owner ID
    public static function get_fuel_records_by_owner_id($owner_id) {
        global $tx, $db;
        $stmnt = $db->prepare("SELECT f.*, v.vehicle_name, ft.name as fuel_type FROM {$tx}fuel_tracking f JOIN {$tx}vehicles v ON f.vehicle_id = v.id JOIN {$tx}fuel_type ft ON f.fuel_type_id = ft.id WHERE v.vehicle_owner_id = ?");
        $stmnt->bind_param("i", $owner_id);
        $stmnt->execute();
        $result = $stmnt->get_result();

        if ($result) {
            $fuel_records = $result->fetch_all(MYSQLI_ASSOC);
            return $fuel_records;
        } else {
            return [];
        }
    }

    // Get fuel records by Driver ID
    public static function get_fuel_records_by_driver_id($driver_id) {
        global $tx, $db;
        $stmnt = $db->prepare("SELECT f.*, v.vehicle_name, ft.name as fuel_type FROM {$tx}fuel_tracking f JOIN {$tx}vehicles v ON f.vehicle_id = v.id JOIN {$tx}fuel_type ft ON f.fuel_type_id = ft.id WHERE f.driver_id = ?");
        $stmnt->bind_param("i", $driver_id);
        $stmnt->execute();
        $result = $stmnt->get_result();

        if ($result) {
            $fuel_records = $result->fetch_all(MYSQLI_ASSOC);
            return $fuel_records;
        } else {
            return [];
        }
    }

    // Update fuel record
    public function update_fuel() {
        global $tx, $db;
        $stmnt = $db->prepare("UPDATE {$tx}fuel_tracking SET fuel_type_id = ?, quantity = ?, cost_per_unit = ?, total_cost = ?, filling_station_name = ?, location = ?, description = ? WHERE id = ?");
        $stmnt->bind_param("idddssi", $this->fuel_type_id, $this->quantity, $this->cost_per_unit, $this->total_cost, $this->filling_station_name, $this->location, $this->description, $this->id);
        return $stmnt->execute();
    }

    // Delete fuel record
    public static function delete_fuel($id) {
        global $tx, $db;
        $stmnt = $db->prepare("DELETE FROM {$tx}fuel_tracking WHERE id = ?");
        $stmnt->bind_param("i", $id);
        return $stmnt->execute();
    }
}