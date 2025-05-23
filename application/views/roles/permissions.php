<h1 class="mb-4">Manage Permissions for Role: <?php echo $role->name; ?></h1>

<div class="card">
    <div class="card-body">
        <form method="post">
            <h4 class="mb-3">Permissions</h4>
            <div class="row">
                <?php foreach($permissions as $permission): ?>
                <div class="col-md-4 mb-2">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" 
                               id="perm_<?php echo $permission->id; ?>" 
                               name="permissions[]" 
                               value="<?php echo $permission->id; ?>"
                               <?php 
                                   foreach($role_permissions as $rp) {
                                       if($rp->id == $permission->id) {
                                           echo 'checked';
                                           break;
                                       }
                                   }
                               ?>>
                        <label class="form-check-label" for="perm_<?php echo $permission->id; ?>">
                            <?php echo $permission->name; ?>
                        </label>
                        <small class="d-block text-muted"><?php echo $permission->description; ?></small>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Save Changes</button>
            <a href="<?php echo base_url('roles'); ?>" class="btn btn-secondary mt-3">Cancel</a>
        </form>
    </div>
</div>