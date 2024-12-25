<?php

class FuelType {
    public $id;
    public $name;

    public function __construct($id, $name) {
        $this->id = $id;
        $this->name = $name;
    }

    // Create a new fuel type
    public function create() {
        global $tx, $db;
        $stmnt = $db->prepare("INSERT INTO {$tx}fuel_type (id, name) VALUES (?, ?)");
        $stmnt->bind_param("is", $this->id, $this->name);
        return $stmnt->execute();
    }

    // Get all fuel types
    public static function get_fuel_types() {
        global $tx, $db;
        $stmnt = $db->prepare("SELECT * FROM {$tx}fuel_type");
        $stmnt->execute();
        $result = $stmnt->get_result();

        if ($result) {
            $fuel_types = $result->fetch_all(MYSQLI_ASSOC);
            return $fuel_types;
        } else {
            return [];
        }
    }

    // Get fuel type by id
    public static function get_fuel_type_by_id($id) {
        global $tx, $db;
        $stmnt = $db->prepare("SELECT * FROM {$tx}fuel_type WHERE id = ?");
        $stmnt->bind_param("i", $id);
        $stmnt->execute();
        $result = $stmnt->get_result();

        if ($result) {
            $fuel_type = $result->fetch_object();
            return $fuel_type;
        } else {
            return [];
        }
    }

    // Update fuel type
    public function update_fuel_type() {
        global $tx, $db;
        $stmnt = $db->prepare("UPDATE {$tx}fuel_type SET name = ? WHERE id = ?");
        $stmnt->bind_param("si", $this->name, $this->id);
        return $stmnt->execute();
    }

    // Delete fuel type
    public static function delete_fuel_type($id) {
        global $tx, $db;
        $stmnt = $db->prepare("DELETE FROM {$tx}fuel_type WHERE id = ?");
        $stmnt->bind_param("i", $id);
        return $stmnt->execute();
    }
}