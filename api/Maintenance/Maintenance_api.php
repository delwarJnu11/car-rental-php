<?php

class MaintenanceApi {
    // update maintenance status
    function update_maintenance_status() {
        $maintenance_id = $_POST['maintenance_id'];
        $status_id = $_POST['status_id'];

        if ($maintenance_id && $status_id) {
            $result = Maintenance::update_maintenance_status($maintenance_id, $status_id);
            if ($result) {
                echo json_encode([
                    'status'  => 200,
                    'success' => true,
                    'message' => 'Maintenance status updated successfully',
                ]);
            } else {
                echo json_encode([
                    'status'  => 500,
                    'success' => false,
                    'message' => 'Failed to update maintenance status',
                ]);
            }
        } else {
            echo json_encode([
                'status'  => 400,
                'success' => false,
                'message' => 'Maintenance ID and Status ID are required',
            ]);
        }
    }
}