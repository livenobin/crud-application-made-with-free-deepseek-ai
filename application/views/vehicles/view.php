<h1 class="mb-4">Vehicle Details</h1>

<div class="card">
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-md-2 fw-bold">Registration Number:</div>
            <div class="col-md-10"><?php echo $vehicle->registration_number; ?></div>
        </div>
        <div class="row mb-3">
            <div class="col-md-2 fw-bold">Make:</div>
            <div class="col-md-10"><?php echo $vehicle->make; ?></div>
        </div>
        <div class="row mb-3">
            <div class="col-md-2 fw-bold">Model:</div>
            <div class="col-md-10"><?php echo $vehicle->model; ?></div>
        </div>
        <div class="row mb-3">
            <div class="col-md-2 fw-bold">Year:</div>
            <div class="col-md-10"><?php echo $vehicle->year; ?></div>
        </div>
        <div class="row mb-3">
            <div class="col-md-2 fw-bold">Color:</div>
            <div class="col-md-10"><?php echo $vehicle->color ? $vehicle->color : 'N/A'; ?></div>
        </div>
        <div class="row mb-3">
            <div class="col-md-2 fw-bold">Driver:</div>
            <div class="col-md-10"><?php echo isset($vehicle->driver_name) ? $vehicle->driver_name : 'N/A'; ?></div>
        </div>
        <div class="row mb-3">
            <div class="col-md-2 fw-bold">Status:</div>
            <div class="col-md-10">
                <span class="badge bg-<?php 
                    echo $vehicle->status == 'available' ? 'success' : 
                    ($vehicle->status == 'in_use' ? 'warning' : 'danger'); 
                ?>">
                    <?php echo ucfirst(str_replace('_', ' ', $vehicle->status)); ?>
                </span>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <a href="<?php echo base_url('vehicles/edit/'.$vehicle->id); ?>" class="btn btn-warning">Edit</a>
                <a href="<?php echo base_url('vehicles'); ?>" class="btn btn-secondary">Back</a>
            </div>
        </div>
    </div>
</div>