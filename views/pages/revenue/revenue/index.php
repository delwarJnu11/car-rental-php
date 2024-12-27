<div class="row">
    <div class="col-xl-12">
        <h6 class="mb-0 text-uppercase">All Payments</h6>
        <hr>
        <div class="card shadow">
            <div class="card-body">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-dark">
                        <tr class="text-center">
                            <th scope="col">ID</th>
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
                    all_revenues?.forEach((item, index) => {
                        revenue += `
                            <tr class="text-center">
                                <td>${item.id}</td>
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
</script>