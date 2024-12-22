<?php
    $designations = Designation::get_all_designation();
?>

<div class="row">
    <div class="col-xl-12">
        <div class="d-flex justify-content-between align-items-center">
            <h6 class="mb-0 text-uppercase">All Staff</h6>
            <div>
                <!-- <label for="designation_name">Filter By Designation</label> -->
                <select name="designation_name" id="designation_name" class="form-select">
                    <option value="">Filter By Designation</option>
                    <?php foreach ($designations as $designation): ?>
                        <option value="<?=$designation['id']?>"><?=$designation['designation_name']?></option>
                    <?php endforeach?>
                </select>
            </div>
            <a class="btn btn-grd-primary px-4 text-white d-flex align-items-center gap-2" href="<?=$base_url?>/staff/create">
                <i class="material-icons-outlined">add_circle</i>
                Register A Staff</a>
        </div>
        <hr>
        <div class="card">
            <div class="card-body">
                <table class="table mb-0 table-hover align-middle">
                    <thead>
                        <tr>
                            <th scope="col">Image</th>
                            <th scope="col">Staff Name</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Email</th>
                            <th scope="col">Address</th>
                            <th scope="col">Designation</th>
                            <th scope="col">Salary</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody id="staffs">

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $(function() {

        $.ajax({
            url: "<?=$base_url?>/api/staffs",
            type: "GET",
            data: {},
            success: function(res) {
                const staffs = JSON.parse(res).staffs;
                staffs.forEach(staff => {
                    $('#staffs').append(`
                        <tr>
                            <td><img src="<?=$base_url?>/img/staff/${staff.image}" alt="${staff.first_name}" class="rounded-circle" width="50" height="50"></td>
                            <td>${staff.first_name} ${staff.last_name}</td>
                            <td>${staff.phone}</td>
                            <td>${staff.email}</td>
                            <td>${staff.city}, ${staff.country}</td>
                            <td>${staff.designation_name}</td>
                            <td>${staff.salary}</td>
                            <td>
                                <a href="<?=$base_url?>/staff/edit/${staff.id}" class="btn btn-sm btn-grd-primary"><i class="material-icons-outlined">edit</i></a>
                                <a href="<?=$base_url?>/staff/delete/${staff.id}" class="btn btn-sm btn-grd-danger"><i class="material-icons-outlined">delete</i></a>
                            </td>
                        </tr>
                    `);
                });
            },
            error: function(error) {
                console.error(error);
            }
        });

        $('#designation_name').on("change", function() {
            const designation_id = $(this).val();
            // get staff based on designation
            $.ajax({
               url: "<?=$base_url?>/api/staffs/get_all_staff_by_designation",
               type: "POST",
               data: {designation_id},
               success: function(res) {
                const staffs = JSON.parse(res).staffs;
                $('#staffs').empty();
                 staffs.forEach(staff => {
                    $('#staffs').append(`
                        <tr>
                            <td><img src="<?=$base_url?>/img/staff/${staff.image}" alt="${staff.first_name}" class="rounded-circle" width="50" height="50"></td>
                            <td>${staff.first_name} ${staff.last_name}</td>
                            <td>${staff.phone}</td>
                            <td>${staff.email}</td>
                            <td>${staff.city}, ${staff.country}</td>
                            <td>${staff.designation_name}</td>
                            <td>${staff.salary}</td>
                            <td>
                                <a href="<?=$base_url?>/staff/edit/${staff.id}" class="btn btn-sm btn-grd-primary"><i class="material-icons-outlined">edit</i></a>
                                <a href="<?=$base_url?>/staff/delete/${staff.id}" class="btn btn-sm btn-grd-danger"><i class="material-icons-outlined">delete</i></a>
                            </td>
                        </tr>
                    `);
                });
               },
               error: function(error) {
                 console.error(error);
               }
            });

        })
    });
</script>