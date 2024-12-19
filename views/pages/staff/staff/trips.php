<?php

$trips = Booking::get_trips_by_driver($_SESSION['driver_id']);

// echo "<pre/>";
// print_r($trips);
?>

<div class="row">
    <?php if (count($trips)): ?>
        <div class="col-xl-12">
            <h6 class="mb-0 text-uppercase">All Trips For Mr. <?=$_SESSION['fname'] . " " . $_SESSION['lname'];?></h6>
            <hr>
            <div class="card shadow">
                <div class="card-body">
                    <table class="table table-striped table-hover align-middle">
                        <thead class="table-dark">
                            <tr class="text-center py-2">
                                <th scope="col">Vehicle Name</th>
                                <th scope="col">Customer Name</th>
                                <th scope="col">Journey Date</th>
                                <th scope="col">Pick Up</th>
                                <th scope="col">Drop Off</th>
                                <th scope="col">Due Amount</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
    <?php foreach ($trips as $trip): ?>
        <tr class="text-center py-2">
            <td><?=$trip['vehicle_name']?></td>
            <td><?=$trip['first_name'] . " " . $trip['last_name']?></td>
            <td><?=date("F j, Y", strtotime($trip['journey_start_date']))?></td>
            <td><?=$trip['pick_up_location']?></td>
            <td><?=$trip['drop_off_location']?></td>
            <td class="<?=$trip['due_amount'] === 0 ? "badge bg-badge-success" : "";?>"><?=$trip['due_amount'] === 0 ? "Paid" : $trip['due_amount']?></td>
            <td class="d-flex gap-1">
                <?php if ($trip['due_amount'] != 0): ?>
                    <button class="btn bg-grd-primary px-1 fw-semibold payment-btn" style="font-size: 13px;"
                        data-payment-info='<?=json_encode([
    "booking_id" => $trip['id'],
    "customer_id" => $trip['customer_id'],
    "total_rent_amount" => $trip['net_payable_amount'],
    "paid_amount" => $trip['paid_amount'],
    "due_amount" => $trip['due_amount'],
    "driver_id" => $trip['driver_id'],
], JSON_HEX_APOS | JSON_HEX_QUOT)?>'>Receive Payment</button>
                <?php endif?>
                <button class="btn btn-success px-2 fw-semibold start-btn" style="font-size: 13px;"
                    data-trip-id="<?=$trip['id'];?>"
                    data-vehicle-id="<?=$trip['vehicle_id'];?>"
                    data-journey-date="<?=$trip['journey_start_date'];?>"
                    data-journey-end-date="<?=$trip['journey_end_date'];?>">Start</button>
                <button class="btn btn-danger px-2 fw-semibold end-btn" style="font-size: 13px;"
                    data-trip-id="<?=$trip['id'];?>"
                    data-vehicle-id="<?=$trip['vehicle_id'];?>">End</button>
            </td>
        </tr>
    <?php endforeach?>
</tbody>

                    </table>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="mt-5 w-50 d-flex justify-content-center align-items-center text-bg-danger mx-auto p-2 rounded-2">
            <h2 class="fs-4 py-2 text-center text-text-white-50">There are no Trip Found!.</h2>
        </div>
    <?php endif;?>
</div>


