<?php

class BookingController
{

    // Show All Booking
    function index()
    {
        view("Bookings");
    }

    // Create new bookings
    function create()
    {
        view("Bookings");
    }

    // save new booking to Database
    function save()
    {
        if (isset($_POST['create'])) {
            $first_name = htmlspecialchars(strip_tags($_POST['first_name']));
            $last_name = htmlspecialchars(strip_tags($_POST['last_name']));
            $phone = htmlspecialchars(strip_tags($_POST['phone']));
            $email = htmlspecialchars(strip_tags($_POST['email']));
            $nid = htmlspecialchars(strip_tags($_POST['nid']));
            $password = htmlspecialchars(strip_tags($_POST['password']));
            $house_no = htmlspecialchars(strip_tags($_POST['house_no']));
            $road_no = htmlspecialchars(strip_tags($_POST['road_no']));
            $postal_code = htmlspecialchars(strip_tags($_POST['postal_code']));
            $state = htmlspecialchars(strip_tags($_POST['state']));
            $city = htmlspecialchars(strip_tags($_POST['city']));
            $country = htmlspecialchars(strip_tags($_POST['country']));

            // image 
            $photo = $_FILES['customer_image'];

            // Booking related field
            $vehicle_id = htmlspecialchars(strip_tags($_POST['vehicle_id']));
            $booking_status_id = htmlspecialchars(strip_tags($_POST['booking_status_id']));
            $pick_up_location = htmlspecialchars(strip_tags($_POST['pick_up_location']));
            $drop_off_location = htmlspecialchars(strip_tags($_POST['drop_off_location']));
            $journey_start_date = htmlspecialchars(strip_tags($_POST['journey_start_date']));
            $journey_end_date = htmlspecialchars(strip_tags($_POST['journey_end_date']));
            $duration = htmlspecialchars(strip_tags($_POST['duration']));
            $rent_amount = htmlspecialchars(strip_tags($_POST['rent_amount']));
            $discount_amount = htmlspecialchars(strip_tags($_POST['discount_amount']));
            $net_payable_amount = htmlspecialchars(strip_tags($_POST['net_payable_amount']));
            $paid_amount = htmlspecialchars(strip_tags($_POST['paid_amount']));
            $due_amount = htmlspecialchars(strip_tags($_POST['due_amount']));

            // Search Customer in the Database
            $customer = Customer::get_customer("email", $email);

            // create customer if not exists
            if (!$customer->id) {
                $new_customer = new Customer(null, $first_name, $last_name, $phone, $email, $password, $nid, upload($photo, "img/customers"), $house_no, $road_no, $postal_code, $state, $city, $country);
                $customer_id = $new_customer->create_customer();

                if ($customer_id) {
                    $new_booking = new Booking(null, $vehicle_id, $customer_id, $booking_status_id, $pick_up_location, $drop_off_location, $journey_start_date, $journey_end_date, $duration, $rent_amount, $discount_amount, $net_payable_amount, $paid_amount, $due_amount);

                    $result = $new_booking->create_booking();

                    if ($result) {
                        redirect("index");
                    }
                }
            } else {
                $booking = new Booking(null, $vehicle_id, $customer->id,  $booking_status_id, $pick_up_location, $drop_off_location, $journey_start_date, $journey_end_date, $duration, $rent_amount, $discount_amount, $net_payable_amount, $paid_amount, $due_amount);

                $result = $booking->create_booking();

                if ($result) {
                    redirect("index");
                }
            }
        }
    }
}
