<?php

class VehicleType
{
    public $id;
    public $vehicle_type_name;

    // contructor function
    public function __construct($id, $vehicle_type_name)
    {
        $this->id = $id;
        $this->vehicle_type_name = $vehicle_type_name;
    }

    // create vehicle type
    public function create_vehicle_type()
    {
        global $db, $tx;
        $stmnt = $db->prepare("INSERT INTO {$tx}vehicle_types(id, vehicle_type_name)VALUES(?, ?)");
        $stmnt->bind_param("is", $this->id, $this->vehicle_type_name);
        return  $stmnt->execute();
    }

    // Get Vehicle Types
    public static function get_vehicle_types()
    {
        global $db, $tx;
        $stmnt = $db->prepare("SELECT * FROM {$tx}vehicle_types");
        $stmnt->execute();
        $result = $stmnt->get_result();
        if ($result) {
            $vehicle_types = $result->fetch_all(MYSQLI_ASSOC);
            return $vehicle_types;
        } else {
            return [];
        }
    }

    // Get Single Vehicle Type
    public static function get_vehicle_type($id)
    {
        global $db, $tx;
        $stmnt = $db->prepare("SELECT * FROM {$tx}vehicle_types WHERE id = ?");
        $stmnt->bind_param("i", $id);
        $stmnt->execute();
        $result = $stmnt->get_result();
        if ($result) {
            $vehicle_type = $result->fetch_object();
            return $vehicle_type;
        } else {
            return [];
        }
    }

    // Update Vehicle Type
    public function update_vehicle_type()
    {
        global $db, $tx;
        $stmnt = $db->prepare("UPDATE {$tx}vehicle_types SET vehicle_type_name = ? WHERE id = ?");
        $stmnt->bind_param("si", $this->vehicle_type_name, $this->id);
        return $stmnt->execute();
    }

    // Delete Vehicle Type
    public static function delete_vehicle_type($id)
    {
        global $db, $tx;
        $stmnt = $db->prepare("DELETE FROM {$tx}vehicle_types WHERE id = ?");
        $stmnt->bind_param("i",  $id);
        return $stmnt->execute();
    }
}
