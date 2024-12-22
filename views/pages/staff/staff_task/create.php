<?php

    $mechanics_and_cleaners = Staff::get_all_mechanics_and_cleaners();
    $all_task_status = TaskStatus::get_all_task_status();
    $vehicles = Vehicle::get_vehicles();

?>


<div class="row">
    <div class="col-12 col-xl-12 mx-auto">
        <div class="card rounded-4 border-top border-4 border-primary border-gradient-1">
            <div class="card-body p-4">
                <div class="d-flex align-items-start justify-content-between mb-3">
                    <div class="">
                        <h5 class="mb-4 fw-bold">Assign Task To Staff</h5>
                    </div>
                </div>
                <form                      <?php echo $base_url ?>/staff_task/save" method="POST" class="row g-4">
                    <div class="col-md-12">
                        <label for="input1" class="form-label">Assign To</label>
                        <select name="assign_to" id="input1" class="form-select">
                            <option value="">Select Staff</option>
                            <?php foreach ($mechanics_and_cleaners as $staff): ?>
                                <option value="<?=$staff['id'];?>"><?=$staff['first_name'] . " " . $staff['last_name'];?></option>
                            <?php endforeach?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="vehicle_no" class="form-label">Vehicle No</label>
                        <select name="vehicle_no" id="vehicle_no" class="form-select">
                            <option value="">Select Vehicle</option>
                            <?php foreach ($vehicles as $vehicle): ?>
                                <option value="<?=$vehicle['license_no'];?>"><?=$vehicle['vehicle_name'] . "-" . $vehicle['license_no'];?></option>
                            <?php endforeach?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="input2" class="form-label">Task Status</label>
                        <select name="task_status" id="input2" class="form-select">
                            <option value="">Select Task Status</option>
                            <?php foreach ($all_task_status as $status): ?>
                                <option value="<?=$status['id'];?>"><?=$status['task_status_name'];?></option>
                            <?php endforeach?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="input3" class="form-label">Task Assign Date</label>
                        <input type="date" name="assign_date" class="form-control" id="input3">
                    </div>
                    <div class="col-md-6">
                        <label for="input4" class="form-label">Task Deadline Date</label>
                        <input type="date" name="deadline_date" class="form-control" id="input4">
                    </div>
                    <div class="col-md-12">
                        <label for="input5" class="form-label">Task Description</label>
                        <textarea name="description" rows="3" class="form-control" id="input5"></textarea>
                    </div>
                    <div class="col-md-12">
                        <div class="d-md-flex d-grid align-items-center gap-3">
                            <button type="submit" name="create" class="btn btn-grd-primary px-4 text-white">Assign Task</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>