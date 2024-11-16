<?php
class RoleController
{


   // Display all Roles
   function index()
   {
      view("system");
   }

   // create Role
   function create()
   {
      view("system");
   }

   function save()
   {
      if (isset($_POST['create_role'])) {
         $role = $_POST['role_name'];
         if ($role) {
            $role_obj = new Role(null, $role);
            $res = $role_obj->create_role();

            if ($res) {
               redirect("index");
            }
         }
      }
   }

   function edit($id)
   {
      view("system", Role::get_role($id));
   }

   function update()
   {
      if (isset($_POST["update_role"])) {
         $id = $_POST['id'];
         $role = $_POST['role_name'];

         if ($id) {
            $roleObj = new Role($id, $role);
            $result = $roleObj->update_role();
            if ($result) {
               redirect("index");
            }
         }
      }
   }
}
