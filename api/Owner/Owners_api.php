<?php

class OwnersApi {
    function get_owner() {
        $owner_id = $_POST['owner_id'];

        if ($owner_id) {
            $owner = Owner::get_owner($owner_id);
            if ($owner) {
                echo json_encode([
                    "message" => "Owner Found",
                    "status"  => 200,
                    "success" => true,
                    "owner"   => $owner,
                ]);
            } else {
                echo json_encode([
                    "message" => "Owner Not Found",
                    "status"  => 404,
                    "success" => false,
                    "owner"   => null,
                ]);
            }

        } else {
            echo json_encode([
                "message" => "Owner ID Required",
                "status"  => 403,
                "success" => false,
                "owner"   => null,
            ]);
        }
    }
}