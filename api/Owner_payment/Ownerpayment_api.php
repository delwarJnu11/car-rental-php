<?php

class OwnerPaymentApi {
    function create_owner_payment() {
        $id = $_POST['id'];
        $owner_id = $_POST['owner_id'];
        $from_date = $_POST['from_date'];
        $to_date = $_POST['to_date'];
        $revenue = $_POST['revenue'];
        $expense = $_POST['expense'];
        $total_paid = $_POST['total_paid'];

        $owner_payment = new OwnerPayment($id, $owner_id, $from_date, $to_date, $revenue, $expense, $total_paid);
        $result = $owner_payment->create_owner_payment();
        if ($result) {
            echo json_encode([
                "success" => $result,
                "status"  => 201,
            ]);
        }
    }
}