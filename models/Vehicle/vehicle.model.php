<?php

class Vehicle
{
    public $id;
    public $vehicle_name;
    public $model;
    public $year;
    public $license_no;
    public $door;
    public $seats;
    public $capacity;
    public $luggage_capacity;
    public $description;
    public $price_per_hour;
    public $price_per_day;
    public $price_per_week;
    public $discount_price;
    public $image;
    public $vehicle_licence_documents;
    public $vehicle_insurance_documents;
    public $expiry_date;
    public $insurance_provider;
    public $is_ac;
    public $vehicle_owner_id;
    public $vehicle_type_id;
    public $vehicle_status_id;
    public $vehicle_engine_type_id;

    public function __construct($id, $vehicle_name, $model, $year, $license_no, $door, $seats, $capacity, $luggage_capacity, $description, $price_per_hour, $price_per_day, $price_per_week, $discount_price, $image, $vehicle_licence_documents, $vehicle_insurance_documents, $expiry_date, $insurance_provider, $is_ac, $vehicle_owner_id, $vehicle_type_id, $vehicle_status_id, $vehicle_engine_type_id)
    {
        $this->id = $id;
        $this->vehicle_name = $vehicle_name;
        $this->model = $model;
        $this->year = $year;
        $this->license_no = $license_no;
        $this->door = $door;
        $this->seats = $seats;
        $this->capacity = $capacity;
        $this->luggage_capacity = $luggage_capacity;
        $this->description = $description;
        $this->price_per_hour = $price_per_hour;
        $this->price_per_day = $price_per_day;
        $this->price_per_week = $price_per_week;
        $this->discount_price = $discount_price;
        $this->image = $image;
        $this->vehicle_licence_documents = $vehicle_licence_documents;
        $this->vehicle_insurance_documents = $vehicle_insurance_documents;
        $this->expiry_date = $expiry_date;
        $this->insurance_provider = $insurance_provider;
        $this->is_ac = $is_ac;
        $this->vehicle_owner_id = $vehicle_owner_id;
        $this->vehicle_type_id = $vehicle_type_id;
        $this->vehicle_status_id = $vehicle_status_id;
        $this->vehicle_engine_type_id = $vehicle_engine_type_id;
    }

    // create Vehicle
    public function create_vehicle()
    {
        global $db, $tx;
        $stmnt = $db->prepare("INSERT INTO {$tx}vehicles(id, vehicle_name, model, year, license_no, door, seats, capacity, luggage_capacity, description, price_per_hour, price_per_day, price_per_week, discount_price, image, vehicle_licence_documents, vehicle_insurance_documents, expiry_date, insurance_provider, is_ac, vehicle_owner_id, vehicle_type_id, vehicle_status_id, vehicle_engine_type_id)VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmnt->bind_param("isssssssssddddsssssiiiii", $this->id, $this->vehicle_name, $this->model, $this->year, $this->license_no, $this->door, $this->seats, $this->capacity, $this->luggage_capacity, $this->description, $this->price_per_hour, $this->price_per_day, $this->price_per_week, $this->discount_price, $this->image, $this->vehicle_licence_documents, $this->vehicle_insurance_documents, $this->expiry_date, $this->insurance_provider, $this->is_ac, $this->vehicle_owner_id, $this->vehicle_type_id, $this->vehicle_status_id, $this->vehicle_engine_type_id);
        return $stmnt->execute();
    }

    // Get all Vehicles
    public static function get_vehicles()
    {
        global $db, $tx;
        $stmnt = $db->prepare("SELECT v.*, vt.vehicle_type_name, vs.vehicle_status, vet.vehicle_engine_type as engine_type FROM {$tx}vehicles v JOIN {$tx}vehicle_types vt ON v.vehicle_type_id = vt.id JOIN {$tx}vehicle_status vs ON v.vehicle_status_id = vs.id JOIN {$tx}vehicle_engine_types vet ON v.vehicle_engine_type_id = vet.id");
        $stmnt->execute();
        $result = $stmnt->get_result();
        if ($result) {
            $vehicles = $result->fetch_all(MYSQLI_ASSOC);
            return $vehicles;
        } else {
            return [];
        }
    }

    // Get Single Vehicle
    public static function get_vehicle($id)
    {
        global $db, $tx;
        $stmnt = $db->prepare("SELECT * FROM {$tx}vehicles WHERE id = ?");
        $stmnt->bind_param("i", $id);
        $stmnt->execute();
        $result = $stmnt->get_result();
        if ($result) {
            $vehicle = $result->fetch_object();
            return $vehicle;
        } else {
            return [];
        }
    }

    // Update Vehicle
    public function update_vehicle()
    {
        global $db, $tx;
        $stmnt = $db->prepare("UPDATE {$tx}vehicles SET vehicle_name = ?, model = ?, year = ?, seats = ?, capacity = ?, luggage_capacity = ?, description = ?, price_per_hour = ?, price_per_day = ?, price_per_week = ?, discount_price = ?, expiry_date = ?, insurance_provider = ?, vehicle_owner_id = ?, vehicle_status_id = ? WHERE id = ?");
        $stmnt->bind_param("sssssssddddssiii", $this->vehicle_name, $this->model, $this->year, $this->seats, $this->capacity, $this->luggage_capacity, $this->description, $this->price_per_hour, $this->price_per_day, $this->price_per_week, $this->discount_price, $this->expiry_date, $this->insurance_provider, $this->vehicle_owner_id, $this->vehicle_status_id, $this->id);
        return $stmnt->execute();
    }

    // Delete Vehicle
    public static function delete_vehicle($id)
    {
        global $db, $tx;
        $stmnt = $db->prepare("DELETE FROM {$tx}vehicles WHERE id = ?");
        $stmnt->bind_param("i", $id);
        return $stmnt->execute();
    }
}
