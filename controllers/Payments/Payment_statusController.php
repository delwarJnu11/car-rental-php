<?php

class Payment_statusController {
    function index() {
        view("Payments");
    }

    // create payment status
    function create() {
        view("payments");
    }

    // Save payment status to the database
    function save() {
        $payment_status = htmlspecialchars(strip_tags($_POST['payment_status_name']));
        if ($payment_status) {
            $status = new PaymentStatus(null, $payment_status);
            $result = $status->create_payment_status();

            if ($result) {
                redirect("index");
            }
        }
    }

    // Edit payment Status
    function edit($id) {
        view("payments", PaymentStatus::get_payment_status($id));
    }

    // update payment Status to the database
    function update() {
        $id = $_POST['id'];
        $status_name = htmlspecialchars(strip_tags($_POST['payment_status_name']));

        if ($id && $status_name) {
            $updated_status = new PaymentStatus($id, $status_name);
            $result = $updated_status->update_payment_status();
            if ($result) {
                redirect("index");
            }
        }
    }
}