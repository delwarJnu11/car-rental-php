<?php

    $bookings = Booking::get_bookings();

?>

<div class="row">
    <div class="col-xl-12">
        <div class="d-flex justify-content-between align-items-center">
            <h6 class="mb-0 text-uppercase">All Bookings</h6>
            <a href="<?=$base_url?>/booking/create" class="btn btn-grd-primary text-white px-4 py-2">Make a Booking</a>
        </div>
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
                                    <img width="60" height="60" class="bg-grd-warning rounded-circle" src="<?=$base_url?>/img/customers/<?=$booking['image']?>" alt="">
                                </td>
                                <td><?=$booking['first_name'] . " " . $booking['last_name']?></td>
                                <td><?=$booking['vehicle_name']?></td>
                                <td><?=$booking['pick_up_location']?></td>
                                <td><?=$booking['drop_off_location']?></td>
                                <td>
                                    <span class="badge text-dark <?=$booking["status_name"] == "Confirm" || $booking["status_name"] == "Completed" ? "bg-success" : "bg-warning";?>"><?=$booking["status_name"]?></span>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center align-items-center gap-2" id="btn" style="height: 100%;">
                                        <a
                                            class="btn btn-warning raised d-flex gap-2"
                                            href="/booking/edit/<?=$booking['id']?>"
                                            title="Edit Booking">
                                            <i class="material-icons-outlined">edit</i>
                                        </a>
                                        <button
                                            class="btn btn-info raised d-flex gap-2"
                                            id="booking_details_btn"
                                            data-bs-toggle="modal"
                                            data-id="<?=$booking['id'];?>" data-bs-target="#detailsModal"
                                            title="View Details">
                                            <i class="material-icons-outlined">visibility</i>
                                        </button>
                                        <!-- <button type="button" class="btn btn-success raised d-flex gap-2 text-dark" title="Print Invoice"><i class="material-icons-outlined">print</i></button> -->
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

<style>
    @media print {

        /* Hide everything outside the modal */
        body * {
            visibility: hidden;
        }

        .modal-header {
            visibility: hidden !important;
        }

        /* Show and expand the modal content */
        #detailsModal,
        #detailsModal * {
            visibility: visible;
        }

        /* Ensure modal content spans full width */
        #modal_body {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            margin: 0;
            padding: 0;
        }

        .modal-content {
            border: none;
            /* Remove modal border for print */
        }

        .container {
            width: 100%;
            padding: 0;
            border: none;
            /* Remove container border for clean printing */
        }

        /* Table styling for better print layout */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th,
        table td {
            border: 1px solid #e5e5e5;
            /* Ensure borders are visible */
            padding: 8px;
            text-align: center;
        }


        tr {
            border: 1px solid #e5e5e5;
            /* Ensure borders are visible */
            padding: 8px;
            text-align: center;
        }

        /* Header and text adjustments for print */
        h2,
        h5,
        p,
        th,
        td {
            font-size: 14px;
            /* Adjust text size for print readability */
        }

        /* Background color adjustments for printing */
        .bg-warning {
            background-color: #ffc107 !important;
            /* Ensure visibility of yellow backgrounds */
            print-color-adjust: exact;
        }

        /* Hide print button and footer during print */
        #print_btn,
        #customModalLabel,
        #close-btn,
        .modal-footer {
            display: none !important;
        }

        /* Remove default print margins */
        @page {
            margin: 0;
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
                <a href="javascript:;" id="close-btn" class="primaery-menu-close" data-bs-dismiss="modal">
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

<script>
    $(function() {

        // Get Formatted Date
        function formated_date(inputDate = new Date()) {
            const date = new Date(inputDate);

            // Format the date
            const formattedDate = new Intl.DateTimeFormat("en-US", {
                month: "long",
                day: "2-digit",
                year: "numeric",
            }).format(date);

            return formattedDate;
        }

        // Get Cuurent Date
        function getCurrentDate() {
            const currentDate = new Date();

            const day = currentDate.getDate();
            const month = currentDate.getMonth() + 1;
            const year = currentDate.getFullYear();

            // Format the date as required (MMDDYYYY)
            const res = day.toString().padStart(2, "0") + month.toString().padStart(2, "0") + year.toString();
            return res;
        }

        // Get Current Time
        function getTime() {
            let currentDate = new Date();

            let hours = currentDate.getHours();
            let minutes = currentDate.getMinutes();
            let period = hours >= 12 ? 'PM' : 'AM';

            // Convert to 12-hour format
            hours = hours % 12;
            hours = hours ? hours : 12;
            minutes = minutes < 10 ? '0' + minutes : minutes;

            // Format the time as HH:MM AM/PM
            const formattedTime = hours + ':' + minutes + ' ' + period;
            return formattedTime;
        }

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
                                    <p class="mb-1"><strong>Invoice Number:</strong> INV-${getCurrentDate()}-00${booking?.id+1}</p>
                                    <p class="mb-1"><strong>Invoice Date:</strong> ${formated_date()}</p>
                                    <p class="mb-0"><strong>Invoice Time:</strong> ${getTime()}</p>
                                </div>
                            </div>

                            <!-- Customer Details -->
                            <h5 class="fs-6 fw-bold text-uppercase mt-4"><em>Billing Address</em></h5>
                            <div class="d-flex flex-column flex-md-row justify-content-between border-bottom border-warning pb-3">
                                <div>
                                    <p class="mb-1"><strong>Customer Name:</strong> ${booking?.first_name} ${booking?.last_name}</p>
                                    <p class="mb-0"><strong>Address:</strong> House No-${booking?.house_no}, Road No-${booking?.road_no}, <br>${booking.city}-${booking.postal_code}</p>
                                </div>
                                <div class="mt-3 mt-md-0">
                                    <p class="mb-1"><strong>Customer Email:</strong> ${booking?.email}</p>
                                    <p class="mb-0"><strong>Phone:</strong> ${booking?.phone}</p>
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
                                            <td>${booking?.vehicle_name}</td>
                                            <td>${formated_date(booking?.journey_start_date)} - ${formated_date(booking?.journey_end_date)}</td>
                                            <td>${booking?.rent_amount}</td>
                                            <td>${booking?.duration}</td>
                                            <td>${booking?.rent_amount}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3"></td>
                                            <td>Discount</td>
                                            <td>${booking?.discount_amount}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3"></td>
                                            <th>Total</th>
                                            <td>${booking.net_payable_amount}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3"></td>
                                            <td>Paid</td>
                                            <td>${booking?.paid_amount}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3"></td>
                                            <td>Due</td>
                                            <td>${booking?.due_amount}</td>
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
        });

    })
</script>