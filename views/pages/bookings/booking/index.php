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
                            <th scope="col">Vehicle</th>
                            <th scope="col">Pick Up</th>
                            <th scope="col">Drop Off</th>
                            <th scope="col">Booking Status</th>
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
                                <td><?= $booking['vehicle_name'] ?></td>
                                <td><?= $booking['pick_up_location'] ?></td>
                                <td><?= $booking['drop_off_location'] ?></td>
                                <td><?= $booking["status_name"] ?></td>
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
<div
    class="modal fade"
    id="detailsModal"
    tabindex="-1"
    aria-labelledby="customModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5
                    class="modal-title"
                    id="customModalLabel">
                    Booking Details
                </h5>
                <a href="javascript:;" class="primaery-menu-close" data-bs-dismiss="modal">
                    <i class="material-icons-outlined">close</i>
                </a>
            </div>
            <div class="modal-body" id="modal_body">
                    
            </div>
            <div class="modal-footer border-top-0">
                <button type="button" class="btn btn-grd-danger" data-bs-dismiss="modal">Delete</button>
                <button type="button" class="btn btn-grd-info">Save changes</button>
            </div>
        </div>
    </div>
</div>


<script src="<?php echo $base_url?>/js/helper.js"></script>


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
                        <div class="row">
                            <div class="col-md-6 border-r mr-3">
                                <div class="booking-info p-2">
                                    <h6 class="mb-4">Booking Info</h6>
                                    <div class="mb-2">
                                        <strong>Pick Up Location:</strong> ${booking.pick_up_location}
                                    </div>
                                    <div class="mb-2">
                                        <strong>Drop Off Location:</strong> ${booking.drop_off_location}
                                    </div>
                                    <div class="mb-2">
                                        <strong>Journey Start Date:</strong> ${formated_date(booking.journey_start_date)}
                                    </div>
                                    <div class="mb-2">
                                        <strong>Journey End Date:</strong> ${formated_date(booking.journey_end_date)}
                                    </div>
                                    <div class="mb-2">
                                        <strong>Rent Price:</strong> ${booking.rent_amount}
                                    </div>
                                    <div class="mb-2">
                                        <strong>Duration:</strong> ${booking.duration} ${booking.duration.includes("Days") ? "":"Hours"}
                                    </div>
                                    <div class="mb-2">
                                        <strong>Advance Payment:</strong> ${booking.paid_amount}
                                    </div>
                                    <div class="mb-2">
                                        <strong>Discount Amount:</strong> ${booking.discount_amount}
                                    </div>
                                    <div class="mb-2">
                                        <strong>Due Amount:</strong> ${booking.due_amount}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="customer-info p-2">
                                    <h6 class="mb-4">Customer Info</h6>
                                    <div class="mb-2">
                                        <strong>Customer Name:</strong> ${booking.first_name} ${booking.last_name}
                                    </div>
                                    <div class="mb-2">
                                        <strong>Customer Email:</strong> ${booking.email}
                                    </div>
                                    <div class="mb-2">
                                        <strong>Customer Phone:</strong> ${booking.phone}
                                    </div>
                                    <div class="mb-2">
                                        <strong>Customer Address:</strong> House No - ${booking.house_no}, Road No - ${booking.road_no}, ${booking.city} - ${booking.postal_code}
                                    </div>
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