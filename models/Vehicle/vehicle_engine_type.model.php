<?php

class VehicleEngineType
{
    public $id;
    public $vehicle_engine_type;

    // contructor function
    public function __construct($id, $vehicle_engine_type)
    {
        $this->id = $id;
        $this->vehicle_engine_type = $vehicle_engine_type;
    }

    // create vehicle Engine Type
    public function create_vehicle_engine_type()
    {
        global $db, $tx;
        $stmnt = $db->prepare("INSERT INTO {$tx}vehicle_engine_types(id, vehicle_engine_type)VALUES(?, ?)");
        $stmnt->bind_param("is", $this->id, $this->vehicle_engine_type);
        return  $stmnt->execute();
    }

    // Get Vehicle Engine Types
    public static function get_all_vehicle_engine_type()
    {
        global $db, $tx;
        $stmnt = $db->prepare("SELECT * FROM {$tx}vehicle_engine_types");
        $stmnt->execute();
        $result = $stmnt->get_result();
        if ($result) {
            $vehicle_engine_types = $result->fetch_all(MYSQLI_ASSOC);
            return $vehicle_engine_types;
        } else {
            return [];
        }
    }

    // Get Single Vehicle Engine Type
    public static function get_vehicle_engine_type($id)
    {
        global $db, $tx;
        $stmnt = $db->prepare("SELECT * FROM {$tx}vehicle_engine_types WHERE id = ?");
        $stmnt->bind_param("i", $id);
        $stmnt->execute();
        $result = $stmnt->get_result();
        if ($result) {
            $vehicle_engine_type = $result->fetch_object();
            return $vehicle_engine_type;
        } else {
            return [];
        }
    }

    // Update Vehicle Engine Type
    public function update_vehicle_engine_type()
    {
        global $db, $tx;
        $stmnt = $db->prepare("UPDATE {$tx}vehicle_engine_types SET vehicle_engine_type = ? WHERE id = ?");
        $stmnt->bind_param("si", $this->vehicle_engine_type, $this->id);
        return $stmnt->execute();
    }

    // Delete Vehicle Engine Type
    public static function delete_vehicle_engine_type($id)
    {
        global $db, $tx;
        $stmnt = $db->prepare("DELETE FROM {$tx}vehicle_engine_types WHERE id = ?");
        $stmnt->bind_param("i",  $id);
        return $stmnt->execute();
    }
}
