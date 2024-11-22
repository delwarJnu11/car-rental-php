<?php

$all_salary_status = SalaryStatus::get_all_salary_status();

?>

<div class="row">
    <div class="col-xl-12">
        <h6 class="mb-0 text-uppercase">All Designation</h6>
        <hr>
        <div class="card">
            <div class="card-body">
                <table class="table mb-0 table-hover align-middle">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">ID</th>
                            <th scope="col">Salary Status</th>
                            <th scope="col">Time</th>
                            <th scope="col">Date</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($all_salary_status as $status): ?>
                            <tr class="text-center">
                                <th scope="row"><?= $status['id'] ?></th>
                                <td><?= $status['salary_status_name'] ?></td>
                                <td>
                                    <?= date("g:i a", strtotime(explode(" ", $status['created_at'])[1])) ?>
                                </td>
                                <td>
                                    <?= date("F j,Y", strtotime(explode(" ", $status['created_at'])[0]))
                                    ?>
                                </td>
                                <td>
                                    <a class="btn btn-sm text-warning" href="/salary_status/edit/<?= $status['id'] ?>" title="Edit">
                                        <i class="material-icons-outlined">edit</i>
                                    </a>
                                    <a class="btn btn-sm text-danger" href="/salary_status/delete/<?= $status['id'] ?>" title="Delete">
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