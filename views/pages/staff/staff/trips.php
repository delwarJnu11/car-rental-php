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
                                        <button class="btn bg-grd-primary px-1 fw-semibold" style="font-size: 13px;" id="payment_btn" data-payment-info='<?=json_encode([
    "booking_id"        => $trip['id'],
    "customer_id"       => $trip['customer_id'],
    "total_rent_amount" => $trip['net_payable_amount'],
    "paid_amount"       => $trip['paid_amount'],
    "due_amount"        => $trip['due_amount'],
    "driver_id"         => $trip['driver_id'],
], JSON_HEX_APOS | JSON_HEX_QUOT)?>'>Receive Payment</button>
                                    <?php endif?>
                                    <button id="start_btn" class="btn btn-success px-2 fw-semibold" style="font-size: 13px;" data-vehicle-id="<?=$trip['vehicle_id'];?>" data-journey_date="<?=$trip['journey_start_date'];?>" data-journey_end_date="<?=$trip['journey_end_date'];?>">Start</button>
                                    <button id="end_btn" class="btn btn-danger px-2 fw-semibold" style="font-size: 13px;" data-vehicle-id="<?=$trip['vehicle_id'];?>">End</button>
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
    $(function(){
        // Payment
        $("tbody").on("click", "#payment_btn", function(){
            const data = $(this).data("payment-info");
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
                 if(result.result){
                    localStorage.setItem({"disabled": "true", "text": "Paid"});
                    $("#payment_btn").attr("disabled", true);
                    $("#payment_btn").text("Paid");
                 }
               },
               error: function(error) {
                 console.error(error);
               }
            });
        })

        // When Driver Click On Start Btn Vehicle Status Will be In Trip
        $("tbody").on("click", "#start_btn", function(){
            const vehicle_id = $(this).data("vehicle-id");
            const journey_start = $(this).data("journey_date");
            const journey_end = $(this).data("journey_end_date");
            $.ajax({
                url: "<?php $base_url?>/api/vehiclestatus/find_status",
                type: "GET",
                data: {
                    field_name:"vehicle_status",
                    value:"In Trip"
                },
                success: function(res){
                  const vehicle_status_id = JSON.parse(res).success.id;

                  console.log(vehicle_id, journey_start, journey_end, vehicle_status_id)

                  // update status here
                  $.ajax({
                      url: "<?php $base_url?>/api/vehicles/update_vehicle_status",
                      type: "POST",
                      data: {
                        vehicle_id,
                        vehicle_status_id,
                        journey_start_date: journey_start,
                        journey_end_date: journey_end
                      },
                      success: function(res){
                        const result = JSON.parse(res).success;
                        if(result){
                            $("#start_btn").text("Running...");
                            $("#start_btn").attr("disabled", true);
                        }
                      },
                      error: function(error){
                        console.error(error);
                      }
                  });

                },
                error: function(error){
                  console.error(error);
                }
            });
        })
        // When Driver Click On End Btn Vehicle Status Will be Available
        $("tbody").on("click", "#end_btn", function(){
            const vehicle_id = $(this).data("vehicle-id");
            alert(vehicle_id);

            $.ajax({
                url: "<?php $base_url?>/api/vehiclestatus/find_status",
                type: "GET",
                data: {
                    field_name:"vehicle_status",
                    value:"Available"
                },
                success: function(res){
                  const vehicle_status_id = JSON.parse(res).success.id;
                    alert(vehicle_status_id)
                  // update status here
                  $.ajax({
                      url: "<?php $base_url?>/api/vehicles/update_vehicle_status",
                      type: "POST",
                      data: {
                        vehicle_id,
                        vehicle_status_id,
                        journey_start_date: "",
                        journey_end_date: ""
                      },
                      success: function(res){
                        console.log(res)
                        const result = JSON.parse(res).success;
                        alert(result)
                        if(result){
                            $("#start_btn").text("Done");
                            $("#end_btn").text("Finished");
                            $("#end_btn").attr("disabled", true);
                            $("#start_btn").attr("disabled", true);

                        }
                      },
                      error: function(error){
                        console.error(error);
                      }
                  });

                },
                error: function(error){
                  console.error(error);
                }
            });
        })

    });
</script>