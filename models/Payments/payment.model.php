<?php

class Payment {
    public $id;
    public $booking_id;
    public $customer_id;
    public $total_rent_amount;
    public $paid_amount;
    public $due_amount;
    public $payment_method;
    public $payment_status_id;
    public $driver_id;

    // Contructor
    public function __construct($id, $booking_id, $customer_id, $total_rent_amount, $paid_amount, $due_amount, $payment_method, $payment_status_id, $driver_id) {
        $this->id = $id;
        $this->booking_id = $booking_id;
        $this->customer_id = $customer_id;
        $this->total_rent_amount = $total_rent_amount;
        $this->paid_amount = $paid_amount;
        $this->due_amount = $due_amount;
        $this->payment_method = $payment_method;
        $this->payment_status_id = $payment_status_id;
        $this->driver_id = $driver_id;
    }

    // create a Booking Payment
    public function create_payment() {
        global $tx, $db;
        $stmnt = $db->prepare("INSERT INTO {$tx}payments(id, booking_id, customer_id, total_rent_amount, paid_amount, due_amount, payment_method, payment_status_id, driver_id)VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmnt->bind_param("iiidddsii", $this->id, $this->booking_id, $this->customer_id, $this->total_rent_amount, $this->paid_amount, $this->due_amount, $this->payment_method, $this->payment_status_id, $this->driver_id);
        return $stmnt->execute();
    }

    // Get All Payments
    public static function get_payments() {
        global $tx, $db;
        $stmnt = $db->prepare("SELECT p.*,b.vehicle_id, v.vehicle_name, c.first_name, c.last_name, ps.payment_status FROM {$tx}payments p JOIN {$tx}customers c ON p.customer_id = c.id JOIN {$tx}payment_status ps ON p.payment_status_id = ps.id JOIN {$tx}bookings b ON b.id = p.booking_id JOIN {$tx}vehicles v ON v.id = b.vehicle_id");
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