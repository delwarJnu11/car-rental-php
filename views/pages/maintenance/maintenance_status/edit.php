<?php

    $maintenance_status = MaintenanceStatus::get_single_status("id", $_GET['id']);

    // echo "<pre>";
    // print_r($maintenance_status);
    // die;

?>

<div class="row">
    <div class="col-12 col-xl-12 mx-auto">
        <div class="card rounded-4 border-top border-4 border-primary border-gradient-1">
            <div class="card-body p-4">
                <div class="d-flex align-items-start justify-content-between mb-3">
                    <div class="">
                        <h5 class="mb-4 fw-bold">Update Maintenance Status</h5>
                    </div>
                </div>
                <form action="<?php echo $base_url ?>/maintenance_status/update" method="POST" class="row g-4">
                    <input type="hidden" name="id" value="<?=$maintenance_status['id']?>">
                    <div class="col-md-12">
                        <label for="input1" class="form-label">Maintenance Status</label>
                        <input type="text" name="name" class="form-control" id="input1" value="<?=$maintenance_status['name']?>">
                    </div>
                    <div class="col-md-12">
                        <div class="d-md-flex d-grid align-items-center gap-3">
                            <button type="submit" name="update" class="btn btn-grd-primary px-4 text-white">Update Maintenance Status</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>