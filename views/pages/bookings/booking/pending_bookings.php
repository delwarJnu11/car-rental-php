<?php

    $pending_bookings = Booking::get_pending_bookings();

    $drivers = Staff::get_all_driver();

    if (count($pending_bookings) === 0) {
        echo "
        <h2>No Pending Bookings Available right now.</h2>
    ";
        return;
    }

?>

<div class="row">
    <div class="col-xl-12">
        <h6 class="mb-0 text-uppercase">All Pending Bookings</h6>
        <hr>
        <div class="card shadow">
            <div class="card-body">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-dark">
                        <tr class="text-center">
                            <th scope="col">Vehicle</th>
                            <th scope="col">Customer Name</th>
                            <th scope="col">Journey Date</th>
                            <th scope="col">Pick Up</th>
                            <th scope="col">Drop Off</th>
                            <th scope="col">Assign Driver</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pending_bookings as $booking): ?>
                            <tr class="text-center">
                                <td><?=$booking['vehicle_name']?></td>
                                <td><?=$booking['first_name'] . " " . $booking['last_name']?></td>
                                <td><?=$booking['journey_start_date']?></td>
                                <td><?=$booking['pick_up_location']?></td>
                                <td><?=$booking['drop_off_location']?></td>
                                <td>
                                    <select class="form-control" name="driver_id" id="driver_id">
                                        <option value="">Select Driver</option>
                                        <?php foreach ($drivers as $driver): ?>
                                            <option value="<?=$driver['id']?>"><?=$driver['first_name'] . " " . $driver['last_name']?></option>
                                        <?php endforeach?>
                                    </select>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center align-items-center" id="btn">
                                        <button type="button" data-id="<?=$booking['id']?>" class="btn btn-success raised d-flex text-dark text-nowrap" title="assign Driver" id="driver_assign_btn"><i class="material-icons-outlined me-1">add_task</i> Assign Driver</button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

 <!-- script -->
<script>
    $(function(){
        let driver_id;

        // get the selected driver id
        $("tbody").on("change", "#driver_id", function(){
            driver_id = $(this).val();
        });

        // Assign Driver
        $("tbody").on("click", "#driver_assign_btn", function(){
            const booking_id = $(this).data("id");

            $.ajax({
               url: "<?php echo $base_url ?>/api/bookings/assign_driver",
               type: "POST",
               data: {
                driver_id,
                booking_status_id: 3,
                booking_id
               },
               success: function(res) {
                 const result = JSON.parse(res);
                 if(result?.result){
                    window.location.reload(true);
                 }
               },
               error: function(error) {
                 console.error(error);
               }
            });

        });
    })
</script>