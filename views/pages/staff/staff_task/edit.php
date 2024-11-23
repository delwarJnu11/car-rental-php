<?php

$all_staff = Staff::get_all_staff();

print_r($all_staff);
print_r($single_task);

?>


<div class="row">
    <div class="col-12 col-xl-12 mx-auto">
        <div class="card rounded-4 border-top border-4 border-primary border-gradient-1">
            <div class="card-body p-4">
                <div class="d-flex align-items-start justify-content-between mb-3">
                    <div class="">
                        <h5 class="mb-4 fw-bold">Update Task</h5>
                    </div>
                </div>
                <form action="/staff_task/update" method="POST" class="row g-4">
                    <div class="col-md-6">
                        <label for="input1" class="form-label">Assign To</label>
                        <select name="assign_to" id="input1" class="form-select">
                            <option value="">Select Staff</option>
                            <?php foreach ($all_staff as $staff): ?>
                                <option <?= $single_task->task_assign_to_staff_id === $staff['id'] ? "selected" : "" ?> value="<?= $staff['id']; ?>"><?= $staff['first_name'] . " " . $staff['last_name']; ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="input3" class="form-label">Task Assign Date</label>
                        <input type="date" name="assign_date" value="<?= $single_task->task_assign_date ?>" class="form-control" id="input3">
                    </div>
                    <div class="col-md-6">
                        <label for="input4" class="form-label">Task Deadline Date</label>
                        <input type="date" name="deadline_date" value="<?= $single_task->task_deadline_date ?>" class="form-control" id="input4">
                    </div>
                    <div class="col-md-12">
                        <label for="input5" class="form-label">Task Description</label>
                        <textarea name="description" value="<?= $single_task->description ?>" rows="3" class="form-control" id="input5"></textarea>
                    </div>
                    <div class="col-md-12">
                        <div class="d-md-flex d-grid align-items-center gap-3">
                            <button type="submit" name="update" class="btn btn-grd-primary px-4 text-white">Update Task</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>