<?php
class UserController {

    // Show all User
    function index() {
        view("system");
    }

    // Create new User
    function create() {
        view("system");
    }

    function save() {
        if (isset($_POST['add_user'])) {
            $first_name = htmlspecialchars(strip_tags($_POST['first_name']));
            $last_name = htmlspecialchars(strip_tags($_POST['last_name']));
            $phone = htmlspecialchars(strip_tags($_POST['phone']));
            $email = htmlspecialchars(strip_tags($_POST['email']));
            $password = htmlspecialchars(strip_tags($_POST['password']));
            $role_id = htmlspecialchars(strip_tags($_POST['role_id']));

            $photo = $_FILES['image'];
            $image_name = upload($photo, "img/users");

            if ($first_name && $last_name && $phone && $email && $password && $role_id) {
                $newUser = new User(null, $first_name, $last_name, $phone, $email, password_hash($password, PASSWORD_BCRYPT), $role_id, $image_name);
                $user_id = $newUser->create_user();
                if ($user_id) {
                    redirect("index");
                }
            }
        }
    }

    // Update New user
    function edit($id) {
        view("system", User::get_user($id));
    }

    function update() {
        if (isset($_POST['update_user'])) {
            $id = htmlspecialchars(strip_tags($_POST['id']));
            $password = htmlspecialchars(strip_tags($_POST['password']));
            $first_name = htmlspecialchars(strip_tags($_POST['first_name']));
            $last_name = htmlspecialchars(strip_tags($_POST['last_name']));
            $phone = htmlspecialchars(strip_tags($_POST['phone']));
            $email = htmlspecialchars(strip_tags($_POST['email']));
            $role_id = htmlspecialchars(strip_tags($_POST['role_id']));

            if ($id && $first_name && $last_name && $phone && $email && $role_id) {
                $user = new User($id, $first_name, $last_name, $phone, $email, $password, $role_id);
                $result = $user->update_user();
                if ($result) {
                    redirect("index");
                }
            }
        }
    }

    // Delete
    function delete($id) {
        view("system", $id);
    }

    // confirm Delete
    function confirm_delete($id) {
        $result = User::delete_user("id", $id);
        if ($result) {
            redirect("index");
        }
    }
}
