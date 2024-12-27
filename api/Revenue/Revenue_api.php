<?php

class RevenueApi {
    function get_all_revenue_by_owner() {
        $owner_id = $_POST['owner_id'];
        if ($owner_id) {
            echo json_encode([
                "message"  => "Revenue Foound!",
                "status"   => 200,
                "success"  => true,
                "revenues" => Payment::get_all_revenue_by_owner($owner_id),
            ]);
        } else {
            echo json_encode([
                "message" => "Owner ID is required!",
                "success" => false,
                "status"  => 403,
            ]);
        }
    }
}