<!-- Script for payment update -->
<script>
    $(function() {
        // Restore payment button state from localStorage
        const paymentBtnState = JSON.parse(localStorage.getItem("payment_btn_state"));
        if (paymentBtnState) {
            $("#payment_btn").attr("disabled", paymentBtnState.disabled);
            $("#payment_btn").text(paymentBtnState.text);
        }

        // Payment
        $("tbody").on("click", ".payment_btn", function() {
            const $btn = $(this); // Store reference to the clicked button
            const data = $btn.data("payment-info");

            $.ajax({
                url: "<?php echo $base_url ?>/api/payment/create",
                type: "POST",
                data: {
                    booking_id: data?.booking_id,
                    customer_id: data?.customer_id,
                    total_rent_amount: data?.total_rent_amount,
                    paid_amount: data?.due_amount,
                    due_amount: 0,
                    driver_id: data?.driver_id,
                },
                success: function(res) {
                    const result = JSON.parse(res);

                    if (result.result) {
                        // Update the clicked button's state
                        $btn.text("Paid").prop("disabled", true);

                        // Save state to localStorage for persistence
                        const paymentStates = JSON.parse(localStorage.getItem("payment_btn_states")) || {};
                        paymentStates[data.booking_id] = { disabled: true, text: "Paid" };
                        localStorage.setItem("payment_btn_states", JSON.stringify(paymentStates));
                    }
                },
                error: function(error) {
                    console.error(error);
                }
            });
        });

        // Restore Payment Button States
        $(document).ready(function() {
            const paymentStates = JSON.parse(localStorage.getItem("payment_btn_states")) || {};

            Object.keys(paymentStates).forEach((bookingId) => {
                const state = paymentStates[bookingId];
                $(`.payment_btn[data-payment-info*='"booking_id":${bookingId}']`)
                    .text(state.text)
                    .prop("disabled", state.disabled);
            });
        });

        // Restore button states from localStorage
        const tripStates = JSON.parse(localStorage.getItem("trip_button_states")) || {};
        Object.keys(tripStates).forEach((tripId) => {
            const { startText, startDisabled, endText, endDisabled } = tripStates[tripId];
            $(`.start-btn[data-trip-id="${tripId}"]`).text(startText).prop("disabled", startDisabled);
            $(`.end-btn[data-trip-id="${tripId}"]`).text(endText).prop("disabled", endDisabled);
        });

        // Handle Start Button Click
        $("tbody").on("click", ".start-btn", function () {
            const tripId = $(this).data("trip-id");
            const vehicleId = $(this).data("vehicle-id");
            const journeyStart = $(this).data("journey-date");
            const journeyEnd = $(this).data("journey-end-date");

            $.ajax({
                url: "<?php $base_url?>/api/vehiclestatus/find_status",
                type: "GET",
                data: { field_name: "vehicle_status", value: "In Trip" },
                success: function (res) {
                    const vehicleStatusId = JSON.parse(res).success.id;

                    $.ajax({
                        url: "<?php $base_url?>/api/vehicles/update_vehicle_status",
                        type: "POST",
                        data: {
                            vehicle_id: vehicleId,
                            vehicle_status_id: vehicleStatusId,
                            journey_start_date: journeyStart,
                            journey_end_date: journeyEnd
                        },
                        success: function (res) {
                            const result = JSON.parse(res).success;
                            if (result) {
                                $(`.start-btn[data-trip-id="${tripId}"]`).text("Running...").prop("disabled", true);

                                // Save state to localStorage
                                tripStates[tripId] = {
                                    startText: "Running...",
                                    startDisabled: true,
                                    endText: "End",
                                    endDisabled: false
                                };
                                localStorage.setItem("trip_button_states", JSON.stringify(tripStates));
                            }
                        },
                        error: function (error) {
                            console.error(error);
                        }
                    });
                },
                error: function (error) {
                    console.error(error);
                }
            });
        });

            // Handle End Button Click
            $("tbody").on("click", ".end-btn", function () {
                const tripId = $(this).data("trip-id");
                const vehicleId = $(this).data("vehicle-id");

                $.ajax({
                    url: "<?php $base_url?>/api/vehiclestatus/find_status",
                    type: "GET",
                    data: { field_name: "vehicle_status", value: "Available" },
                    success: function (res) {
                        const vehicleStatusId = JSON.parse(res).success.id;

                        $.ajax({
                            url: "<?php $base_url?>/api/vehicles/update_vehicle_status",
                            type: "POST",
                            data: {
                                vehicle_id: vehicleId,
                                vehicle_status_id: vehicleStatusId,
                                journey_start_date: "",
                                journey_end_date: ""
                            },
                            success: function (res) {
                                const result = JSON.parse(res).success;
                                if (result) {
                                    $(`.end-btn[data-trip-id="${tripId}"]`).text("Finished").prop("disabled", true);
                                    $(`.start-btn[data-trip-id="${tripId}"]`).text("Completed").prop("disabled", true);

                                    // Save state to localStorage
                                    tripStates[tripId] = {
                                        startText: "Completed",
                                        startDisabled: true,
                                        endText: "Finished",
                                        endDisabled: true
                                    };
                                    localStorage.setItem("trip_button_states", JSON.stringify(tripStates));
                                }
                            },
                            error: function (error) {
                                console.error(error);
                            }
                        });
                    },
                    error: function (error) {
                        console.error(error);
                    }
                });
            });
    });
</script>