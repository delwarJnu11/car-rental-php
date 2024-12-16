<?php

    $all_payment_status = PaymentStatus::get_all_payment_status();

?>

<div class="row">
    <div class="col-xl-12">
        <div class="d-flex justify-content-between align-items-center">
            <h6 class="mb-0 text-uppercase">All Payment Status</h6>
            <a class="btn btn-grd-primary px-4 text-white d-flex align-items-center gap-2" href="<?=$base_url?>/payment_status/create">
                <i class="material-icons-outlined">add_circle</i>
                Add Status</a>
        </div>
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
                        <?php foreach ($all_payment_status as $status): ?>
                            <tr class="text-center">
                                <th scope="row"><?=$status['id']?></th>
                                <td><?=$status['payment_status']?></td>
                                <td>
                                    <?=date("g:i a", strtotime(explode(" ", $status['created_at'])[1]))?>
                                </td>
                                <td>
                                    <?=date("F j,Y", strtotime(explode(" ", $status['created_at'])[0]))?>
                                </td>
                                <td>
                                    <a class="btn btn-sm text-warning" href="/payment_status/edit/<?=$status['id']?>" title="Edit">
                                        <i class="material-icons-outlined">edit</i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>