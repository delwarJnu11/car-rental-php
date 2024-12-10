<?php
 $all_staff = Staff::get_all_staff();
?>

<div class="row">
    <div class="col-xl-12">
        <div class="d-flex justify-content-between align-items-center">
            <h6 class="mb-0 text-uppercase">All Staff</h6>
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
                    <tbody>
                        <?php foreach ($all_staff as $staff): ?>
                            <tr>
                                <th scope="row">
                                    <img width="60" height="60" src="<?=$base_url;?>/img/staff/<?=$staff['image'];?>" alt="">
                                </th>
                                <td><?=$staff['first_name'] . " " . $staff['last_name']?></td>
                                <td><?=$staff['phone']?></td>
                                <td><?=$staff['email']?></td>
                                <td><?=$staff['house_no'] . ", " . $staff['road_no'] . ", " . $staff['city']?></td>
                                <td><?=$staff['designation_name']?></td>
                                <td><?=$staff['salary']?></td>
                                <td>
                                    <a class="btn btn-sm text-warning" href="/staff/edit/<?=$staff['id']?>" title="Edit">
                                        <i class="material-icons-outlined">edit</i>
                                    </a>
                                    <a class="btn btn-sm text-danger" href="/staff/delete/<?=$staff['id']?>" title="Delete">
                                        <i class="material-icons-outlined">delete</i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>