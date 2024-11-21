<div class="row">
    <div class="col-12 col-xl-12 mx-auto">
        <div class="card rounded-4 border-top border-4 border-primary border-gradient-1">
            <div class="card-body p-4">
                <div class="d-flex align-items-start justify-content-between mb-3">
                    <div class="">
                        <h5 class="mb-4 fw-bold">Register New Vehicle</h5>
                    </div>
                </div>
                <form action="/vehicle/save" method="POST" enctype="multipart/form-data" class="row g-4">
                    <div class="col-md-4">
                        <label for="input1" class="form-label">Vehicle Name</label>
                        <input type="text" name="vehicle_name" class="form-control" id="input1" placeholder="Vehicle Name">
                    </div>
                    <div class="col-md-4">
                        <label for="input2" class="form-label">Model Name</label>
                        <input type="text" name="model_name" class="form-control" id="input2" placeholder="Model Name">
                    </div>
                    <div class="col-md-4">
                        <label for="input3" class="form-label">Year</label>
                        <input type="text" name="year" class="form-control" id="input3" placeholder="Year">
                    </div>
                    <div class="col-md-4">
                        <label for="input4" class="form-label">Door</label>
                        <input type="text" name="door" class="form-control" id="input4" placeholder="Enter Door">
                    </div>
                    <div class="col-md-4">
                        <label for="input5" class="form-label">Seats</label>
                        <input type="text" name="seats" class="form-control" id="input5" placeholder="Enter Seats">
                    </div>
                    <div class="col-md-4">
                        <label for="input6" class="form-label">Luggage Capacity</label>
                        <input type="text" name="luggage" class="form-control" id="input6" placeholder="Enter luggage">
                    </div>
                    <div class="col-md-4">
                        <label for="input7" class="form-label">Capacity</label>
                        <input type="text" name="capacity" class="form-control" id="input7" placeholder="Enter capacity">
                    </div>
                    <div class="col-md-4">
                        <label for="input8" class="form-label">Price Per Hour</label>
                        <input type="text" name="price_per_hour" class="form-control" id="input8" placeholder="Price Per hour">
                    </div>
                    <div class="col-md-4">
                        <label for="input9" class="form-label">Price Per Day</label>
                        <input type="text" name="price_per_day" class="form-control" id="input9" placeholder="Price Per Day">
                    </div>
                    <div class="col-md-4">
                        <label for="input10" class="form-label">Price Per Week</label>
                        <input type="text" name="price_per_week" class="form-control" id="input10" placeholder="Price Per week">
                    </div>
                    <div class="col-md-4">
                        <label for="input15" class="form-label">Discount Price</label>
                        <input type="text" name="discount_price" class="form-control" id="input15" placeholder="Discount Price">
                    </div>
                    <div class="col-md-4">
                        <label for="input11" class="form-label">Owner</label>
                        <select id="input11" name="owner_id" class="form-select">
                            <option selected="">Select Owner</option>
                            <option>Owner 1</option>
                            <option>Owner 2</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="input12" class="form-label">Vehicle Type</label>
                        <select id="input12" name="vehicle_type_id" class="form-select">
                            <option selected="">Select Vehicle Type</option>
                            <option>Vehicle Type 1</option>
                            <option>Vehicle Type 2</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="input13" class="form-label">Vehicle Status</label>
                        <select id="input13" name="vehicle_status_id" class="form-select">
                            <option selected="">Select Vehicle Status</option>
                            <option>Vehicle Status 1</option>
                            <option>Vehicle Status 2</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="input14" class="form-label">Vehicle Engine Type</label>
                        <select id="input14" name="vehicle_engine_id" class="form-select">
                            <option selected="">Select Vehicle Engine Type</option>
                            <option>Vehicle Engine Type 1</option>
                            <option>Vehicle Engine Type 2</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="input19" class="form-label">Insurance Expire Date</label>
                        <input type="date" name="expiry_date" class="form-control" id="input19">
                    </div>
                    <div class="col-md-6">
                        <label for="input20" class="form-label">Insurance Provider</label>
                        <input type="text" name="insurance_provider" class="form-control" id="input20">
                    </div>
                    <div class="col-md-12">
                        <label for="input23" class="form-label">Description</label>
                        <textarea class="form-control" name="description" id="input23" placeholder="Description..." rows="3"></textarea>
                    </div>
                    <div class="col-md-4 position-relative">
                        <label for="input16" class="form-label">Upload Vehicle Image</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="material-icons-outlined">cloud_upload</i>
                            </span>
                            <input type="file" name="vehicle_image" class="form-control" id="input16">
                        </div>
                    </div>
                    <div class="col-md-4 position-relative">
                        <label for="input17" class="form-label">Upload Vehicle License</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="material-icons-outlined">cloud_upload</i>
                            </span>
                            <input type="file" name="vehicle_license" class="form-control" id="input17">
                        </div>
                    </div>
                    <div class="col-md-4 position-relative">
                        <label for="input18" class="form-label">Upload Vehicle Insurance</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="material-icons-outlined">cloud_upload</i>
                            </span>
                            <input type="file" name="vehicle_insurance" class="form-control" id="input18">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-check form-switch">
                            <input class="form-check-input" name="isAc" type="checkbox" id="chkAc">
                            <label class="form-check-label" for="chkAc">AC</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="d-md-flex d-grid align-items-center gap-3">
                            <button type="submit" name="add_vehicle" class="btn btn-grd-primary px-4 text-white">Register Vehicle</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>