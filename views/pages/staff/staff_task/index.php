<?php
$tasks = StaffTask::get_tasks();
?>

<div class="row">
    <div class="col-xl-12">
        <h6 class="mb-0 text-uppercase">All Tasks</h6>
        <hr>
        <div class="card">
            <div class="card-body">
                <table class="table mb-0 table-hover align-middle">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Assign By</th>
                            <th scope="col">Assign To</th>
                            <th scope="col">Assign Date</th>
                            <th scope="col">Deadline</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($tasks as $task): ?>
                            <tr>
                                <td><?= $task['id'] ?></td>
                                <td><?= $task['ufname'] . " " . $task['ulname'] ?></td>
                                <td><?= $task['first_name'] . " " . $task['last_name'] ?></td>
                                <td><?= $task['task_assign_date'] ?></td>
                                <td><?= $task['task_completion_date'] ?></td>
                                <td><?= $task['task_status_name'] ?></td>
                                <td>
                                    <a class="btn btn-sm text-warning" href="/staff_task/edit/<?= $task['id'] ?>" title="Edit">
                                        <i class="material-icons-outlined">edit</i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>