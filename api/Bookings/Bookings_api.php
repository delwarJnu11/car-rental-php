<?php

class BookingsApi {

 // Get All Bookings Api
 function index() {
  // Send JSON response
  header('Content-Type: application/json');

  $bookings = Booking::get_bookings();

  // check Bookings found or not
  if ($bookings) {
   echo json_encode([
    "success" => true,
    "message" => "Bookings Successfully found.",
    "Status" => 200,
    "bookings" => $bookings,
   ]);
  } else {
   echo json_encode([
    "success" => false,
    "message" => "Bookings not found.",
    "Status" => 404,
    "bookings" => [],
   ]);
  }
 }

 // Get Single Booking Ai
 function booking() {
  // Send JSON response
  header('Content-Type: application/json');

  $id = isset($_GET['id']) ? $_GET['id'] : null;

  if ($id) {
   $booking = Booking::get_booking($id);
   if ($booking) {
    echo json_encode([
     "success" => true,
     "message" => "Booking successfully found.",
     "Status" => 200,
     "booking" => $booking,
    ]);
   } else {
    echo json_encode([
     "success" => false,
     "message" => "Booking not found.",
     "Status" => 404,
     "booking" => [],
    ]);
   }
  } else {
   echo json_encode([
    "success" => false,
    "message" => "ID not found.",
    "Status" => 404,
    "booking" => [],
   ]);
  }
 }

 // Assign Driver and update booking Status APi
 function assign_driver() {
  $driver_id = $_POST['driver_id'];
  $booking_status_id = $_POST['booking_status_id'];
  $booking_id = $_POST['booking_id'];

  if ($driver_id && $booking_id && $booking_status_id) {
   echo json_encode([
    "result" => Booking::aasign_driver($driver_id, $booking_status_id, $booking_id),
   ]);
  } else {
   echo json_encode([
    "message" => "Can not Assign Driver. Please provide valid information.",
    "status" => 403,
   ]);
  }
 }

}