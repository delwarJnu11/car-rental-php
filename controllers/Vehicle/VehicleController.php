<?php

class VehicleController
{

    function index()
    {
        view("Vehicle");
    }

    function create()
    {
        view("Vehicle");
    }

    function save()
    {
        if (isset($_POST['add_vehicle'])) {
            $vehicle_name = htmlspecialchars(strip_tags($_POST['vehicle_name']));
            $model_name = htmlspecialchars(strip_tags($_POST['model_name']));
            $year = htmlspecialchars(strip_tags($_POST['year']));
            $door = htmlspecialchars(strip_tags($_POST['door']));
            $seats = htmlspecialchars(strip_tags($_POST['seats']));
            $luggage = htmlspecialchars(strip_tags($_POST['luggage']));
            $capacity = htmlspecialchars(strip_tags($_POST['capacity']));
            $price_per_hour = htmlspecialchars(strip_tags($_POST['price_per_hour']));
            $price_per_day = htmlspecialchars(strip_tags($_POST['price_per_day']));
            $price_per_week = htmlspecialchars(strip_tags($_POST['price_per_week']));
            $discount_price = htmlspecialchars(strip_tags($_POST['discount_price']));
            $owner_id = htmlspecialchars(strip_tags($_POST['owner_id']));
            $vehicle_type_id = htmlspecialchars(strip_tags($_POST['vehicle_type_id']));
            $vehicle_status_id = htmlspecialchars(strip_tags($_POST['vehicle_status_id']));
            $vehicle_engine_id = htmlspecialchars(strip_tags($_POST['vehicle_engine_id']));
            $expiry_date = htmlspecialchars(strip_tags($_POST['expiry_date']));
            $insurance_provider = htmlspecialchars(strip_tags($_POST['insurance_provider']));
            $description = htmlspecialchars(strip_tags($_POST['description']));
            $isAc = htmlspecialchars(strip_tags($_POST['isAc']));

            // convert isAc value as Integer
            $isAc = $isAc === 'on' ? 1 : 0;

            // Capture Photo from user
            $vehicle_photo = $_FILES['vehicle_image'];
            $vehicle_license = $_FILES['vehicle_license'];
            $vehicle_insurance = $_FILES['vehicle_insurance'];

            //Store this in Database
            $image = upload($vehicle_photo);
            $license = upload($vehicle_license);
            $insurance = upload($vehicle_insurance);

            // check all required fields
            if ($vehicle_name && $model_name && $year && $door && $seats && $luggage && $capacity && $price_per_hour && $price_per_day && $price_per_week && $discount_price && $owner_id && $vehicle_type_id && $vehicle_status_id && $vehicle_engine_id && $expiry_date && $insurance_provider && $image && $license && $insurance) {
                // Create vehicle Object
                $new_vehicle = new Vehicle(null, $vehicle_name, $model_name, $year, $door, $seats, $capacity, $luggage, $description, $price_per_hour, $price_per_day, $price_per_week, $discount_price, $image, $license, $insurance, $expiry_date, $insurance_provider,  $isAc, $owner_id, $vehicle_type_id, $vehicle_status_id, $vehicle_engine_id);
                $result = $new_vehicle->create_vehicle();
                // success result
                if ($result) {
                    redirect("index");
                }
            }

            // echo "<pre>";

            // print_r($vehicle_photo);
            // print_r($vehicle_license);
            // print_r($vehicle_insurance);


        }
    }
}
