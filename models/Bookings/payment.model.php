<?php

class Payment {
    public $id;
    public $booking_id;
    public $customer_id;
    public $total_amount;
    public $payment_method;
    public $payment_status_id;
    public $driver_id;

    // Contructor
    public function __construct($id, $booking_id, $customer_id, $total_amount, $payment_method, $payment_status_id, $driver_id) {
        $this->id = $id;
        $this->booking_id = $booking_id;
        $this->customer_id = $customer_id;
        $this->total_amount = $total_amount;
        $this->payment_method = $payment_method;
        $this->payment_status_id = $payment_status_id;
        $this->driver_id = $driver_id;
    }

    // create a Booking Payment
    public function create_payment() {
        global $tx, $db;
        $stmnt = $db->prepare("INSERT INTO {$tx}payments(id, booking_id, customer_id, total_amount, payment_method, payment_status_id, driver_id)VALUES(?, ?, ?, ?, ?, ?, ?)");
        $stmnt->bind_param("iiidsii", $this->id, $this->booking_id, $this->customer_id, $this->total_amount, $this->payment_method, $this->payment_status_id, $this->driver_id);
        return $stmnt->execute();
    }

    // Get All Payments
    public static function get_payments() {
        global $tx, $db;
        $stmnt = $db->prepare("SELECT * FROM {$tx}payments");
        $stmnt->execute();
        $result = $stmnt->get_result();
        if ($result) {
            $payments = $result->fetch_all(MYSQLI_ASSOC);
            return $payments;
        } else {
            return [];
        }
    }

}