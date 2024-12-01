<div class="row">
    <div class="col-12 col-xl-12 mx-auto">
        <div class="card rounded-4 border-top border-4 border-primary border-gradient-1">
            <div class="card-body p-4">
                <div class="d-flex align-items-start justify-content-between mb-3">
                    <div class="">
                        <h5 class="mb-4 fw-bold">Add Booking Status</h5>
                    </div>
                </div>
                <form action="/booking_status/save" method="POST" class="row g-4">
                    <div class="col-md-12">
                        <label for="input1" class="form-label">Booking Status</label>
                        <input type="text" name="booking_status" class="form-control" id="input1" placeholder="Booking Status">
                    </div>
                    <div class="col-md-12">
                        <div class="d-md-flex d-grid align-items-center gap-3">
                            <button type="submit" name="create" class="btn btn-grd-primary px-4 text-white">Add Booking Status</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>