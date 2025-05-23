<h1 class="mb-4">Dashboard</h1>
<div class="row">
    <div class="col-md-4">
        <div class="card text-white bg-primary mb-3">
            <div class="card-header">Users</div>
            <div class="card-body">
                <h5 class="card-title">Total Users</h5>
                <p class="card-text"><?php echo count($this->User_model->get_users()); ?></p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-white bg-success mb-3">
            <div class="card-header">Drivers</div>
            <div class="card-body">
                <h5 class="card-title">Total Drivers</h5>
                <p class="card-text"><?php echo count($this->Driver_model->get_drivers()); ?></p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-white bg-info mb-3">
            <div class="card-header">Vehicles</div>
            <div class="card-body">
                <h5 class="card-title">Total Vehicles</h5>
                <p class="card-text"><?php echo count($this->Vehicle_model->get_vehicles()); ?></p>
            </div>
        </div>
    </div>
</div>