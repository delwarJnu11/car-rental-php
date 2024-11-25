<div class="row">
    <div class="col-12 col-xl-12 mx-auto">
        <div class="card rounded-4 border-top border-4 border-primary border-gradient-1">
            <div class="card-body p-4">
                <div class="d-flex align-items-start justify-content-between mb-3">
                    <div class="">
                        <h5 class="mb-4 fw-bold">Add User Role</h5>
                    </div>
                </div>
                <form action="/role/save" method="POST" class="row g-4">
                    <div class="col-md-12">
                        <label for="input3" class="form-label">Role Name</label>
                        <input type="text" name="role_name" class="form-control" id="input3" placeholder="Role Name">
                    </div>
                    <div class="col-md-12">
                        <div class="d-md-flex d-grid align-items-center gap-3">
                            <button type="submit" name="add_role" class="btn btn-grd-primary px-4 text-white">Add New Role</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>