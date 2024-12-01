<?php

$vehicles = Vehicle::get_vehicles();
$all_status = BookingStatus::get_all_booking_status();

if (isset($_POST['search'])) {
    $search_text = htmlspecialchars(strip_tags($_POST['search_customer']));

    $email_pattern = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z]+\.[a-zA-Z]{2,}$/";
    $phone_pattern = "/^(\+8801|8801|01)[3-9]{1}[0-9]{8}$/";

    if (preg_match($email_pattern, $search_text)) {
        $customer = Customer::get_customer("email", $search_text);
    } else if (preg_match($phone_pattern, $search_text)) {
        $customer = Customer::get_customer("phone", $search_text);
    } else {
        $error_msg = "customer not found!";
    }
}

?>

<script>
    $(function() {
        $("#customer").show();
        $("#booking").hide();

        // open booking form after clicking next button
        $("#next").on("click", function() {
            $("#customer").hide();
            $("#booking").show();
        })
        // Go Back button
        $("#go_back").on("click", function() {
            $("#customer").show();
            $("#booking").hide();
        })
    })
</script>

<div class="row">
    <div class="col-12 col-xl-12 mx-auto">
        <div class="card rounded-4 border-top border-4 border-primary border-gradient-1">
            <div class="card-body p-4">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div class="">
                        <h5 class="mb-4 fw-bold">Create A New Booking</h5>
                    </div>
                    <form class="d-flex gap-2" method="post">
                        <div>
                            <strong class="text-danger text-sm"><?= isset($error_msg) ? "$error_msg" : ""; ?></strong>
                            <input type="search" style="<?= isset($error_msg) ? "border: 1px solid red; " : "" ?>" class="form-control" id="search_customer" name="search_customer" placeholder="search customer...">
                        </div>
                        <input class="btn btn-grd-primary text-white" id="customer_search_btn" type="submit" name="search" value="Search">
                    </form>
                </div>
                <form action="/booking/save" method="POST" enctype="multipart/form-data">
                    <div id="customer" class="row g-4">
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
                        <div class="col-md-12 position-relative">
                            <label for="input17" class="form-label">Upload Customer Image</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="material-icons-outlined">cloud_upload</i>
                                </span>
                                <input type="file" name="customer_image" class="form-control" id="input17">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="d-md-flex d-grid align-items-center justify-content-end gap-3">
                                <p id="next" class="btn btn-grd-primary px-4 text-white">Next</p>
                            </div>
                        </div>
                    </div>
                    <div id="booking" class="row g-4">
                        <div class="col-md-6">
                            <label for="vehicle_id" class="form-label">Vehicle Name</label>
                            <select id="vehicle_id" name="vehicle_id" class="form-select">
                                <option selected="">Select Vehicle</option>
                                <?php foreach ($vehicles as $vehicle): ?>
                                    <option value="<?= $vehicle['id']; ?>"><?= $vehicle['vehicle_name']; ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="booking_status_id" class="form-label">Booking Status</label>
                            <select id="booking_status_id" name="booking_status_id" class="form-select">
                                <option selected="">Select Booking Status</option>
                                <?php foreach ($all_status as $status): ?>
                                    <option value="<?= $status['id']; ?>"><?= $status['booking_status']; ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="booking_date" class="form-label">Booking Date</label>
                            <input type="date" name="booking_date" class="form-control" id="booking_date" placeholder="">
                        </div>
                        <div class="col-md-6">
                            <label for="pick_location" class="form-label">Pick Up Location</label>
                            <input type="text" name="pick_up_location" class="form-control" id="pick_location">
                        </div>
                        <div class="col-md-6">
                            <label for="drop_location" class="form-label">Drop Off Location</label>
                            <input type="text" name="drop_off_location" class="form-control" id="drop_location">
                        </div>
                        <div class="col-md-6">
                            <label for="journey_start_date" class="form-label">Journey Start Date</label>
                            <input type="date" name="journey_start_date" class="form-control" id="journey_start_date" placeholder="">
                        </div>
                        <div class="col-md-6">
                            <label for="journey_end_date" class="form-label">Journey End Date</label>
                            <input type="date" name="journey_end_date" class="form-control" id="journey_end_date" placeholder="">
                        </div>
                        <div class="col-md-6">
                            <label for="duration" class="form-label">Duration</label>
                            <input type="text" name="duration" class="form-control" id="duration">
                        </div>
                        <div class="col-md-6">
                            <label for="rent_amount" class="form-label">Rent Amount</label>
                            <input type="text" name="rent_amount" class="form-control" id="rent_amount">
                        </div>
                        <div class="col-md-6">
                            <label for="discount_amount" class="form-label">Discount Amount</label>
                            <input type="text" name="discount_amount" class="form-control" id="discount_amount">
                        </div>
                        <div class="col-md-6">
                            <label for="paid_amount" class="form-label">Paid Amount</label>
                            <input type="text" name="paid_amount" class="form-control" id="paid_amount">
                        </div>
                        <div class="col-md-6">
                            <label for="due_amount" class="form-label">Due Amount</label>
                            <input type="text" name="due_amount" class="form-control" id="due_amount">
                        </div>
                        <div class="col-md-12">
                            <div class="d-md-flex d-grid align-items-center gap-3">
                                <button type="submit" name="create" class="btn btn-grd-primary px-4 text-white">Confirm Booking</button>
                                <p id="go_back" class="btn btn-secondary px-4 text-white mb-0">Go Back</p>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>