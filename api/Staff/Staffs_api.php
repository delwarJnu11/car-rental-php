<?php

class StaffsApi {

    // Get All Staffs
    function index() {
        echo json_encode(["staffs" => Staff::get_all_staff()]);
    }

    // Get All Staffs by Designation
    function get_all_staff_by_designation() {
        $designation_id = $_POST['designation_id'];
        if (!$designation_id) {
            echo json_encode([
                "staffs" => Staff::get_all_staff(),
            ]);
            return;
        } else {
            echo json_encode([
                "staffs"  => Staff::get_all_staff_by_designation($designation_id),
                "message" => "Staffs by Designation Found!",
                "error"   => false,
                "status"  => 200,
            ]);
        }
    }
}