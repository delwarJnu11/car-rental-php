<?php

class Role
{
    public $id;
    public $name;
    public $created_at;
    public $updated_at;

    function __construct($id, $role_name)
    {
        $this->id = $id;
        $this->name = $role_name;
    }


    // create user role
    function create_role()
    {
        global $db, $tx;
        $stmnt = $db->prepare("INSERT INTO {$tx}roles(name)VALUES( ?)");
        $stmnt->bind_param("s", $this->name);
        return $stmnt->execute();
    }

    // get users all roles
    static function get_roles()
    {
        global $db, $tx;
        $stmnt = $db->prepare("SELECT * FROM {$tx}roles");
        $stmnt->execute();
        $result = $stmnt->get_result();
        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return [];
        }
    }

    // get single Result
    static function get_role($id)
    {
        global $db, $tx;
        $stmnt = $db->prepare("SELECT * FROM {$tx}roles WHERE id = $id");
        $stmnt->execute();
        $result = $stmnt->get_result();
        if ($result) {
            $role = $result->fetch_object();
            return $role;
        } else {
            return [];
        }
    }

    // Update user role
    function update_role()
    {
        global $db, $tx;
        $stmnt = $db->prepare("UPDATE {$tx}roles SET name = ? WHERE id = ?");
        $stmnt->bind_param("si", $this->name, $this->id);
        return $stmnt->execute();
    }

    // Delete Role
    static function delete_role($id)
    {
        global $db, $tx;
        $stmnt = $db->prepare("DELETE FROM {$tx}roles WHERE id = ?");
        $stmnt->bind_param("i", $id);
        return $stmnt->execute();
    }
}
