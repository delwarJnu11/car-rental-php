<?php

$bookings = Booking::get_bookings();

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
                                    <div class="d-flex justify-content-center align-items-center gap-2" id="btn" style="height: 100%;">
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
<div class="modal fade" id="detailsModal" tabindex="-1" aria-labelledby="detailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header border-bottom-0 py-3">
                <h5 class="modal-title fw-bold" id="detailsModalLabel">Booking Details</h5>
                <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body" id="modal_body">
                <!-- Vehicle Image -->
                <div class="text-center mb-4">
                    <img class="rounded img-fluid" style="max-width: 60%; height: auto;" src="<?php $base_url ?>/img/vehicle/${booking.image}" alt="Vehicle Image">
                </div>
                <!-- Booking and Customer Details -->
                <div class="card shadow-sm p-4 bg-dark text-white">
                    <div class="row">
                        <!-- Booking Details -->
                        <div class="col-md-6 mb-3">
                            <h6 class="fw-bold mb-3">Booking Details</h6>
                            <div class="mb-2">
                                <strong>Pick Up Location:</strong> Mohammadpur
                            </div>
                            <div class="mb-2">
                                <strong>Drop Off Location:</strong> Gazipur
                            </div>
                            <div class="mb-2">
                                <strong>Journey Start Date:</strong> December 07, 2024
                            </div>
                            <div class="mb-2">
                                <strong>Journey End Date:</strong> December 08, 2024
                            </div>
                            <div class="mb-2">
                                <strong>Rent Price:</strong> 500.00
                            </div>
                            <div class="mb-2">
                                <strong>Advance Payment:</strong> 100.00
                            </div>
                            <div class="mb-2">
                                <strong>Discount Amount:</strong> 10.00
                            </div>
                            <div class="mb-2">
                                <strong>Due Amount:</strong> 390.00
                            </div>
                        </div>
                        <!-- Customer Info -->
                        <div class="col-md-6">
                            <h6 class="fw-bold mb-3">Customer Info</h6>
                            <div class="mb-2">
                                <strong>Customer Name:</strong> Mr Liton Kumar Das
                            </div>
                            <div class="mb-2">
                                <strong>Customer Email:</strong> liton_das@gmail.com
                            </div>
                            <div class="mb-2">
                                <strong>Customer Phone:</strong> 015-222-999
                            </div>
                            <div class="mb-2">
                                <strong>Customer Address:</strong> Mohammadpur, Dhaka-1205
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal Footer -->
            <div class="modal-footer border-top-0 d-flex justify-content-between">
                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Delete</button>
                <button type="button" class="btn btn-primary">Save Changes</button>
            </div>
        </div>
    </div>
</div>





<script>
    $(function() {
        $("table").on("click", "#booking_details_btn", function() {
            const id = $(this).data("id");
            $.ajax({
                url: "<?php echo $base_url ?>/api/bookings/booking",
                type: "GET",
                data: {
                    id
                },
                success: function(res) {
                    const booking = res.booking;
                    console.log(booking)
                    const booking_details_card = `
                        <div class="card mb-4 shadow-sm">
                            <img class="card-img-top rounded" src="<?php $base_url ?>/img/vehicle/${booking.image}" alt="Vehicle Image">
                        </div>
                        <!-- Booking Details -->
                        <div class="card shadow-sm d-flex gap-4">
                            <div class="card-body">
                                <h6 class="fw-bold mb-3">Booking Details</h6>
                                <div class="mb-2">
                                    <strong>Pick Up Location:</strong> Mohammadpur
                                </div>
                                <div class="mb-2">
                                    <strong>Drop Off Location:</strong> Gazipur
                                </div>
                                <div class="mb-2">
                                    <strong>Journey Start Date:</strong> December 07, 2024
                                </div>
                                <div class="mb-2">
                                    <strong>Journey End Date:</strong> December 08, 2024
                                </div>
                                <div class="mb-2">
                                    <strong>Rent Price:</strong> 500.00
                                </div>
                                <div class="mb-2">
                                    <strong>Advance Payment:</strong> 100.00
                                </div>
                                <div class="mb-2">
                                    <strong>Discount Amount:</strong> 10.00
                                </div>
                                <div class="mb-3">
                                    <strong>Due Amount:</strong> 390.00
                                </div>
                            </div>
                            <div class="card-body">
                                <h6 class="fw-bold mb-3">Customer Info</h6>
                                <div class="mb-2">
                                    <strong>Customer Name:</strong> Mr Liton Kumar Das
                                </div>
                                <div class="mb-2">
                                    <strong>Customer Email:</strong> liton_das@gmail.com
                                </div>
                                <div class="mb-2">
                                    <strong>Customer Phone:</strong> 015-222-999
                                </div>
                                <div>
                                    <strong>Customer Address:</strong> Mohammadpur, Dhaka-1205
                                </div>
                            </div>
                        </div>
                    `;
                    // append card in the modal body
                    $("#modal_body").html(booking_details_card);
                },
                error: function(error) {
                    console.error(error);
                }
            });
        })
    })
</script>