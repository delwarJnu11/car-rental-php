<?php

class PaymentApi {

    // Get Single Payment
    function find() {
        $id = $_POST['booking_id'];

        echo json_encode(["payment" => Payment::get_payments($id)]);
    }

    // Update Payment
    function update_payment() {

    }
}