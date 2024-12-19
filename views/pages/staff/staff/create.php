<?php

$designations = Designation::get_all_designation();

?>

<div class="row">
    <div class="col-12 col-xl-12 mx-auto">
        <div class="card rounded-4 border-top border-4 border-primary border-gradient-1">
            <div class="card-body p-4">
                <div class="d-flex align-items-start justify-content-between mb-3">
                    <div class="">
                        <h5 class="mb-0 fw-bold">Add New Staff</h5>
                    </div>
                </div>
                <form action="<?php echo $base_url ?>/staff/save" method="POST" enctype="multipart/form-data" class="row g-4">
                    <div class="col-md-6">
                        <label for="input1" class="form-label">First Name</label>
                        <input type="text" name="first_name" class="form-control" id="input1" placeholder="First Name">
                    </div>
                    <div class="col-md-6">
                        <label for="input2" class="form-label">Last Name</label>
                        <input type="text" name="last_name" class="form-control" id="input2" placeholder="Last Name">
                    </div>
                    <div class="col-md-6">
                        <label for="input3" class="form-label">Phone</label>
                        <input type="text" name="phone" class="form-control" id="input3" placeholder="Phone">
                    </div>
                    <div class="col-md-6">
                        <label for="input4" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" id="input4">
                    </div>
                    <div class="col-md-6">
                        <label for="input5" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="input5">
                    </div>
                    <div class="col-md-6">
                        <label for="input6" class="form-label">National ID</label>
                        <input type="text" name="nid" class="form-control" id="input6">
                    </div>
                    <div class="col-md-6">
                        <label for="input7" class="form-label">House No</label>
                        <input type="text" name="house_no" class="form-control" id="input7">
                    </div>
                    <div class="col-md-6">
                        <label for="input8" class="form-label">Road No</label>
                        <input type="text" name="road_no" class="form-control" id="input8">
                    </div>
                    <div class="col-md-6">
                        <label for="input9" class="form-label">Postal Code</label>
                        <input type="text" name="postal_code" class="form-control" id="input9">
                    </div>
                    <div class="col-md-6">
                        <label for="input10" class="form-label">State</label>
                        <input type="text" name="state" class="form-control" id="input10">
                    </div>
                    <div class="col-md-6">
                        <label for="input11" class="form-label">City</label>
                        <input type="text" name="city" class="form-control" id="input11">
                    </div>
                    <div class="col-md-6">
                        <label for="input12" class="form-label">Country</label>
                        <input type="text" name="country" class="form-control" id="input12">
                    </div>
                    <div class="col-md-6">
                        <label for="input13" class="form-label">Designation</label>
                        <select name="designation_id" id="input13" class="form-select">
                            <option value="">Select Designation</option>
                            <?php foreach ($designations as $designation): ?>
                                <option value="<?=$designation['id'];?>"><?=$designation['designation_name'];?></option>
                            <?php endforeach?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="input13" class="form-label">Staff Salary</label>
                        <input type="text" name="salary" class="form-control" id="input13">
                    </div>
                    <div class="col-md-6">
                        <label for="input14" class="form-label">Date Of Hire</label>
                        <input type="date" name="hire_date" class="form-control" id="input14">
                    </div>
                    <div class="col-md-6 position-relative">
                        <label for="input17" class="form-label">Upload Staff Image</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="material-icons-outlined">cloud_upload</i>
                            </span>
                            <input type="file" name="staff_image" class="form-control" id="input17">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="d-md-flex d-grid align-items-center gap-3">
                            <button type="submit" name="create" class="btn btn-grd-primary px-4 text-white">Add New Staff</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>