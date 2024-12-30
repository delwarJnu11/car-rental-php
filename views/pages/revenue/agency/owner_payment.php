<?php
    $owners = Owner::get_owners();
?>
<div class="row mb-4">
    <h6 class="mb-4 text-uppercase">Owner Payment</h6>
    <hr>
    <!-- Select Owner -->
    <div class="col-md-4">
        <label for="owner_id" class="form-label">Select Owner</label>
        <select id="owner_id" class="form-select">
            <option value="">Select Owner</option>
            <?php foreach ($owners as $owner): ?>
                <option value="<?=$owner['id']?>"><?=$owner['first_name'] . " " . $owner['last_name']?></option>
            <?php endforeach;?>
        </select>
    </div>

    <!-- From Date -->
    <div class="col-md-4">
        <label for="from-date" class="form-label">Choose From Date</label>
        <input type="date" id="from-date" class="form-control" placeholder="From Date">
    </div>

    <!-- To Date -->
    <div class="col-md-4">
        <label for="to-date" class="form-label">Choose To Date</label>
        <input type="date" id="to-date" class="form-control" placeholder="To Date">
    </div>
</div>

<div class="row">
    <div class="col-md-12" id="invoice">

    </div>
</div>

<script>
    $(function() {

        // Formated date
        function format_date(date) {
            const d = new Date(date);
            const formattedDate = d.toLocaleDateString('en-GB', {
                day: '2-digit',
                month: 'short',
                year: 'numeric'
            });

            return formattedDate;
        }

        // Genertate Invoice Number
        function invNumber() {
            const currentDate = new Date();
            const inv = currentDate.getFullYear().toString() +
                String(currentDate.getMonth() + 1).padStart(2, '0') +
                String(currentDate.getDate()).padStart(2, '0');
            return inv;
        }

        // Get Current Date
        function current_date() {
            const currentDate = new Date();
            const options = {
                day: '2-digit',
                month: 'short',
                year: 'numeric'
            };
            const formattedDate = new Intl.DateTimeFormat('en-US', options).format(currentDate);
            return formattedDate;
        }

        // Get Current Time
        function getTime() {
            const currentTime = new Date();
            const hours = currentTime.getHours();
            const minutes = currentTime.getMinutes();
            const formattedTime = `${hours % 12 || 12}.${minutes.toString().padStart(2, '0')} ${hours >= 12 ? 'pm' : 'am'}`;
            return formattedTime;
        }

        const data = {};
        const paymentInfo = {};

        $("#owner_id").on("change", function() {
            data.owner_id = $(this).val();
        });
        $("#from-date").on("change", function() {
            data.from_date = $(this).val();
        });
        $("#to-date").on("change", function() {
            data.to_date = $(this).val();

            if (data.owner_id && data.from_date) {
                // fetch expenses
                const expense = $.ajax({
                    url: "<?php echo $base_url ?>/api/expense/filter_expenses_by_date_range",
                    type: "POST",
                    data: {
                        owner_id: data?.owner_id,
                        from_date: data?.from_date,
                        to_date: data?.to_date,
                    },
                    success: function(res) {
                        paymentInfo.expense = JSON.parse(res).amount;
                    },
                    error: function(error) {
                        console.error(error);
                    }
                });

                // fetch revenue
                const revenue = $.ajax({
                    url: "<?php $base_url?>/api/bookings/filter_revenue_amount_by_owner_and_date_range",
                    type: "POST",
                    data: {
                        owner_id: data?.owner_id,
                        from_date: data?.from_date,
                        to_date: data?.to_date,
                    },
                    success: function(res) {
                        paymentInfo.revenue = JSON.parse(res).amount;
                    },
                    error: function(error) {
                        console.error(error);
                    }
                });

                const owner = $.ajax({
                    url: "<?php $base_url?>/api/owners/get_owner",
                    type: "POST",
                    data: {
                        owner_id: data?.owner_id
                    },
                    success: function(res) {
                        paymentInfo.owner = JSON.parse(res).owner;
                    },
                    error: function(error) {
                        console.error(error);
                    }
                });

                // Handle Promise using Jquery
                $.when(expense, revenue, owner).done(function() {
                    // console.log(paymentInfo)
                    const commission_amount = (paymentInfo.revenue * paymentInfo.owner.commission_rate) / 100;
                    const expense = parseInt(paymentInfo.expense);
                    const total_cost = commission_amount + expense;
                    const net_earnings = paymentInfo.revenue - total_cost;
                    paymentInfo.profit = net_earnings;

                    // Append Invoice
                    $("#invoice").append(
                        `
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
                                        <p class="mb-1"><strong>Invoice Number:</strong> INV-${invNumber()}-00${paymentInfo.owner.id}</p>
                                        <p class="mb-1"><strong>Invoice Date:</strong> ${current_date()}</p>
                                        <p class="mb-0"><strong>Invoice Time:</strong> ${getTime()}</p>
                                    </div>
                                </div>

                                <!-- Customer Details -->
                                <h5 class="fs-6 fw-bold text-uppercase mt-4"><em>Billing Address</em></h5>
                                <div class="d-flex flex-column flex-md-row justify-content-between border-bottom border-warning pb-3">
                                    <div>
                                        <p class="mb-1"><strong>Customer Name:</strong> ${paymentInfo.owner.first_name} ${paymentInfo.owner.last_name}</p>
                                        <p class="mb-0"><strong>Address:</strong> Jigatola,Dhanmondi, Dhaka-1208</p>
                                    </div>
                                    <div class="mt-3 mt-md-0">
                                        <p class="mb-1"><strong>Customer Email:</strong> ${paymentInfo.owner.email}</p>
                                        <p class="mb-0"><strong>Phone:</strong> ${paymentInfo.owner.phone}</p>
                                    </div>
                                </div>

                                <!-- Rental Details -->
                                <h5 class="fs-6 fw-bold text-uppercase mt-4"><em>Payment Details</em></h5>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead class="bg-warning">
                                            <tr>
                                                <th class="text-dark text-center"><em>Payment From</em></th>
                                                <th class="text-dark text-center"><em>Payment To</em></th>
                                                <th class="text-dark text-center"><em>Revenue</em></th>
                                                <th class="text-dark text-center"><em>Expense</em></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="text-center">
                                                <td>${format_date(data?.from_date)}</td>
                                                <td>${format_date(data?.to_date)}</td>
                                                <td>${paymentInfo.revenue} &#2547;</td>
                                                <td>${paymentInfo.expense} &#2547;</td>
                                            </tr>
                                            <tr  class="text-center">
                                                <td colspan="2"></td>
                                                <td>Agency Commission</td>
                                                <td>${commission_amount}.00 &#2547;</td>
                                            </tr>
                                            <tr  class="text-center">
                                                <td colspan="2"></td>
                                                <th>Total</th>
                                                <th>${net_earnings}.00 &#2547;</th>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- Action Buttons -->
                                <div class="d-flex justify-content-end mt-3">
                                    <button id="paid-btn" class="btn btn-success me-2">Paid</button>
                                    <button id="print-btn" class="btn btn-primary">Print</button>
                                </div>
                            </div>
                        `
                    )

                    $("#paid-btn").on("click", function() {
                        const ownerId = paymentInfo.owner.id;
                        const fromDate = data.from_date;
                        const toDate = data.to_date;
                        const revenue = paymentInfo.revenue;
                        const expense = paymentInfo.expense;
                        const paidAmount = paymentInfo.profit;

                        $.ajax({
                            url: "<?=$base_url?>/api/ownerpayment/create_owner_payment",
                            method: "POST",
                            data: {
                                id: null,
                                owner_id: ownerId,
                                from_date: fromDate,
                                to_date: toDate,
                                revenue: revenue,
                                expense: expense,
                                paid_amount: paidAmount
                            },
                            success: function(response) {
                                alert("Payment record added successfully!");
                            },
                            error: function(error) {
                                alert("Error recording payment. Please try again.");
                                console.error(error);
                            }
                        });
                    });

                    // Add click event for Print button
                    $("#print-btn").on("click", function() {
                        const printContent = $("#invoice").html(); // Get the appended HTML content
                        const originalContent = $("body").html(); // Store the original page content

                        // Replace the body content with the printable content
                        $("body").html(printContent);

                        // Trigger print dialog
                        window.print();

                        // Restore the original page content after printing
                        $("body").html(originalContent);

                        // Rebind event listeners if necessary
                        // location.reload(); // Reload the page to restore functionality
                    });


                });
            }
        });
    })
</script>