<div class="row">
    <div class="col-12 col-xl-8 mx-auto">
        <div class="card rounded-4 border-top border-4 border-primary border-gradient-1">
            <div class="card-body p-4">
                <div class="d-flex align-items-start justify-content-between mb-3">
                    <div class="">
                        <h5 class="mb-4 fw-bold">Update Designation</h5>
                    </div>
                </div>
                <form action="<?php echo $base_url ?>/designation/update" method="POST" class="row g-4">
                    <input type="hidden" name="id" value="<?=$designation->id?>">
                    <div class="col-md-12">
                        <label for="input1" class="form-label">Designation</label>
                        <input type="text" value="<?=$designation->designation_name?>" name="designation" class="form-control" id="input1" placeholder="Designation Name">
                    </div>
                    <div class="col-md-12">
                        <div class="d-md-flex d-grid align-items-center gap-3">
                            <button type="submit" name="update" class="btn btn-grd-primary px-4">Update Designation</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>