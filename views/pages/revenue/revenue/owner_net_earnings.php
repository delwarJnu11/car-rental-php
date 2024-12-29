<?php
    $owner = Owner::get_owner($_SESSION['owner_id']);

    $commission = $owner->commission_rate;
?>

<!-- <div class="row">
    <div class="col-md-12">
        <div class="d-flex justify-content-between align-items-center">
            <h6 class="mb-0 text-uppercase w-50">Net Earnings From Your Vehicle Mr. <span class="text-danger"><?=$_SESSION['fname'] . " " . $_SESSION['lname']?></span> </h6>
            <select name="days" id="days" class="form-select w-50">
                <option value="">Filter Expenses By Days</option>
                <option value="1">DAILY</option>
                <option value="7">WEEKLY</option>
                <option value="30">MONTHLY</option>
            </select>
        </div>
        <hr>
        <div class="card shadow">
            <div class="card-body">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">SL.</th>
                            <th scope="col">Description</th>
                            <th scope="col">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td scope="col">1</td>
                            <td scope="col">Total Revenue</td>
                            <td scope="col" id="revenue"></td>
                        </tr>
                        <tr>
                            <td scope="col">2</td>
                            <td scope="col">Total Expense</td>
                            <td scope="col" id="expense"></td>
                        </tr>
                        <tr>
                            <td scope="col">3</td>
                            <td scope="col">Agency Commission</td>
                            <td scope="col" id="commission"></td>
                        </tr>

                    </tbody>
                    <tfoot>
                        <tr>
                            <td></td>
                            <th scope="col">Net Earnings</th>
                            <th scope="col" id="earnings"></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div> -->

<div class="row">
    <div class="col-md-12">
        <div class="d-flex justify-content-between align-items-center">
            <h6 class="mb-0 text-uppercase w-50">Net Earnings From Your Vehicle Mr. <span class="text-danger"><?=$_SESSION['fname'] . " " . $_SESSION['lname']?></span> </h6>
            <select name="days" id="days" class="form-select w-50">
                <option value="">Filter Expenses By Days</option>
                <option value="1">DAILY</option>
                <option value="7">WEEKLY</option>
                <option value="30">MONTHLY</option>
            </select>
        </div>
        <hr>
        <div class="card shadow">
            <div class="card-body">
                <table class="table table-bordered table-striped table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">SL.</th>
                            <th scope="col">Description</th>
                            <th scope="col">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td scope="col">1</td>
                            <td scope="col">Total Revenue</td>
                            <td scope="col" id="revenue"></td>
                        </tr>
                        <tr>
                            <td scope="col">2</td>
                            <td scope="col">Total Expense</td>
                            <td scope="col" id="expense"></td>
                        </tr>
                        <tr>
                            <td scope="col">3</td>
                            <td scope="col">Agency Commission</td>
                            <td scope="col" id="commission"></td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td class="border-r-0"></td>
                            <td scope="col" class="border-l-0">Net Earnings</td>
                            <th scope="col" id="earnings"></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>


<script>
    $(function() {
        const data = {};

        // All Expense Amount
        const expenseRequest = $.ajax({
            url: "<?php echo $base_url ?>/api/expense/filter_expense_amount_by_owner",
            type: "POST",
            data: {owner_id: <?=$_SESSION['owner_id']?>},
            success: function(res) {
                data.expense = JSON.parse(res).amount;
            },
            error: function(error) {
                console.error(error);
            }
        });

        // All Revenue Amount
        const revenueRequest = $.ajax({
            url: "<?php echo $base_url ?>/api/bookings/filter_revenue_amount_by_owner",
            type: "POST",
            data: {owner_id: <?=$_SESSION['owner_id']?>},
            success: function(res) {
                data.revenue = JSON.parse(res).amount;
            },
            error: function(error) {
                console.error(error);
            }
        });

        // Handle Promise using Jquery
        $.when(expenseRequest, revenueRequest).done(function() {
            const commission_amount = (data.revenue * (<?=$commission?>)) / 100;
            const net_earnings = parseFloat(data.revenue) - data.expense - parseFloat(commission_amount);
            $("#revenue").text(parseFloat(data.revenue));
            $("#expense").text(parseFloat(data.expense));
            $("#commission").text(parseFloat(commission_amount));
            $("#earnings").text(parseFloat(net_earnings));
        });

        $("#days").on("change", function(){
            const days = $(this).val();

            const filterExpenseRequest = $.ajax({
                url: "<?php echo $base_url ?>/api/expense/filter_expense_amount_by_owner_and_day",
                type: "POST",
                data: {
                    owner_id: <?=$_SESSION['owner_id']?>,
                    days
                },
                success: function(res) {
                    data.expense = JSON.parse(res).amount;
                },
                error: function(error) {
                    console.error(error);
                }
            });

            const filterRevenueRequest = $.ajax({
                url: "<?php echo $base_url ?>/api/bookings/filter_revenue_amount_by_owner_and_day",
                type: "POST",
                data: {
                    owner_id: <?=$_SESSION['owner_id']?>,
                    days
                },
                success: function(res) {
                    data.revenue = JSON.parse(res).amount;
                },
                error: function(error) {
                    console.error(error);
                }
            });

            // re render when day is change
            $.when(filterExpenseRequest, filterRevenueRequest).done(function() {
            const commission_amount = (data.revenue * (<?=$commission?>)) / 100;
            const net_earnings = parseFloat(data.revenue) - data.expense - parseFloat(commission_amount);
            $("#revenue").text(parseFloat(data.revenue));
            $("#expense").text(parseFloat(data.expense));
            $("#commission").text(parseFloat(commission_amount));
            $("#earnings").text(parseFloat(net_earnings));
        });

        })
    });

</script>