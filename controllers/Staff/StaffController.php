<?php

class StaffController{

    // show All Staff
    function index(){
        view("staff");
    }

    // create new Staff
    function create(){
        view("staff");
    }

    // save staff to the database
    function save(){
        if(isset($_POST['create'])){
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
            $designation_id = htmlspecialchars(strip_tags($_POST['designation_id']));
            $hire_date = htmlspecialchars(strip_tags($_POST['hire_date']));
            $salary = htmlspecialchars(strip_tags($_POST['salary']));

            $photo = $_FILES['staff_image'];

            $image = upload($photo,"img/staff");

            // Check All Requied Fields
            if($first_name && $last_name && $phone && $email && $nid && $password && $house_no && $road_no && $postal_code && $state && $city && $country && $designation_id && $hire_date && $salary && $image){
                // Create new Object
                $staffObj = new Staff(null, $first_name, $last_name, $phone, $email, $password, $nid, $image, $house_no, $road_no, $postal_code, $state, $city, $country, $designation_id, $hire_date, $salary);

                $result = $staffObj->create_staff();

                if($result){
                    redirect("index");
                }
            }

        }
    }
}