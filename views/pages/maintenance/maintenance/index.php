<?php
    $owner_id = $_SESSION['owner_id'];
    $driver_id = $_SESSION['driver_id'];
    if ($owner_id) {
        $maintenance_request = Maintenance::get_maintenance_records_by_owner_id($owner_id);
    } else if ($driver_id) {
        $maintenance_request = Maintenance::get_maintenance_records_by_driver_id($driver_id);
    } else {
        $maintenance_request = Maintenance::get_maintenance_records();
    }

?>

<div class="row">
    <div class="col-xl-12">
            <h6 class="mb-0 text-uppercase">All Maintenance Requests</h6>
        <hr>
        <div class="card">
            <div class="card-body">
                <table class="table mb-0 table-hover align-middle">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">ID</th>
                            <th scope="col">Maintenance Vehicle</th>
                            <th scope="col">Driver Name</th>
                            <th scope="col">Description</th>
                            <th scope="col">Cost</th>
                            <th scope="col">Request Date</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($maintenance_request as $request): ?>
                            <tr class="text-center">
                                <th scope="row"><?=$request['id']?></th>
                                <td><?=$request['vehicle_name']?></td>
                                <td><?=User::get_user_by_driver_id($request['driver_id'])->full_name;?></td>
                                <td id="description"><?=$request['description']?></td>
                                <td id="amount"><?=$request['cost']?></td>
                                <td>
                                    <?=date("F j,Y", strtotime(explode(" ", $request['created_at'])[0]))?>
                                </td>
                                <td>
                                    <span class="badge text-dark <?=$request['status'] == 'Pending' ? "bg-warning" : "bg-success"?>"><?=$request['status']?></span>
                                </td>
                                <td>
                                    <?php if (($_SESSION['urole'] == 'Admin' || $_SESSION['urole'] == 'Driver') && $request['status'] == 'Pending'): ?>
                                    <a class="btn btn-sm text-warning" href="/maintenance/edit/<?=$request['id']?>" title="Edit">
                                        <i class="material-icons-outlined">edit</i>
                                    </a>
                                    <?php elseif (($_SESSION['urole'] == 'Admin' || $_SESSION['urole'] == 'Driver') && ($request['status'] == 'Processing' || $request['status'] == 'Completed')): ?>
                                    <button <?=$request['status'] == 'Completed' ? "disabled" : ""?> class="btn btn-sm bg-success border-0 outline-none" id="complete_btn" data-id="<?=$request['id']?>" data-vehicle-id="<?=$request['vehicle_id']?>"><?=$request['status'] == 'Processing' ? "Complete" : "Completed"?></button>
                                    <?php elseif ($_SESSION['urole'] == 'Owner'): ?>
                                    <button <?=$request['status'] == 'Confirm' ? "disabled" : ""?> class="btn btn-sm bg-success" id="confirm_btn" data-id="<?=$request['id']?>" data-vehicle-id="<?=$request['vehicle_id']?>"><?=$request['status'] == 'Pending' ? "Confirm" : "Confirmed"?></button>
                                    <button class="btn btn-sm bg-danger">Reject</button>
                                    <?php endif;?>
                                </td>
                            </tr>
                        <?php endforeach?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $(function(){
        $("tbody").on("click", "#confirm_btn", function(){
            const maintenance_id = $(this).data("id");
            const vehicle_id = $(this).data("vehicle-id");
            const description = $("#description").text();
            const amount = $("#amount").text();

            // console.log(maintenance_id, vehicle_id, status_name, description, amount);

            $.ajax({
                url: "<?=$base_url?>/api/maintenancestatus/get_maintenance_status_id",
                type: "GET",
                data: {
                    status_name: "Processing"
                },
                success: function(response) {
                    const status_id = JSON.parse(response).status_id;

                    $.ajax({
                        url: "<?=$base_url?>/api/maintenance/update_maintenance_status",
                        type: "POST",
                        data: {
                            maintenance_id: maintenance_id,
                            status_id: status_id
                        },
                        success: function(response) {
                            const result = JSON.parse(response).success;
                            if(result) {
                                $.ajax({
                                   url: "<?=$base_url?>/api/expense/create_expense",
                                   type: "POST",
                                   data: {
                                    vehicle_id,
                                    expense_type: "maintenance",
                                    amount,
                                    description,
                                    maintenance_id
                                   },
                                   success: function(res) {
                                     const expense_result = JSON.parse(res).success;
                                     if(expense_result){
                                        location.reload();
                                     }
                                   },
                                   error: function(error) {
                                     console.error(error);
                                   }
                                });
                            } else {
                                alert("Failed to confirm maintenance request");
                            }
                        }
                    });
                }
            });
        });

        $("tbody").on("click", "#complete_btn", function(){
            const maintenance_id = $(this).data("id");
            const vehicle_id = $(this).data("vehicle-id");

            $.ajax({
                url: "<?=$base_url?>/api/maintenancestatus/get_maintenance_status_id",
                type: "GET",
                data: {
                    status_name: "Completed"
                },
                success: function(response) {
                    const status_id = JSON.parse(response).status_id;

                    $.ajax({
                        url: "<?=$base_url?>/api/maintenance/update_maintenance_status",
                        type: "POST",
                        data: {
                            maintenance_id: maintenance_id,
                            status_id: status_id
                        },
                        success: function(response) {
                            const result = JSON.parse(response).success;
                            if(result) {
                                location.reload();
                            } else {
                                alert("Failed to complete maintenance request");
                            }
                        }
                    });
                }
            });
        });
    });
</script>