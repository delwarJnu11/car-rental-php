<?php

    $payments = Payment::get_payments();

    $sl = 1;
    // echo "<pre>";
    // print_r($payments);

?>

<div class="row">
    <div class="col-xl-12">
        <h6 class="mb-0 text-uppercase">All Payments</h6>
        <hr>
        <div class="card shadow">
            <div class="card-body">
                <table class="table table-bordered table-striped table-hover align-middle">
                    <thead class="table-dark">
                        <tr class="text-center">
                            <th scope="col">SL.</th>
                            <th scope="col">Vehicle Name</th>
                            <th scope="col">Customer Name</th>
                            <th scope="col">Rent Amount</th>
                            <th scope="col">Paid Amount</th>
                            <th scope="col">Due Amount</th>
                            <th scope="col">payment Method</th>
                            <th scope="col">payment Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($payments as $payment): ?>
                            <tr class="text-center">
                                <td><?=$sl++?></td>
                                <td><?=$payment['vehicle_name']?></td>
                                <td><?=$payment['first_name'] . " " . $payment['last_name']?></td>
                                <td><?=$payment['net_payable_amount']?></td>
                                <td><?=$payment['paid_amount']?></td>
                                <td><?=$payment['due_amount']?></td>
                                <td>cash</td>
                                <td><span class="badge px-2 py-1 fs-6 <?=$payment['payment_status'] == "Paid" ? "bg-success" : "bg-grd-primary"?>"><?=$payment['payment_status']?></span></td>
                            </tr>
                        <?php endforeach?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>