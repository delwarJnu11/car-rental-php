<?php

$all_task_status = TaskStatus::get_all_task_status();

?>

<div class="row">
    <div class="col-xl-12">
        <h6 class="mb-0 text-uppercase">All Tasks</h6>
        <hr>
        <div class="card">
            <div class="card-body">
                <table class="table mb-0 table-hover align-middle">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">ID</th>
                            <th scope="col">Task Status</th>
                            <th scope="col">Time</th>
                            <th scope="col">Date</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($all_task_status as $task): ?>
                            <tr class="text-center">
                                <th scope="row"><?= $task['id'] ?></th>
                                <td><?= $task['task_status_name'] ?></td>
                                <td>
                                    <?= date("g:i a", strtotime(explode(" ", $task['created_at'])[1])) ?>
                                </td>
                                <td>
                                    <?= date("F j,Y", strtotime(explode(" ", $task['created_at'])[0]))
                                    ?>
                                </td>
                                <td>
                                    <a class="btn btn-sm text-warning" href="/task_status/edit/<?= $task['id'] ?>" title="Edit">
                                        <i class="material-icons-outlined">edit</i>
                                    </a>
                                    <a class="btn btn-sm text-danger" href="/task_status/delete/<?= $task['id'] ?>" title="Delete">
                                        <i class="material-icons-outlined">delete</i>
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