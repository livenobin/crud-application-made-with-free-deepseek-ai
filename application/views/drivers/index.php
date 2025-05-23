<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Driver Management</h1>
    <a href="<?php echo base_url('drivers/create'); ?>" class="btn btn-primary">Create Driver</a>
</div>

<div class="card">
    <div class="card-body">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>License Number</th>
                    <th>Contact</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($drivers as $driver): ?>
                <tr>
                    <td><?php echo $driver->id; ?></td>
                    <td><?php echo $driver->name; ?></td>
                    <td><?php echo $driver->license_number; ?></td>
                    <td><?php echo $driver->contact_number; ?></td>
                    <td>
                        <span class="badge bg-<?php echo $driver->status == 'active' ? 'success' : 'danger'; ?>">
                            <?php echo ucfirst($driver->status); ?>
                        </span>
                    </td>
                    <td>
                        <a href="<?php echo base_url('drivers/view/'.$driver->id); ?>" class="btn btn-sm btn-info">View</a>
                        <a href="<?php echo base_url('drivers/edit/'.$driver->id); ?>" class="btn btn-sm btn-warning">Edit</a>
                        <a href="<?php echo base_url('drivers/delete/'.$driver->id); ?>" class="btn btn-sm btn-danger delete-btn">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>