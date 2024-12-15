<?php

class BookingStatus {
    public $id;
    public $booking_status;

    // constructor
    public function __construct($id, $booking_status) {
        $this->id = $id;
        $this->booking_status = $booking_status;
    }

    // create booking Status
    public function create_booking_status() {
        global $db, $tx;
        $stmnt = $db->prepare("INSERT INTO {$tx}booking_status(id, booking_status)VALUES(?, ?)");
        $stmnt->bind_param("is", $this->id, $this->booking_status);
        return $stmnt->execute();
    }

    // Get all booking Status
    public static function get_all_booking_status() {
        global $db, $tx;
        $stmnt = $db->prepare("SELECT * FROM {$tx}booking_status");
        $stmnt->execute();
        $result = $stmnt->get_result();
        if ($result) {
            $all_status = $result->fetch_all(MYSQLI_ASSOC);
            return $all_status;
        } else {
            return [];
        }
    }

    // Get booking Status
    public static function get_booking_status($field_name, $value) {
        global $db, $tx;
        $type = is_numeric($value) ? "i" : "s";
        $stmnt = $db->prepare("SELECT * FROM {$tx}booking_status WHERE $field_name = ?");
        $stmnt->bind_param($type, $value);
        $stmnt->execute();
        $result = $stmnt->get_result();
        if ($result) {
            $status = $result->fetch_object();
            return $status;
        } else {
            return [];
        }
    }

    // Update Booking status
    public function update_status() {
        global $db, $tx;
        $stmnt = $db->prepare("UPDATE {$tx}booking_status SET booking_status = ? WHERE id = ?");
        $stmnt->bind_param("si", $this->booking_status, $this->id);
        return $stmnt->execute();
    }

    // Delete Booking Status
    public static function delete_status($id) {
        global $db, $tx;
        $stmnt = $db->prepare("DELETE FROM {$tx}booking_status WHERE id = ?");
        $stmnt->bind_param("i", $id);
        return $stmnt->execute();
    }
}
