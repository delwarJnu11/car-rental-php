<?php

class Maintenance {
    public $id;
    public $vehicle_id;
    public $maintenance_status_id;
    public $cost;
    public $description;

    public function __construct($id, $vehicle_id, $maintenance_status_id, $cost, $description) {
        $this->id = $id;
        $this->vehicle_id = $vehicle_id;
        $this->maintenance_status_id = $maintenance_status_id;
        $this->cost = $cost;
        $this->description = $description;
    }

    // create a new maintenance record
    public function create() {
        global $tx, $db;
        $stmnt = $db->prepare("INSERT INTO {$tx}maintenance (id, vehicle_id, maintenance_status_id, cost, description) VALUES (?, ?, ?, ?, ?)");
        $stmnt->bind_param("iiids", $this->id, $this->vehicle_id, $this->maintenance_status_id, $this->cost, $this->description);
        return $stmnt->execute();
    }

    // Get all maintenance records
    public static function get_maintenance_records() {
        global $tx, $db;
        $stmnt = $db->prepare("SELECT m.*, v.vehicle_name, ms.name as status FROM {$tx}maintenance m JOIN {$tx}vehicles v ON m.vehicle_id = v.id JOIN {$tx}maintenance_status ms ON m.maintenance_status_id = ms.id");
        $stmnt->execute();
        $result = $stmnt->get_result();

        if ($result) {
            $maintenance_records = $result->fetch_all(MYSQLI_ASSOC);
            return $maintenance_records;
        } else {
            return [];
        }
    }

    // Get maintenance record by id
    public static function get_maintenance_record_by_id($id) {
        global $tx, $db;
        $stmnt = $db->prepare("SELECT * FROM {$tx}maintenance WHERE id = ?");
        $stmnt->bind_param("i", $id);
        $stmnt->execute();
        $result = $stmnt->get_result();

        if ($result) {
            $maintenance_record = $result->fetch_object();
            return $maintenance_record;
        } else {
            return [];
        }
    }

    // Update maintenance record
    public function update_maintenance() {
        global $tx, $db;
        $stmnt = $db->prepare("UPDATE {$tx}maintenance SET maintenance_status_id = ?, cost = ?, description = ? WHERE id = ?");
        $stmnt->bind_param("idsi", $this->maintenance_status_id, $this->cost, $this->description, $this->id);
        return $stmnt->execute();
    }

    // Delete a maintenance record
    public static function delete_maintenance($id) {
        global $tx, $db;
        $stmnt = $db->prepare("DELETE FROM {$tx}maintenance WHERE id = ?");
        $stmnt->bind_param("i", $id);
        return $stmnt->execute();
    }

}