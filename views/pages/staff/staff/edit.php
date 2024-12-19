<?php

$designations = Designation::get_all_designation();

?>

<div class="row">
    <div class="col-12 col-xl-12 mx-auto">
        <div class="card rounded-4 border-top border-4 border-primary border-gradient-1">
            <div class="card-body p-4">
                <div class="d-flex align-items-start justify-content-between mb-3">
                    <div class="">
                        <h5 class="mb-0 fw-bold">Update Staff</h5>
                    </div>
                </div>
                <form action="<?php echo $base_url ?>/staff/update" method="POST" class="row g-4">
                    <input type="hidden" name="id" value="<?=$staff->id;?>">
                    <div class="col-md-6">
                        <label for="input1" class="form-label">First Name</label>
                        <input type="text" name="first_name" value="<?=$staff->first_name;?>" class="form-control" id="input1" placeholder="First Name">
                    </div>
                    <div class="col-md-6">
                        <label for="input2" class="form-label">Last Name</label>
                        <input type="text" name="last_name" value="<?=$staff->last_name;?>" class="form-control" id="input2" placeholder="Last Name">
                    </div>
                    <div class="col-md-6">
                        <label for="input3" class="form-label">Phone</label>
                        <input type="text" name="phone" value="<?=$staff->phone;?>" class="form-control" id="input3" placeholder="Phone">
                    </div>
                    <div class="col-md-6">
                        <label for="input4" class="form-label">Email</label>
                        <input type="email" name="email" value="<?=$staff->email;?>" class="form-control" id="input4">
                    </div>
                    <div class="col-md-6">
                        <label for="input7" class="form-label">House No</label>
                        <input type="text" name="house_no" value="<?=$staff->house_no;?>" class="form-control" id="input7">
                    </div>
                    <div class="col-md-6">
                        <label for="input8" class="form-label">Road No</label>
                        <input type="text" name="road_no" value="<?=$staff->road_no;?>" class="form-control" id="input8">
                    </div>
                    <div class="col-md-6">
                        <label for="input9" class="form-label">Postal Code</label>
                        <input type="text" name="postal_code" value="<?=$staff->postal_code;?>" class="form-control" id="input9">
                    </div>
                    <div class="col-md-6">
                        <label for="input10" class="form-label">State</label>
                        <input type="text" name="state" value="<?=$staff->state;?>" class="form-control" id="input10">
                    </div>
                    <div class="col-md-6">
                        <label for="input11" class="form-label">City</label>
                        <input type="text" name="city" value="<?=$staff->city;?>" class="form-control" id="input11">
                    </div>
                    <div class="col-md-6">
                        <label for="input12" class="form-label">Country</label>
                        <input type="text" name="country" value="<?=$staff->country;?>" class="form-control" id="input12">
                    </div>
                    <div class="col-md-6">
                        <label for="input13" class="form-label">Designation</label>
                        <select name="designation_id" id="input13" class="form-select">
                            <option value="">Select Designation</option>
                            <?php foreach ($designations as $designation): ?>
                                <option <?=$staff->id === $designation['id'] ? "selected" : ""?> value="<?=$designation['id'];?>"><?=$designation['designation_name'];?></option>
                            <?php endforeach?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="input13" class="form-label">Staff Salary</label>
                        <input type="text" name="salary" value="<?=$staff->salary;?>" class="form-control" id="input13">
                    </div>
                    <div class="col-md-12">
                        <div class="d-md-flex d-grid align-items-center gap-3">
                            <button type="submit" name="update" class="btn btn-grd-primary px-4">Update Staff</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>