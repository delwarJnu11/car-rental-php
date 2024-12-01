<?php

class Booking_StatusController
{

    // show all Booking Status
    function index()
    {
        view("Bookings");
    }

    // create a booking status
    function create()
    {
        view("Bookings");
    }

    // save the status to the database
    function save()
    {

        if (isset($_POST['create'])) {
            $booking_status = htmlspecialchars(strip_tags($_POST['booking_status']));

            if ($booking_status) {
                $booking_status = new BookingStatus(null, $booking_status);
                $result = $booking_status->create_booking_status();
                if ($result) {
                    redirect("index");
                }
            }
        }
    }

    // Edit the status
    function edit($id)
    {
        view("Bookings", $id);
    }

    // update the status
    function update($id)
    {
        if (isset($_POST['update'])) {
            $id = $_POST['id'];
            $booking_status = $_POST['booking_status'];

            if ($id) {
                $update = new BookingStatus($id, $booking_status);
                $result = $update->update_status();
                if ($result) {
                    redirect("index");
                }
            }
        }
    }
}
