<?php

class MaintenanceStatusApi {

    // get maintenance status id by name
    function get_maintenance_status_id() {
        $status_name = $_GET['status_name'];
        if ($status_name) {
            $status = MaintenanceStatus::get_single_status_id($status_name);
            echo json_encode([
                'status'    => 200,
                'success'   => true,
                'status_id' => $status,
            ]);
        } else {
            echo json_encode([
                'status'  => 400,
                'success' => false,
                'message' => 'Status name is required',
            ]);
        }
    }
}