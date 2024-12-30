<?php

class Booking {
    public $id;
    public $vehicle_id;
    public $customer_id;
    public $booking_status_id;
    public $pick_up_location;
    public $drop_off_location;
    public $journey_start_date;
    public $journey_end_date;
    public $duration;
    public $rent_amount;
    public $discount_amount;
    public $net_payable_amount;
    public $paid_amount;
    public $due_amount;
    public $driver_id;

    // constructor function
    public function __construct($id, $vehicle_id, $customer_id, $booking_status_id, $pick_up_location, $drop_off_location, $journey_start_date, $journey_end_date, $duration, $rent_amount, $discount_amount, $net_payable_amount, $paid_amount, $due_amount, $driver_id = null) {
        $this->id = $id;
        $this->vehicle_id = $vehicle_id;
        $this->customer_id = $customer_id;
        $this->booking_status_id = $booking_status_id;
        $this->pick_up_location = $pick_up_location;
        $this->drop_off_location = $drop_off_location;
        $this->journey_start_date = $journey_start_date;
        $this->journey_end_date = $journey_end_date;
        $this->duration = $duration;
        $this->rent_amount = $rent_amount;
        $this->discount_amount = $discount_amount;
        $this->net_payable_amount = $net_payable_amount;
        $this->paid_amount = $paid_amount;
        $this->due_amount = $due_amount;
        $this->driver_id = $driver_id;
    }

