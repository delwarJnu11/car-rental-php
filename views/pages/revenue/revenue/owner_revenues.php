<div class="row">
    <div class="col-md-12">
       <div class="d-flex justify-content-between align-items-center">
           <h6 class="mb-0 text-uppercase w-50">All Revenue From Your Vehicle Mr. <span class="text-danger"><?=$_SESSION['fname'] . " " . $_SESSION['lname']?></span> </h6>
           <select name="days" id="days" class="form-select w-50">
            <option value="">Filter Revenue By Days</option>
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
                    <tbody id="revenue">

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $.ajax({
            url: "<?=$base_url?>/api/revenue/get_all_revenue_by_owner",
            type: "POST",
            data: {
                owner_id: <?=$_SESSION['owner_id']?>
            },
            success: function(response) {
                const result = JSON.parse(response);
                if (result.success) {
                    const all_revenues = result.revenues;
                    let revenue = "";
                    let id = 1;
                    all_revenues?.forEach((item, index) => {
                        revenue += `
                            <tr class="text-center">
                                <td>${id++}</td>
                                <td>${item.vehicle_name}</td>
                                <td>${item.first_name} ${item.last_name}</td>
                                <td>${item.total_rent_amount}</td>
                                <td>${item.paid_amount}</td>
                                <td>${item.due_amount}</td>
                                <td>${item.payment_method}</td>
                                <td>${item.payment_status}</td>
                            </tr>
                        `;
                    });
                    $("#revenue").html(revenue);
                } else {
                    alert(response.message);
                }
            },
            error: function(err) {
                console.log(err);
            }
        });
    });

    $("#days").on("change", function(){
        const days = $(this).val();
        $.ajax({
            url: "<?=$base_url?>/api/revenue/get_all_revenue_by_owner_filter_by_days",
            type: "POST",
            data: {
                owner_id: <?=$_SESSION['owner_id']?>,
                days: days
            },
            success: function(res) {
                const response = JSON.parse(res);
                if (response.success) {
                    $("#revenue").html("");
                    const all_revenues = response.revenues;
                    console.log(all_revenues)
                    let revenue = "";
                    let id = 1;
                    all_revenues?.forEach((item, index) => {
                        revenue += `
                            <tr class="text-center">
                                <td>${id++}</td>
                                <td>${item.vehicle_name}</td>
                                <td>${item.first_name} ${item.last_name}</td>
                                <td>${item.total_rent_amount}</td>
                                <td>${item.paid_amount}</td>
                                <td>${item.due_amount}</td>
                                <td>${item.payment_method}</td>
                                <td>${item.payment_status}</td>
                            </tr>
                        `;
                    });
                    $("#revenue").html(revenue);
                } else {
                    $("#revenue").html("");
                    const error = `<tr><td colspan="8"><em class="bg-danger text-white p-2 rounded-2 text-center">${response.message}</em></td></tr>`;
                    $("#revenue").html(error);
                }
            },
            error: function(err) {
                console.log(err);
            }
        });
    })
</script>