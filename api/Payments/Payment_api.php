<?php

class PaymentApi {

    // Get Single Payment
    function find() {
        $id = $_POST['booking_id'];

        echo json_encode(["payment" => Payment::get_payments($id)]);
    }

    // Create Payment API
    function create() {
        $booking_id = $_POST['booking_id'];
        $customer_id = $_POST['customer_id'];
        $total_rent_amount = $_POST['total_rent_amount'];
        $paid_amount = $_POST['paid_amount'];
        $due_amount = $_POST['due_amount'];
        $driver_id = $_POST['driver_id'];

        $payment = new Payment(null, $booking_id, $customer_id, $total_rent_amount, $paid_amount, $due_amount, "Cash", 1, $driver_id);

        echo json_encode(["result" => $payment->create_payment()]);
    }

    // Update Payment
    function update_payment() {

    }
}