    // Create a New Booking
    public function create_booking() {
        global $db, $tx;
        $stmnt = $db->prepare("INSERT INTO {$tx}bookings(id, vehicle_id, customer_id, booking_status_id, pick_up_location, drop_off_location, journey_start_date, journey_end_date, duration, rent_amount, discount_amount, net_payable_amount, paid_amount, due_amount)VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmnt->bind_param("iiiisssssddddd", $this->id, $this->vehicle_id, $this->customer_id, $this->booking_status_id, $this->pick_up_location, $this->drop_off_location, $this->journey_start_date, $this->journey_end_date, $this->duration, $this->rent_amount, $this->discount_amount, $this->net_payable_amount, $this->paid_amount, $this->due_amount);
        $result = $stmnt->execute();

        if ($result) {
            return $db->insert_id;
        } else {
            return false;
        }
    }

    // Get All Bookings
    public static function get_bookings() {
        global $db, $tx;
        $stmnt = $db->prepare("SELECT b.*, v.vehicle_name, c.first_name, c.last_name, c.phone, c.email, c.image, bs.booking_status as status_name FROM {$tx}bookings b JOIN {$tx}vehicles v ON b.vehicle_id = v.id JOIN {$tx}customers c ON b.customer_id = c.id JOIN {$tx}booking_status bs ON b.booking_status_id = bs.id");
        $stmnt->execute();
        $result = $stmnt->get_result();
        if ($result) {
            $bookings = $result->fetch_all(MYSQLI_ASSOC);
            return $bookings;
        } else {
            return [];
        }
    }

    // Get Bookings by Driver ID ------ This is a Single Driver All Trips filter
    public static function get_trips_by_driver($driver_id) {
        global $db, $tx;
        $stmnt = $db->prepare("SELECT b.*, v.vehicle_name, c.first_name, c.last_name, c.phone, c.email, c.image, bs.booking_status as status_name FROM {$tx}bookings b JOIN {$tx}vehicles v ON b.vehicle_id = v.id JOIN {$tx}customers c ON b.customer_id = c.id JOIN {$tx}booking_status bs ON b.booking_status_id = bs.id WHERE b.driver_id = ?");
        $stmnt->bind_param("i", $driver_id);
        $stmnt->execute();
        $result = $stmnt->get_result();
        if ($result) {
            $trips = $result->fetch_all(MYSQLI_ASSOC);
            return $trips;
        } else {
            return [];
        }
    }

    // Get All Pending Bookings
    public static function get_pending_bookings() {
        global $db, $tx;
        $stmnt = $db->prepare("SELECT b.*, v.vehicle_name, c.first_name, c.last_name, bs.booking_status as status_name FROM {$tx}bookings b JOIN {$tx}vehicles v ON b.vehicle_id = v.id JOIN {$tx}customers c ON b.customer_id = c.id JOIN {$tx}booking_status bs ON b.booking_status_id = bs.id WHERE b.booking_status_id = 1");
        $stmnt->execute();
        $result = $stmnt->get_result();
        if ($result) {
            $pending_bookings = $result->fetch_all(MYSQLI_ASSOC);
            return $pending_bookings;
        } else {
            return [];
        }
    }

    // Get a Booking
    public static function get_booking($id) {
        global $db, $tx;
        $stmnt = $db->prepare("SELECT b.*, c.first_name, c.last_name, c.email, c.phone, c.house_no, c.road_no, c.city, c.postal_code, bs.booking_status as status_name, v.image, v.vehicle_name FROM {$tx}bookings b JOIN {$tx}vehicles v ON b.vehicle_id = v.id JOIN {$tx}customers c ON b.customer_id = c.id JOIN {$tx}booking_status bs ON b.booking_status_id = bs.id WHERE b.id = ?");
        $stmnt->bind_param("i", $id);
        $stmnt->execute();
        $result = $stmnt->get_result();
        if ($result) {
            $booking = $result->fetch_object();
            return $booking;
        } else {
            return [];
        }
    }

    // Update Booking
    public function update_booking() {
        global $db, $tx;
        $stmnt = $db->prepare("UPDATE {$tx}bookings SET vehicle_id = ?, pick_up_location = ?, drop_off_location = ?, journey_start_date = ?, journey_end_date = ?, duration = ? WHERE id = ?");
        $stmnt->bind_param("isssssi", $this->pick_up_location, $this->drop_off_location, $this->journey_start_date, $this->journey_end_date, $this->duration);
        return $stmnt->execute();
    }

    // Update Booking Status
    public static function update_booking_status($booking_status_id, $booking_id) {
        global $db, $tx;
        $stmnt = $db->prepare("UPDATE {$tx}bookings SET booking_status_id = ? WHERE id = ?");
        $stmnt->bind_param("ii", $booking_status_id, $booking_id);
        return $stmnt->execute();
    }

    // Update Booking Paid Amount and Due Amount
    public static function update_payment($paid_amount, $due_amount, $booking_id) {
        global $db, $tx;
        $stmnt = $db->prepare("UPDATE {$tx}bookings SET paid_amount = ?, due_amount = ? WHERE id = ?");
        $stmnt->bind_param("ddi", $paid_amount, $due_amount, $booking_id);
        return $stmnt->execute();
    }

    // Assign Driver to the Booking
    public static function aasign_driver($driver_id, $booking_status_id, $booking_id) {
        global $db, $tx;
        $stmnt = $db->prepare("UPDATE {$tx}bookings SET driver_id = ?, booking_status_id = ? WHERE id = ?");
        $stmnt->bind_param("iii", $driver_id, $booking_status_id, $booking_id);
        return $stmnt->execute();
    }

    // Delete Booking
    public static function delete_booking($id) {
        global $db, $tx;
        $stmnt = $db->prepare("DELETE FROM {$tx}bookings WHERE id = ?");
        $stmnt->bind_param("i", $id);
        return $stmnt->execute();
    }

    // Select All Bookings if due amount is ZERO
    public static function get_all_bookings_revenue() {
        global $tx, $db;
        $stmnt = $db->prepare("SELECT SUM(net_payable_amount) as total_revenue FROM {$tx}bookings WHERE due_amount = 0 AND created_at BETWEEN DATE_SUB(CURDATE(), INTERVAL 1 MONTH) AND CURDATE()");
        $stmnt->execute();
        $result = $stmnt->get_result();
        if ($result) {
            $revenue = $result->fetch_object();
            return $revenue->total_revenue ?? 0;
        } else {
            return null;
        }
    }

    // Get total amount sum of all bookings filter by vehicle's owner_id
    public static function get_total_revenue($owner_id) {
        global $tx, $db;
        $stmnt = $db->prepare("SELECT SUM(b.net_payable_amount) as total_revenue FROM {$tx}bookings b JOIN {$tx}vehicles v ON b.vehicle_id = v.id WHERE v.vehicle_owner_id = ?");
        $stmnt->bind_param("i", $owner_id);
        $stmnt->execute();
        $result = $stmnt->get_result();
        if ($result) {
            $total_revenue = $result->fetch_object();
            return $total_revenue->total_revenue ?? 0;
        } else {
            return null;
        }
    }

    // Get total amount sum of all bookings filter by vehicle's owner_id and day
    public static function get_total_revenue_by_day($owner_id, $days) {
        global $tx, $db;
        $stmnt = $db->prepare("SELECT SUM(b.net_payable_amount) as total_revenue FROM {$tx}bookings b JOIN {$tx}vehicles v ON b.vehicle_id = v.id WHERE v.vehicle_owner_id = ? AND b.journey_start_date BETWEEN DATE_SUB(CURDATE(), INTERVAL ? DAY) AND CURDATE()");
        $stmnt->bind_param("ii", $owner_id, $days);
        $stmnt->execute();
        $result = $stmnt->get_result();
        if ($result) {
            $total_revenue = $result->fetch_object();
            return $total_revenue->total_revenue ?? 0;
        } else {
            return null;
        }
    }

    // Get total amount sum of all bookings filter by vehicle's owner_id and day
    public static function get_total_revenue_by_date_range($owner_id, $from_date, $to_date) {
        global $tx, $db;
        $stmnt = $db->prepare("SELECT SUM(b.net_payable_amount) as total_revenue FROM {$tx}bookings b JOIN {$tx}vehicles v ON b.vehicle_id = v.id WHERE v.vehicle_owner_id = ? AND b.journey_start_date BETWEEN ? AND ?");
        $stmnt->bind_param("iss", $owner_id, $from_date, $to_date);
        $stmnt->execute();
        $result = $stmnt->get_result();
        if ($result) {
            $total_revenue = $result->fetch_object();
            return $total_revenue->total_revenue ?? 0;
        } else {
            return null;
        }
    }
}
