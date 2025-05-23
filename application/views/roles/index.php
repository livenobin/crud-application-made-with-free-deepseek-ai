<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Role Management</h1>
    <?php if(in_array('create_roles', $user_permissions)): ?>
    <a href="<?php echo base_url('roles/create'); ?>" class="btn btn-primary">Create Role</a>
    <?php endif; ?>
</div>

<div class="card">
    <div class="card-body">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($roles as $role): ?>
                <tr>
                    <td><?php echo $role->id; ?></td>
                    <td><?php echo $role->name; ?></td>
                    <td><?php echo $role->description; ?></td>
                    <td>
                        <?php if(in_array('edit_roles', $user_permissions)): ?>
                        <a href="<?php echo base_url('roles/edit/'.$role->id); ?>" class="btn btn-sm btn-warning">Edit</a>
                        <?php endif; ?>
                        <?php if(in_array('manage_permissions', $user_permissions)): ?>
                        <a href="<?php echo base_url('roles/permissions/'.$role->id); ?>" class="btn btn-sm btn-info">Permissions</a>
                        <?php endif; ?>
                        <?php if(in_array('delete_roles', $user_permissions)): ?>
                        <a href="<?php echo base_url('roles/delete/'.$role->id); ?>" class="btn btn-sm btn-danger delete-btn">Delete</a>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>