<?php

class OwnerController
{
    // show all owners
    function index()
    {
        view("owners");
    }

    // create
    function create()
    {
        view("owners");
    }

    // save owner to the database
    function save()
    {
        if (isset($_POST['create'])) {
            $first_name = htmlspecialchars(strip_tags($_POST['first_name']));
            $last_name = htmlspecialchars(strip_tags($_POST['last_name']));
            $phone = htmlspecialchars(strip_tags($_POST['phone']));
            $email = htmlspecialchars(strip_tags($_POST['email']));
            $password = htmlspecialchars(strip_tags($_POST['password']));
            $role_id = htmlspecialchars(strip_tags($_POST['role_id']));
            $commission_rate = htmlspecialchars(strip_tags($_POST['commission_rate']));
            $commission_type_id = htmlspecialchars(strip_tags($_POST['commission_type_id']));

            $photo = $_FILES['owner_image'];
            $image_name = upload($photo, "img/users");

            if ($first_name && $last_name && $phone && $email && $password && $role_id && $commission_rate && $commission_type_id) {
                $ownerObj = new Owner(null, $first_name, $last_name, $phone, $email, password_hash($password, PASSWORD_BCRYPT), $role_id, $image_name, $commission_rate, $commission_type_id);

                $owner_id = $ownerObj->create_owner();

                if($owner_id){
                    $user = new User(null,$first_name, $last_name, $phone, $email, password_hash($password, PASSWORD_BCRYPT), $role_id, $image_name, $owner_id);
                    $user_id = $user->create_user();
                     if($owner_id && $user_id){
                        redirect("index");
                     }
                }
            }
        }
    }

    // edit owner information 
    function edit($id)
    {
        view("owners", Owner::get_owner($id));
    }

    // save the updated owner information to the database
    function update()
    {
        if (isset($_POST['update'])) {
            $id = $_POST['id'];
            $first_name = htmlspecialchars(strip_tags($_POST['first_name']));
            $last_name = htmlspecialchars(strip_tags($_POST['last_name']));
            $phone = htmlspecialchars(strip_tags($_POST['phone']));
            $email = htmlspecialchars(strip_tags($_POST['email']));
            $commission_rate = htmlspecialchars(strip_tags($_POST['commission_rate']));
            $commission_type_id = htmlspecialchars(strip_tags($_POST['commission_id']));

            if ($id) {
                $update = new Owner($id, $first_name, $last_name, $phone, $email, "",  "", "", $commission_rate, $commission_type_id);
                $result = $update->update_owner();

                if($result){
                    $res = User::update_user_from_owner($first_name, $last_name, $phone, $email, $id);

                    if($res){
                        redirect("index");
                    }
                }
            }
        }
    }

    // delete 
    function delete($id){
        view("owners", $id);
    }

    // confirm delete
    function confirm_delete($id){
        $vehicle_deleted_result = Vehicle::delete_vehicle("vehicle_owner_id", $id);
        if($vehicle_deleted_result){
            $user_deleted_result = User::delete_user("owner_id", $id);
            if($user_deleted_result){
                $result = Owner::delete_owner($id);
                if($result){
                    redirect("index");
                }
            }
        }
    }

    // cancel 
    function cancel(){
        redirect("index");
    }
}
