<h1 class="mb-4">Create Role</h1>

<div class="card">
    <div class="card-body">
        <form method="post">
            <div class="mb-3">
                <label for="name" class="form-label">Role Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
            <a href="<?php echo base_url('roles'); ?>" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>