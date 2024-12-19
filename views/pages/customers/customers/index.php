<?php

$customers = Customer::get_customers();

// echo "<pre>";
// print_r($customers);

?>

<div class="row">
    <div class="col-xl-12">
        <div class="d-flex justify-content-between align-items-center">
            <h6 class="mb-0 text-uppercase">All Customers</h6>
            <a href="<?=$base_url?>/customers/create" class="btn btn-grd-primary text-white px-4 py-2">Add Customer</a>
        </div>
        <hr>
        <div class="card shadow">
            <div class="card-body">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-dark">
                        <tr class="text-center">
                            <th scope="col">Image</th>
                            <th scope="col">Customer Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone</th>
                            <th scope="col">City</th>
                            <th scope="col">Country</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($customers as $customer): ?>
                            <tr class="text-center">
                                <td>
                                    <img width="60" height="60" class="bg-grd-warning rounded-circle" src="<?=$base_url?>/img/customers/<?=$customer['image']?>" alt="">
                                </td>
                                <td><?=$customer['first_name'] . " " . $customer['last_name']?></td>
                                <td><?=$customer['email']?></td>
                                <td><?=$customer['phone']?></td>
                                <td><?=$customer['city']?></td>
                                <td><?=$customer["country"]?></td>
                                <td>
                                    <div class="d-flex justify-content-center align-items-center gap-2" id="btn" style="height: 100%;">
                                        <a
                                            class="btn btn-warning raised d-flex gap-2"
                                            href="/customers/edit/<?=$customer['id']?>"
                                            title="Edit Booking">
                                            <i class="material-icons-outlined">edit</i>
                                        </a>
                                        <button
                                            class="btn btn-info raised d-flex gap-2"
                                            id="booking_details_btn"
                                            data-bs-toggle="modal"
                                            data-id="<?=$customer['id'];?>" data-bs-target="#detailsModal"
                                            title="View Details">
                                            <i class="material-icons-outlined">visibility</i>
                                        </button>
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