<?php

class MaintenanceStatus {
    public $id;
    public $name;

    public function __construct($id, $name) {
        $this->id = $id;
        $this->name = $name;
    }

    // create a new maintenance status
    public function create_status() {
        global $tx, $db;
        $stmnt = $db->prepare("INSERT INTO {$tx}maintenance_status (name) VALUES (?)");
        $stmnt->bind_param("s", $this->name);
        return $stmnt->execute();
    }

    // get all maintenance status
    public static function get_all_status() {
        global $tx, $db;
        $stmnt = $db->prepare("SELECT * FROM {$tx}maintenance_status");
        $stmnt->execute();
        $result = $stmnt->get_result();
        if ($result) {
            $all_status = $result->fetch_all(MYSQLI_ASSOC);
            return $all_status;
        } else {
            return [];
        }
    }

    // Get a single maintenance status
    public static function get_single_status($field_name, $value) {
        global $tx, $db;
        $type = is_numeric($value) ? "i" : "s";
        $stmnt = $db->prepare("SELECT * FROM {$tx}maintenance_status WHERE $field_name = ?");
        $stmnt->bind_param($type, $value);
        $stmnt->execute();
        $result = $stmnt->get_result();
        if ($result) {
            $status = $result->fetch_assoc();
            return $status;
        } else {
            return [];
        }
    }

    // Get a single maintenance status id By name
    public static function get_single_status_id($name) {
        global $tx, $db;
        $stmnt = $db->prepare("SELECT id FROM {$tx}maintenance_status WHERE name = ?");
        $stmnt->bind_param("s", $name);
        $stmnt->execute();
        $result = $stmnt->get_result();
        if ($result) {
            $status = $result->fetch_assoc();
            return $status['id'];
        } else {
            return [];
        }
    }

    // Update a maintenance status
    public function update_status() {
        global $tx, $db;
        $stmnt = $db->prepare("UPDATE {$tx}maintenance_status SET name = ? WHERE id = ?");
        $stmnt->bind_param("si", $this->name, $this->id);
        return $stmnt->execute();
    }

    // Delete a maintenance status
    public static function delete_status($id) {
        global $tx, $db;
        $stmnt = $db->prepare("DELETE FROM {$tx}maintenance_status WHERE id = ?");
        $stmnt->bind_param("i", $id);
        return $stmnt->execute();
    }
}