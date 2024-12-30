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

    // Get Total amount sum of all expenses
    public static function total_expense_amount() {
        global $tx, $db;
        $stmnt = $db->prepare("SELECT SUM(amount) as total_amount FROM {$tx}expenses WHERE created_at BETWEEN DATE_SUB(CURDATE(), INTERVAL 1 MONTH) AND CURDATE()");
        $stmnt->execute();
        $result = $stmnt->get_result();

        if ($result) {
            $total_expense = $result->fetch_object();
            return $total_expense->total_amount ?? 0;
        } else {
            return null;
        }
    }

    // Get total amount sum of all expenses filter by vehicle's owner_id
    public static function get_total_expense_amount($owner_id) {
        global $tx, $db;
        $stmnt = $db->prepare("SELECT SUM(e.amount) as total_amount FROM {$tx}expenses e JOIN {$tx}vehicles v ON e.vehicle_id = v.id WHERE v.vehicle_owner_id = ?");
        $stmnt->bind_param("i", $owner_id);
        $stmnt->execute();
        $result = $stmnt->get_result();

        if ($result) {
            $total_expense = $result->fetch_object();
            return $total_expense->total_amount ?? 0;
        } else {
            return null;
        }
    }

    // Get total amount sum of all expenses filter by vehicle's owner_id and day
    public static function filter_total_expense_amount($owner_id, $days) {
        global $tx, $db;
        $stmnt = $db->prepare("SELECT SUM(e.amount) as total_amount FROM {$tx}expenses e JOIN {$tx}vehicles v ON e.vehicle_id = v.id WHERE v.vehicle_owner_id = ? AND e.created_at BETWEEN DATE_SUB(CURDATE(), INTERVAL ? DAY) AND CURDATE()");
        $stmnt->bind_param("ii", $owner_id, $days);
        $stmnt->execute();
        $result = $stmnt->get_result();

        if ($result) {
            $total_expense = $result->fetch_object();
            return $total_expense->total_amount ?? 0;
        } else {
            return null;
        }
    }

    // Get All Expenses By specific Owner
    public static function filter_expenses_by_owner($owner_id) {
        global $tx, $db;
        $stmnt = $db->prepare("SELECT e.*, v.vehicle_name FROM {$tx}expenses e JOIN {$tx}vehicles v ON v.id = e.vehicle_id WHERE v.vehicle_owner_id = ?");
        $stmnt->bind_param("i", $owner_id);
        $stmnt->execute();
        $result = $stmnt->get_result();
        if ($result) {
            $expenses = $result->fetch_all(MYSQLI_ASSOC);
            return $expenses;
        } else {
            return [];
        }
    }

    // Get All Expenses By specific Owner and Filter by date
    public static function filter_expenses_by_owner_and_date($owner_id, $days) {
        global $tx, $db;
        $stmnt = $db->prepare("SELECT e.*, v.vehicle_name FROM {$tx}expenses e JOIN {$tx}vehicles v ON v.id = e.vehicle_id WHERE v.vehicle_owner_id = ? AND e.created_at BETWEEN DATE_SUB(CURDATE(), INTERVAL ? DAY) AND CURDATE()");
        $stmnt->bind_param("ii", $owner_id, $days);
        $stmnt->execute();
        $result = $stmnt->get_result();
        if ($result) {
            $expenses = $result->fetch_all(MYSQLI_ASSOC);
            return $expenses;
        } else {
            return [];
        }
    }

    // Get All Expenses By specific Owner and Filter by date Range
    public static function filter_expenses_by_owner_date_range($owner_id, $from_date, $to_date) {
        global $tx, $db;
        $stmnt = $db->prepare("SELECT SUM(e.amount) AS total_expense FROM {$tx}expenses e
        JOIN {$tx}vehicles v ON v.id = e.vehicle_id
        WHERE v.vehicle_owner_id = ?
          AND e.created_at BETWEEN ? AND ?");
        $stmnt->bind_param("iss", $owner_id, $from_date, $to_date);
        $stmnt->execute();
        $result = $stmnt->get_result();
        if ($result) {
            $expenses = $result->fetch_object();
            return $expenses->total_expense ?? 0;
        } else {
            return [];
        }
    }
}