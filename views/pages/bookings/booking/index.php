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
                                            class="btn btn-warning raised d-flex gap-2"
                                            href="/booking/edit/<?= $booking['id'] ?>"
                                            title="Edit Booking">
                                            <i class="material-icons-outlined">edit</i>
                                        </a>
                                        <button
                                            class="btn btn-info raised d-flex gap-2"
                                            id="booking_details_btn"
                                            data-bs-toggle="modal"
                                            data-id="<?= $booking['id']; ?>" data-bs-target="#detailsModal"
                                            title="View Details">
                                            <i class="material-icons-outlined">visibility</i>
                                        </button>
                                        <button type="button" class="btn btn-success raised d-flex gap-2 text-dark" title="Print Invoice"><i class="material-icons-outlined">print</i></button>
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

<style>
@media print {
    body * {
        visibility: hidden;
    }

    #modal_body, #modal_body * {
        visibility: visible; 
    }

    #modal_body {
        width: 100%;
    }
}
</style>


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
                <button id="print_btn" onclick="window.print();" type="button" class="btn btn-grd-info d-flex align-items-center"><i class="material-icons-outlined">print</i> Print</button>
            </div>
        </div>
    </div>
</div>



<script src="<?php echo $base_url ?>/js/helper.js"></script>

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
                        <div class="container mx-auto border border-3 border-warning p-4 rounded">
                            <!-- Header -->
                            <div class="d-flex align-items-center justify-content-center mb-4">
                                <div class="bg-warning skew-right" style="width: 40%; height: 36px; transform: skew(-30deg);"></div>
                                <h2 class="text-center fs-4 text-uppercase mx-2 mb-0">
                                    <em>Invoice</em>
                                </h2>
                                <div class="bg-warning skew-right" style="width: 40%; height: 36px; transform: skew(-30deg);"></div>
                            </div>

                            <!-- Company Details and Invoice Info -->
                            <div class="d-flex flex-column flex-md-row justify-content-between border-bottom border-warning pb-3">
                                <div>
                                    <h5 class="fs-6 fw-bold text-uppercase"><em>Easy Rent Agency</em></h5>
                                    <p class="mb-1"><strong>Address:</strong> Nizam Shankar Plaza, Shankar, <br>Dhanmondi, Dhaka-1208</p>
                                    <p class="mb-1"><strong>Email:</strong> easyrent@gmail.com</p>
                                    <p class="mb-0"><strong>Phone:</strong> +88 01749-497676</p>
                                </div>
                                <div class="mt-3 mt-md-0">
                                    <h5 class="fs-6 fw-bold text-uppercase"><em>Invoice Details</em></h5>
                                    <p class="mb-1"><strong>Invoice Number:</strong> INV-4122024-0001</p>
                                    <p class="mb-1"><strong>Invoice Date:</strong> December 4, 2024</p>
                                    <p class="mb-0"><strong>Invoice Time:</strong> 5.00 PM</p>
                                </div>
                            </div>

                            <!-- Customer Details -->
                            <h5 class="fs-6 fw-bold text-uppercase mt-4"><em>Billing Address</em></h5>
                            <div class="d-flex flex-column flex-md-row justify-content-between border-bottom border-warning pb-3">
                                <div>
                                    <p class="mb-1"><strong>Customer Name:</strong> Nizam Shankar</p>
                                    <p class="mb-0"><strong>Address:</strong> Nizam Shankar Plaza, Shankar, <br>Dhanmondi, Dhaka-1208</p>
                                </div>
                                <div class="mt-3 mt-md-0">
                                    <p class="mb-1"><strong>Customer Email:</strong> nizam_shankar@gmail.com</p>
                                    <p class="mb-0"><strong>Phone:</strong> +88 01749-497676</p>
                                </div>
                            </div>

                            <!-- Rental Details -->
                            <h5 class="fs-6 fw-bold text-uppercase mt-4"><em>Rental Details</em></h5>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="bg-warning">
                                        <tr>
                                            <th class="text-dark text-center"><em>Vehicle</em></th>
                                            <th class="text-dark text-center"><em>Rental Period</em></th>
                                            <th class="text-dark text-center"><em>Rate/<sub>Day</sub></em></th>
                                            <th class="text-dark text-center"><em>Duration</em></th>
                                            <th class="text-dark text-center"><em>Rent Amount</em></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Honda Civic</td>
                                            <td>December 14, 2023 - December 16, 2023</td>
                                            <td>20,000.00</td>
                                            <td>3</td>
                                            <td>20,000.00</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3"></td>
                                            <td>Subtotal</td>
                                            <td>20,000.00</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3"></td>
                                            <td>Discount</td>
                                            <td>2,000.00</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3"></td>
                                            <td>Total</td>
                                            <td>18,000.00</td>
                                        </tr>
                                    </tbody>
                                </table>
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

        // $("#print_btn").on("click", function() {
        //     $("#modal_body").print();
        // });
        
    })
</script>