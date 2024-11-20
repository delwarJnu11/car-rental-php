<div class="row">
    <div class="col-12 col-xl-8 mx-auto">
        <div class="card rounded-4 border-top border-4 border-primary border-gradient-1">
            <div class="card-body p-4">
                <div class="d-flex align-items-start justify-content-between mb-3">
                    <div class="">
                        <h5 class="mb-0 fw-bold">Add User</h5>
                    </div>
                </div>
                <form action="/user/save" method="POST" class="row g-4">
                    <div class="col-md-6">
                        <label for="input1" class="form-label">First Name</label>
                        <input type="text" name="first_name" class="form-control" id="input1" placeholder="First Name">
                    </div>
                    <div class="col-md-6">
                        <label for="input2" class="form-label">Last Name</label>
                        <input type="text" name="last_name" class="form-control" id="input2" placeholder="Last Name">
                    </div>
                    <div class="col-md-12">
                        <label for="input3" class="form-label">Phone</label>
                        <input type="text" name="phone" class="form-control" id="input3" placeholder="Phone">
                    </div>
                    <div class="col-md-12">
                        <label for="input4" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" id="input4">
                    </div>
                    <div class="col-md-12">
                        <label for="input5" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="input5">
                    </div>
                    <div class="col-md-12">
                        <label for="input7" class="form-label">Role</label>
                        <select id="input7" name="role_id" class="form-select">
                            <option selected="">Select Role</option>
                            <option selected="">Option 1</option>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <div class="d-md-flex d-grid align-items-center gap-3">
                            <button type="submit" name="add_user" class="btn btn-grd-primary px-4">Add New User</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>