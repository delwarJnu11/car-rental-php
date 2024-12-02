<?php

$bookings = Booking::get_bookings();
// echo "<pre>";
// print_r($bookings);

?>

<div class="row">
    <div class="col-xl-12">
        <h6 class="mb-0 text-uppercase">All Bookings</h6>
        <hr>
        <div class="card shadow">
            <div class="card-body">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-dark">
                        <tr class="text-center">
                            <th scope="col">Image</th>
                            <th scope="col">Customer Name</th>
                            <th scope="col">Customer Email</th>
                            <th scope="col">Vehicle</th>
                            <th scope="col">Pick Up</th>
                            <th scope="col">Drop Off</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($bookings as $booking): ?>
                            <tr class="text-center">
                                <td>
                                    <img width="60" height="60" class="bg-grd-warning rounded-circle" src="<?= $base_url ?>/img/customers/<?= $booking['image'] ?>" alt="">
                                </td>
                                <td><?= $booking['first_name'] . " " . $booking['last_name'] ?></td>
                                <td><?= $booking["email"] ?></td>
                                <td><?= $booking['vehicle_name'] ?></td>
                                <td><?= $booking['pick_up_location'] ?></td>
                                <td><?= $booking['drop_off_location'] ?></td>
                                <td>
                                    <div class="d-flex justify-content-center align-items-center gap-2" style="height: 100%;">
                                        <a
                                            class="btn btn-sm btn-warning text-white d-flex justify-content-center align-items-center gap-2"
                                            href="/booking/edit/<?= $booking['id'] ?>"
                                            title="Edit">
                                            <i class="material-icons-outlined">edit</i> Edit
                                        </a>
                                        <button
                                            class="btn btn-sm btn-grd-primary text-white d-flex justify-content-center align-items-center gap-2"
                                            id="booking_details_btn"
                                            data-bs-toggle="modal"
                                            data-id="<?= $booking['id']; ?>" data-bs-target="#detailsModal">
                                            <i class="material-icons-outlined">visibility</i> Details
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- modal start -->
<div class="modal fade" id="detailsModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-bottom-0 py-2">
                <h5 class="modal-title">Booking Details</h5>
                <a href="javascript:;" class="primaery-menu-close" data-bs-dismiss="modal">
                    <i class="material-icons-outlined">close</i>
                </a>
            </div>
            <div class="modal-body">
                <div class="card">
                    <img class="card-img-top" src="..." alt="Card image cap">
                    <div class="card-body">
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-top-0">
                <button type="button" class="btn btn-grd-danger" data-bs-dismiss="modal">Delete</button>
                <button type="button" class="btn btn-grd-info">Save changes</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(function() {
        $("#booking_details_btn").on("click", function() {
            const id = $(this).data("id");
            console.log(id);
        })
    })
</script>