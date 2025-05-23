<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Vehicle Management</h1>
    <a href="<?php echo base_url('vehicles/create'); ?>" class="btn btn-primary">Create Vehicle</a>
</div>

<div class="card">
    <div class="card-body">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Reg. Number</th>
                    <th>Make</th>
                    <th>Model</th>
                    <th>Year</th>
                    <th>Driver</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($vehicles as $vehicle): ?>
                <tr>
                    <td><?php echo $vehicle->id; ?></td>
                    <td><?php echo $vehicle->registration_number; ?></td>
                    <td><?php echo $vehicle->make; ?></td>
                    <td><?php echo $vehicle->model; ?></td>
                    <td><?php echo $vehicle->year; ?></td>
                    <td><?php echo $vehicle->driver_name ? $vehicle->driver_name : 'N/A'; ?></td>
                    <td>
                        <span class="badge bg-<?php 
                            echo $vehicle->status == 'available' ? 'success' : 
                            ($vehicle->status == 'in_use' ? 'warning' : 'danger'); 
                        ?>">
                            <?php echo ucfirst(str_replace('_', ' ', $vehicle->status)); ?>
                        </span>
                    </td>
                    <td>
                        <a href="<?php echo base_url('vehicles/view/'.$vehicle->id); ?>" class="btn btn-sm btn-info">View</a>
                        <a href="<?php echo base_url('vehicles/edit/'.$vehicle->id); ?>" class="btn btn-sm btn-warning">Edit</a>
                        <a href="<?php echo base_url('vehicles/delete/'.$vehicle->id); ?>" class="btn btn-sm btn-danger delete-btn">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>