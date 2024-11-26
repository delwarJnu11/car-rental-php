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
                $newUser = new User(null, $first_name, $last_name, $phone, $email, password_hash($password, PASSWORD_BCRYPT), $role_id, $image_name);
                $user_id = $newUser->create_user();
                if ($user_id) {
                    $owner = new Owner(null, $user_id, $commission_rate, $commission_type_id);
                    $result = $owner->create_owner();
                    if ($result) {
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
            $user_id = $_POST['user_id'];
            $first_name = htmlspecialchars(strip_tags($_POST['first_name']));
            $last_name = htmlspecialchars(strip_tags($_POST['last_name']));
            $phone = htmlspecialchars(strip_tags($_POST['phone']));
            $email = htmlspecialchars(strip_tags($_POST['email']));
            $commission_rate = htmlspecialchars(strip_tags($_POST['commission_rate']));
            $commission_type_id = htmlspecialchars(strip_tags($_POST['commission_id']));

            if ($id && $user_id) {
                Owner::update_owner_details($first_name, $last_name, $phone, $email, $user_id);
                $updated_owner_obj = new Owner($id, $user_id, $commission_rate, $commission_type_id);
                $result = $updated_owner_obj->update_owner();
                if ($result) {
                    redirect("index");
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
        $result = Owner::delete_owner($id);
        if($result){
            redirect("index");
        }
    }

    // cancel 
    function cancel(){
        redirect("index");
    }
}
