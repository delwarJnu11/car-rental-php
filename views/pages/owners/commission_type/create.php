<div class="row">
    <div class="col-12 col-xl-8 mx-auto">
        <div class="card rounded-4 border-top border-4 border-primary border-gradient-1">
            <div class="card-body p-4">
                <div class="d-flex align-items-start justify-content-between mb-3">
                    <div class="">
                        <h5 class="mb-4 fw-bold">Add Commission Type</h5>
                    </div>
                </div>
                <form action="/commission_type/save" method="POST" class="row g-4">
                    <div class="col-md-12">
                        <label for="input1" class="form-label">Commission Type</label>
                        <input type="text" name="commission_type" class="form-control" id="input1" placeholder="Commission Type">
                    </div>
                    <div class="col-md-12">
                        <div class="d-md-flex d-grid align-items-center gap-3">
                            <button type="submit" name="create" class="btn btn-grd-primary px-4">Add New Commission Type</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>