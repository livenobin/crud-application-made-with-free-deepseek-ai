<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="">User Management</h1>
    <?php if(in_array('create_users', $user_permissions)): ?>
    <a href="<?php echo base_url('users/create'); ?>" class="btn btn-primary">Create User</a>
    <?php endif; ?>
</div>

<div class="card">
    <div class="card-body">
        <table class="table table-striped table-hover table-responsive">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($users as $user): ?>
                <tr>
                    <td><?php echo $user->id; ?></td>
                    <td><?php echo $user->username; ?></td>
                    <td><?php echo $user->email; ?></td>
                    <td><?php echo $user->role_name; ?></td>
                    <td>
                        <?php if(in_array('edit_users', $user_permissions)): ?>
                        <a href="<?php echo base_url('users/edit/'.$user->id); ?>" class="btn btn-sm btn-warning">Edit</a>
                        <?php endif; ?>
                        <?php if(in_array('delete_users', $user_permissions)): ?>
                        <a href="<?php echo base_url('users/delete/'.$user->id); ?>" class="btn btn-sm btn-danger delete-btn">Delete</a>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>