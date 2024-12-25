<?php

class Expense {
    public $id;
    public $vehicle_id;
    public $maintenance_id;
    public $fuel_tracking_id;
    public $expense_type;
    public $amount;
    public $description;

    public function __construct($id, $vehicle_id, $expense_type, $amount, $description, $maintenance_id = null, $fuel_tracking_id = null, ) {
        $this->id = $id;
        $this->vehicle_id = $vehicle_id;
        $this->expense_type = $expense_type;
        $this->amount = $amount;
        $this->description = $description;
        $this->maintenance_id = $maintenance_id;
        $this->fuel_tracking_id = $fuel_tracking_id;
    }

    // create a new expense record
    public function create() {
        global $tx, $db;
        $stmnt = $db->prepare("INSERT INTO {$tx}expenses (id, vehicle_id, maintenance_id, fuel_tracking_id, expense_type, amount, description) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmnt->bind_param("iiiisds", $this->id, $this->vehicle_id, $this->maintenance_id, $this->fuel_tracking_id, $this->expense_type, $this->amount, $this->description);
        return $stmnt->execute();
    }

    // Get all expense records
    public static function get_expense_records() {
        global $tx, $db;
        $stmnt = $db->prepare("SELECT e.*, v.vehicle_name FROM {$tx}expenses e JOIN {$tx}vehicles v ON e.vehicle_id = v.id");
        $stmnt->execute();
        $result = $stmnt->get_result();

        if ($result) {
            $expense_records = $result->fetch_all(MYSQLI_ASSOC);
            return $expense_records;
        } else {
            return [];
        }
    }

    // Get expense record by id
    public static function get_expense_record_by_id($id) {
        global $tx, $db;
        $stmnt = $db->prepare("SELECT * FROM {$tx}expenses WHERE id = ?");
        $stmnt->bind_param("i", $id);
        $stmnt->execute();
        $result = $stmnt->get_result();

        if ($result) {
            $expense_record = $result->fetch_object();
            return $expense_record;
        } else {
            return null;
        }
    }

    // Get total amount sum of all expenses filter by vehicle's owner_id
    public static function get_total_expense_amount($owner_id) {
        global $tx, $db;
        $stmnt = $db->prepare("SELECT SUM(e.amount) as total_amount FROM {$tx}expenses e JOIN {$tx}vehicles v ON e.vehicle_id = v.id WHERE v.owner_id = ?");
        $stmnt->bind_param("i", $owner_id);
        $stmnt->execute();
        $result = $stmnt->get_result();

        if ($result) {
            $total_expense = $result->fetch_object();
            return $total_expense;
        } else {
            return null;
        }
    }
}