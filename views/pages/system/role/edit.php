<div class="container mx-auto">
    <form action="/role/update" method="POST">
        <input type="hidden" name="id" value="<?= $role->id ?>">
        <div class="mb-3">
            <label for="role_name" class="form-label">Role Name</label>
            <input type="text" value="<?= $role->role_name ?>" name="role_name" class="form-control" id="role_name" aria-describedby="emailHelp">
        </div>
        <button type="submit" class="btn btn-primary" name="update_role">Update Role</button>
    </form>
</div>