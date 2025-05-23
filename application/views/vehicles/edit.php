<h1 class="mb-4">Edit Vehicle</h1>

<div class="card">
    <div class="card-body">
        <form method="post">
            <div class="mb-3">
                <label for="registration_number" class="form-label">Registration Number</label>
                <input type="text" class="form-control" id="registration_number" name="registration_number" value="<?php echo $vehicle->registration_number; ?>" required>
            </div>
            <div class="mb-3">
                <label for="make" class="form-label">Make</label>
                <input type="text" class="form-control" id="make" name="make" value="<?php echo $vehicle->make; ?>" required>
            </div>
            <div class="mb-3">
                <label for="model" class="form-label">Model</label>
                <input type="text" class="form-control" id="model" name="model" value="<?php echo $vehicle->model; ?>" required>
            </div>
            <div class="mb-3">
                <label for="year" class="form-label">Year</label>
                <input type="number" class="form-control" id="year" name="year" value="<?php echo $vehicle->year; ?>" required>
            </div>
            <div class="mb-3">
                <label for="color" class="form-label">Color</label>
                <input type="text" class="form-control" id="color" name="color" value="<?php echo $vehicle->color; ?>">
            </div>
            <div class="mb-3">
                <label for="driver_id" class="form-label">Driver (optional)</label>
                <select class="form-select" id="driver_id" name="driver_id">
                    <option value="">Select Driver</option>
                    <?php foreach($drivers as $driver): ?>
                    <option value="<?php echo $driver->id; ?>" <?php echo $vehicle->driver_id == $driver->id ? 'selected' : ''; ?>>
                        <?php echo $driver->name; ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" id="status" name="status" required>
                    <option value="available" <?php echo $vehicle->status == 'available' ? 'selected' : ''; ?>>Available</option>
                    <option value="in_use" <?php echo $vehicle->status == 'in_use' ? 'selected' : ''; ?>>In Use</option>
                    <option value="maintenance" <?php echo $vehicle->status == 'maintenance' ? 'selected' : ''; ?>>Maintenance</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="<?php echo base_url('vehicles'); ?>" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>