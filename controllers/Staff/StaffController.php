<?php

class StaffController {

    // show All Staff
    function index() {
        view("staff");
    }

    // create new Staff
    function create() {
        view("staff");
    }

    // save staff to the database
    function save() {
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
            $designation_id = htmlspecialchars(strip_tags($_POST['designation_id']));
            $hire_date = htmlspecialchars(strip_tags($_POST['hire_date']));
            $salary = htmlspecialchars(strip_tags($_POST['salary']));

            $photo = $_FILES['staff_image'];
            $image_name = upload($photo, "img/staff");

            // Check All Requied Fields
            if ($first_name && $last_name && $phone && $email && $nid && $password && $house_no && $road_no && $postal_code && $state && $city && $country && $designation_id && $hire_date && $salary) {
                // Create new Object
                $staffObj = new Staff(null, $first_name, $last_name, $phone, $email, password_hash($password, PASSWORD_BCRYPT), $nid, $image_name, $house_no, $road_no, $postal_code, $state, $city, $country, $designation_id, $hire_date, $salary);

                $staff_id = $staffObj->create_staff();

                $designation = Designation::get_designation($designation_id);

                $role = Role::find("role_name", $designation->designation_name);

                // echo "<pre>";
                // print_r($designation);
                // die();

                if ($designation->designation_name == "Driver" || $designation->designation_name == "Manager" || $designation->designation_name == "Admin") {
                    $driver_as_user = new User(null, $first_name, $last_name, $phone, $email, password_hash($password, PASSWORD_BCRYPT), $role->id, $image_name, 0, $staff_id);
                    $res = $driver_as_user->create_user();

                    if ($staff_id && $res) {
                        redirect("index");
                    }
                } else {
                    if ($staff_id) {
                        redirect("index");
                    }
                }

            }
        }
    }

    // Edit Staff
    function edit($id) {
        view("staff", Staff::get_staff($id));
    }

    /**
     * TODO:
     * Updatae the user when update staff if staff designation is Driver
     * Dynamic image path in the dashboard user path okay but staff and owner image path is not okay.
     */

    // Update Staff
    function update() {
        if (isset($_POST['update'])) {
            $id = $_POST['id'];
            $first_name = htmlspecialchars(strip_tags($_POST['first_name']));
            $last_name = htmlspecialchars(strip_tags($_POST['last_name']));
            $phone = htmlspecialchars(strip_tags($_POST['phone']));
            $email = htmlspecialchars(strip_tags($_POST['email']));
            $house_no = htmlspecialchars(strip_tags($_POST['house_no']));
            $road_no = htmlspecialchars(strip_tags($_POST['road_no']));
            $postal_code = htmlspecialchars(strip_tags($_POST['postal_code']));
            $state = htmlspecialchars(strip_tags($_POST['state']));
            $city = htmlspecialchars(strip_tags($_POST['city']));
            $country = htmlspecialchars(strip_tags($_POST['country']));
            $designation_id = htmlspecialchars(strip_tags($_POST['designation_id']));
            $salary = htmlspecialchars(strip_tags($_POST['salary']));

            // Check All Requied Fields
            if ($first_name && $last_name && $phone && $email && $house_no && $road_no && $postal_code && $state && $city && $country && $designation_id && $salary) {
                // Create new Object
                $staffObj = new Staff($id, $first_name, $last_name, $phone, $email, "", "", "", $house_no, $road_no, $postal_code, $state, $city, $country, $designation_id, "", $salary);

                $result = $staffObj->update_staff();

                if ($result) {
                    redirect("index");
                }
            }
        }
    }

    // Delete
    function delete($id) {
        view("staff", $id);
    }

    //Confirm Delete
    function confirm_delete($id) {
        if ($id) {
            $result = Staff::delete_staff($id);
            if ($result) {
                redirect("index");
            }
        }
    }

    // cancel
    function cancel() {
        redirect("index");
    }

    // filter Trips by driver id
    function trips() {
        view("staff");
    }
}
