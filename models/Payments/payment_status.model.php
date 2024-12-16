<?php

class PaymentStatus {
    public $id;
    public $payment_status;

    // constructor function
    public function __construct($id, $payment_status) {
        $this->id = $id;
        $this->payment_status = $payment_status;
    }

    // Create payment Status
    public function create_payment_status() {
        global $db, $tx;
        $stmnt = $db->prepare("INSERT INTO {$tx}payment_status(id, payment_status)VALUES(?, ?)");
        $stmnt->bind_param("is", $this->id, $this->payment_status);
        return $stmnt->execute();
    }

    // Get All payment Status
    public static function get_all_payment_status() {
        global $db, $tx;
        $stmnt = $db->prepare("SELECT * FROM {$tx}payment_status");
        $stmnt->execute();
        $result = $stmnt->get_result();
        if ($result) {
            $all_payment_status = $result->fetch_all(MYSQLI_ASSOC);
            return $all_payment_status;
        } else {
            return [];
        }
    }

    // Filter Payment Staus ID By status name
    public static function get_status_id($status_name) {
        global $db, $tx;
        $stmnt = $db->prepare("SELECT id FROM {$tx}payment_status WHERE payment_status = ?");
        $stmnt->bind_param("s", $status_name);
        $stmnt->execute();
        $result = $stmnt->get_result();
        if ($result) {
            $status = $result->fetch_object();
            return $status->id;
        } else {
            return null;
        }
    }

    // Get Signle payment Status
    public static function get_payment_status($id) {
        global $db, $tx;
        $stmnt = $db->prepare("SELECT * FROM {$tx}payment_status WHERE id = ?");
        $stmnt->bind_param("i", $id);
        $stmnt->execute();
        $result = $stmnt->get_result();
        if ($result) {
            $payment_status = $result->fetch_object();
            return $payment_status;
        } else {
            return [];
        }
    }

    // Update payment Status
    public function update_payment_status() {
        global $db, $tx;
        $stmnt = $db->prepare("UPDATE {$tx}payment_status SET payment_status = ? WHERE id = ?");
        $stmnt->bind_param("si", $this->payment_status, $this->id);
        return $stmnt->execute();
    }

    // Delete payment Status
    public static function delete_payment_status($id) {
        global $db, $tx;
        $stmnt = $db->prepare("DELETE FROM {$tx}payment_status WHERE id = ?");
        $stmnt->bind_param("i", $id);
        return $stmnt->execute();
    }
}