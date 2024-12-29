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

    // Filter all revenue by owner_id and days
    function get_all_revenue_by_owner_filter_by_days() {
        // $owner_id = $_GET['owner_id'];
        // $days = $_GET['days'];
        $owner_id = $_POST['owner_id'];
        $days = $_POST['days'];
        if ($owner_id && $days) {
            $revenues = Payment::get_all_revenue_by_owner_filter_by_days($owner_id, $days);
            if ($revenues) {
                echo json_encode([
                    "message"  => "Revenue Foound!",
                    "status"   => 200,
                    "success"  => true,
                    "revenues" => $revenues,
                ]);
            } else {
                echo json_encode([
                    "message" => "No Revenue Found!",
                    "success" => false,
                    "status"  => 403,
                ]);
            }
        } else {
            echo json_encode([
                "message" => "Owner ID and Days are required!",
                "success" => false,
                "status"  => 403,
            ]);
        }
    }

}