<?php

class VehicleController{
    
    function index(){
        view("Vehicle");
    }

    function create(){
        view("Vehicle");
    }

    function save(){
        if(isset($_POST['add_vehicle'])){
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

            $isAc = $isAc === 'on' ? 1 : 0;
            echo $isAc;
            // echo $vehicle_name, $model_name, $year, $door, $seats, $luggage, $capacity, $price_per_hour, $price_per_day, $price_per_week, $discount_price, $owner_id, $vehicle_type_id, $vehicle_status_id, $vehicle_engine_id, $expiry_date, $insurance_provider, $description, $isAc;

            // Capture Photo from user
            $vehicle_photo = $_FILES['vehicle_image'];
            $vehicle_license = $_FILES['vehicle_license'];
            $vehicle_insurance = $_FILES['vehicle_insurance'];

            //Store this in Database
            $image = upload($vehicle_photo);
            $license = upload($vehicle_license);
            $insurance = upload($vehicle_insurance);

            if($vehicle_name && $model_name && $year && $door && $seats && $luggage && $capacity && $price_per_hour && $price_per_day && $price_per_week && $discount_price && $owner_id && $vehicle_type_id && $vehicle_status_id && $vehicle_engine_id && $expiry_date && $insurance_provider && $image && $license && $insurance){
                echo "Hello";
            }

            // echo "<pre>";

            // print_r($vehicle_photo);
            // print_r($vehicle_license);
            // print_r($vehicle_insurance);


        }
    }
}