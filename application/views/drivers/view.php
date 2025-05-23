<h1 class="mb-4">Driver Details</h1>

<div class="card">
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-md-2 fw-bold">Name:</div>
            <div class="col-md-10"><?php echo $driver->name; ?></div>
        </div>
        <div class="row mb-3">
            <div class="col-md-2 fw-bold">License Number:</div>
            <div class="col-md-10"><?php echo $driver->license_number; ?></div>
        </div>
        <div class="row mb-3">
            <div class="col-md-2 fw-bold">Contact Number:</div>
            <div class="col-md-10"><?php echo $driver->contact_number; ?></div>
        </div>
        <div class="row mb-3">
            <div class="col-md-2 fw-bold">Address:</div>
            <div class="col-md-10"><?php echo $driver->address; ?></div>
        </div>
        <div class="row mb-3">
            <div class="col-md-2 fw-bold">Status:</div>
            <div class="col-md-10">
                <span class="badge bg-<?php echo $driver->status == 'active' ? 'success' : 'danger'; ?>">
                    <?php echo ucfirst($driver->status); ?>
                </span>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <a href="<?php echo base_url('drivers/edit/'.$driver->id); ?>" class="btn btn-warning">Edit</a>
                <a href="<?php echo base_url('drivers'); ?>" class="btn btn-secondary">Back</a>
            </div>
        </div>
    </div>
</div>