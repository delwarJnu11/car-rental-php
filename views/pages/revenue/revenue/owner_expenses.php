<div class="row">
    <div class="col-md-12">
        <div class="d-flex justify-content-between align-items-center">
            <h6 class="mb-0 text-uppercase w-50">All Expenses From Your Vehicle Mr. <span class="text-danger"><?=$_SESSION['fname'] . " " . $_SESSION['lname']?></span> </h6>
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
                            <th scope="col">Vehicle Name</th>
                            <th scope="col">Expense Type</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Description</th>
                            <th scope="col">Date</th>
                        </tr>
                    </thead>
                    <tbody id="expenses">

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $(function() {
        $.ajax({
            url: "<?=$base_url?>/api/expense/filter_expenses_by_owner",
            type: "POST",
            data: {
                owner_id: <?=$_SESSION['owner_id']?>
            },
            success: function(res) {
                const expenses = JSON.parse(res);
                if (expenses?.success) {
                    let sl = 1;
                    let html = "";
                    expenses?.expenses.forEach(expense => {
                        html += `
                        <tr>
                            <td scope="col">${sl++}</td></th>
                            <td scope="col">${expense.vehicle_name}</td>
                            <td scope="col">${expense.expense_type}</td>
                            <td scope="col">${expense.amount}</td>
                            <td scope="col">${expense.description}</td>
                            <td scope="col">${format_date(expense.created_at)}</td>
                        </tr>
                    `
                    });
                    $("#expenses").html(html)

                }
            },
            error: function(error) {
                console.error(error);
            }
        });
        // Formated date
        function format_date(date) {
            const d = new Date(date);
            const formattedDate = d.toLocaleDateString('en-GB', {
                day: '2-digit',
                month: 'short',
                year: 'numeric'
            }).toUpperCase();

            return formattedDate;
        }
        // Filter Expense By Day
        $("#days").on("change", function() {
            const days = $(this).val();
            $.ajax({
                url: "<?=$base_url?>/api/expense/filter_expenses_by_date",
                type: "POST",
                data: {
                    owner_id: <?=$_SESSION['owner_id']?>,
                    days
                },
                success: function(res) {
                    const filtered_expenses = JSON.parse(res)
                    if (filtered_expenses.success) {
                        $("#expenses").html("");
                        let sl = 1;
                        let html = "";
                        filtered_expenses.expenses.forEach(expense => {
                            html += `
                            <tr>
                                <td scope="col">${sl++}</td></th>
                                <td scope="col">${expense.vehicle_name}</td>
                                <td scope="col">${expense.expense_type}</td>
                                <td scope="col">${expense.amount}</td>
                                <td scope="col">${expense.description}</td>
                                <td scope="col">${format_date(expense.created_at)}</td>
                            </tr>
                        `
                        });
                        $("#expenses").html(html)
                    }else{
                        $("#expenses").html("");
                        const error = `<tr><td colspan="8"><em class="bg-danger text-white p-2 rounded-2 text-center">${filtered_expenses.message}</em></td></tr>`;
                        $("#expenses").html(error);
                    }
                },
                error: function(error) {
                    console.error(error);
                }
            });
        })
    })
</script>