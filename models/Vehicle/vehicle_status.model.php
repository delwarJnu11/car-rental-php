<?php

class VehicleStatus {
    public $id;
    public $vehicle_status;

    // contructor function
    public function __construct($id, $vehicle_status) {
        $this->id = $id;
        $this->vehicle_status = $vehicle_status;
    }

    // create vehicle Status
    public function create_vehicle_status() {
        global $db, $tx;
        $stmnt = $db->prepare("INSERT INTO {$tx}vehicle_status(id, vehicle_status)VALUES(?, ?)");
        $stmnt->bind_param("is", $this->id, $this->vehicle_status);
        return $stmnt->execute();
    }

    // Get Vehicle Staus
    public static function get_all_vehicle_status() {
        global $db, $tx;
        $stmnt = $db->prepare("SELECT * FROM {$tx}vehicle_status");
        $stmnt->execute();
        $result = $stmnt->get_result();
        if ($result) {
            $vehicle_statuses = $result->fetch_all(MYSQLI_ASSOC);
            return $vehicle_statuses;
        } else {
            return [];
        }
    }

    // Get Single Vehicle Status
    public static function get_vehicle_status($field_name, $value) {
        global $db, $tx;
        $type = is_numeric($value) ? "i" : "s";
        $stmnt = $db->prepare("SELECT * FROM {$tx}vehicle_status WHERE $field_name = ?");
        $stmnt->bind_param($type, $value);
        $stmnt->execute();
        $result = $stmnt->get_result();
        if ($result) {
            $vehicle_status = $result->fetch_object();
            return $vehicle_status;
        } else {
            return [];
        }
    }

    // Update Vehicle Status
    public function update_vehicle_status() {
        global $db, $tx;
        $stmnt = $db->prepare("UPDATE {$tx}vehicle_status SET vehicle_status = ? WHERE id = ?");
        $stmnt->bind_param("si", $this->vehicle_status, $this->id);
        return $stmnt->execute();
    }

    // Delete Vehicle Status
    public static function delete_vehicle_status($id) {
        global $db, $tx;
        $stmnt = $db->prepare("DELETE FROM {$tx}vehicle_status WHERE id = ?");
        $stmnt->bind_param("i", $id);
        return $stmnt->execute();
    }
}
