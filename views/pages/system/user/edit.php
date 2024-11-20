<?php

$roles = Role::get_roles();

?>

<div class="row">
    <div class="col-12 col-xl-8 mx-auto">
        <div class="card rounded-4 border-top border-4 border-primary border-gradient-1">
            <div class="card-body p-4">
                <div class="d-flex align-items-start justify-content-between mb-3">
                    <div class="">
                        <h5 class="mb-4 fw-bold">Update User</h5>
                    </div>
                </div>
                <form action="<?= $base_url ?>/user/update" method="POST" class="row g-4">
                    <input type="hidden" name="id" value="<?= $user->id ?>">
                    <input type="hidden" name="password" value="<?= $user->password ?>">
                    <div class="col-md-6">
                        <label for="input1" class="form-label">First Name</label>
                        <input type="text" name="first_name" value="<?= $user->first_name ?>" class="form-control" id="input1" placeholder="First Name">
                    </div>
                    <div class="col-md-6">
                        <label for="input2" class="form-label">Last Name</label>
                        <input type="text" name="last_name" value="<?= $user->last_name ?>" class="form-control" id="input2" placeholder="Last Name">
                    </div>
                    <div class="col-md-12">
                        <label for="input3" class="form-label">Phone</label>
                        <input type="text" name="phone" value="<?= $user->phone ?>" class="form-control" id="input3" placeholder="Phone">
                    </div>
                    <div class="col-md-12">
                        <label for="input4" class="form-label">Email</label>
                        <input type="email" name="email" value="<?= $user->email ?>" class="form-control" id="input4">
                    </div>
                    <div class="col-md-12">
                        <label for="input7" class="form-label">Role</label>
                        <select id="input7" name="role_id" class="form-select">
                            <option selected="">Select Role</option>
                            <?php foreach ($roles as $role): ?>
                                <option <?= strtolower($user->role) === strtolower($role['role_name']) ? "selected" : "" ?> value="<?= $role['id'] ?>"><?= $role['role_name'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <div class="d-md-flex d-grid align-items-center gap-3">
                            <button type="submit" name="update_user" class="btn btn-grd-primary px-4">Update User</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>