<?php

$roles = Role::get_roles();
$commission_types = CommissionType::get_commission_types();

?>

<div class="row">
    <div class="col-12 col-xl-12 mx-auto">
        <div class="card rounded-4 border-top border-4 border-primary border-gradient-1">
            <div class="card-body p-4">
                <div class="d-flex align-items-start justify-content-between mb-3">
                    <div class="">
                        <h5 class="mb-4 fw-bold">Update Owner</h5>
                    </div>
                </div>
                <form action="<?= $base_url ?>/owner/update" method="POST" class="row g-4">
                    <input type="hidden" name="id" value="<?= $owner->id ?>">
                    <input type="hidden" name="user_id" value="<?= $owner->user_id ?>">
                    <div class="col-md-6">
                        <label for="input1" class="form-label">First Name</label>
                        <input type="text" name="first_name" value="<?= $owner->first_name ?>" class="form-control" id="input1" placeholder="First Name">
                    </div>
                    <div class="col-md-6">
                        <label for="input2" class="form-label">Last Name</label>
                        <input type="text" name="last_name" value="<?= $owner->last_name ?>" class="form-control" id="input2" placeholder="Last Name">
                    </div>
                    <div class="col-md-6">
                        <label for="input3" class="form-label">Phone</label>
                        <input type="text" name="phone" value="<?= $owner->phone ?>" class="form-control" id="input3" placeholder="Phone">
                    </div>
                    <div class="col-md-6">
                        <label for="input4" class="form-label">Email</label>
                        <input type="email" name="email" value="<?= $owner->email ?>" class="form-control" id="input4">
                    </div>
                    <div class="col-md-6">
                        <label for="input11" class="form-label">Commission Rate</label>
                        <input type="text" name="commission_rate" value="<?= $owner->commission_rate ?>%" class="form-control" id="input11">
                    </div>
                    <div class="col-md-6">
                        <label for="input7" class="form-label">Commission Type</label>
                        <select id="input7" name="commission_id" class="form-select">
                            <option selected="">Select Commission Type</option>
                            <?php foreach ($commission_types as $type): ?>
                                <option <?= $owner->commission_type_id === $type['id'] ? "selected" : "" ?> value="<?= $type['id'] ?>"><?= $type['commission_type'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <div class="d-md-flex d-grid align-items-center gap-3">
                            <button type="submit" name="update" class="btn btn-grd-primary px-4">Update Owner</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>