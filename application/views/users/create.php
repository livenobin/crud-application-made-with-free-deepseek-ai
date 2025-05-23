<h1 class="mb-4">Create User</h1>

<div class="card">
    <div class="card-body">
        <form method="post">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="mb-3">
                <label for="confirm_password" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
            </div>
            <div class="mb-3">
                <label for="role_id" class="form-label">Role</label>
                <select class="form-select" id="role_id" name="role_id" required>
                    <?php foreach($roles as $role): ?>
                    <option value="<?php echo $role->id; ?>"><?php echo $role->name; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
            <a href="<?php echo base_url('users'); ?>" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>