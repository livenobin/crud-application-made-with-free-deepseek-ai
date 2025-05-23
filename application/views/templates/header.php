<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">
	
    
    <style>
        /* Sidebar styles */
        .sidebar {
            min-height: 100vh;
            background-color: #343a40;
            padding: 0;
            transition: all 0.3s;
            position: fixed;
            z-index: 1000;
            width: 250px;
        }
        
        .sidebar-toggle {
		    display: none;
		}
        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.8);
            padding: 12px 20px;
            border-left: 4px solid transparent;
        }
        
        .sidebar .nav-link:hover, 
        .sidebar .nav-link.active {
            color: white;
            background-color: rgba(255, 255, 255, 0.1);
            border-left: 4px solid #0d6efd;
        }
        
        .sidebar .nav-link i {
            margin-right: 10px;
            font-size: 1.1rem;
        }
        
        .sidebar .nav-item .logout {
            color: rgba(255, 99, 71, 0.8);
        }
        
        .sidebar .nav-item .logout:hover {
            color: tomato;
        }
        
        .sidebar-header {
            padding: 20px;
            background-color: rgba(0, 0, 0, 0.2);
            color: white;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        /* Main content area */
        .main-content {
            margin-left: 250px;
            padding: 20px;
            transition: all 0.3s;
        }
        
        /* Mobile styles */
		@media (max-width: 768px) {
		    .sidebar {
		        margin-left: -250px;
		        position: fixed;
		        height: 100vh;
		        z-index: 1000;
		    }
		    
		    .sidebar.active {
		        margin-left: 0;
		    }
		    
		    .main-content {
		        margin-left: 0;
		        width: 100%;
		    }
		    
		    .main-content.active {
		        margin-left: 250px;
		        position: relative;
		    }
		    .main-content > h1:nth-child(1) {
		    	margin-left: 45px !important;
		    }

		    .sidebar-toggle {
		        display: block;
		        position: fixed;
		        top: 10px;
		        left: 10px;
		        z-index: 1100;
		        background: #343a40;
		        color: white;
		        border: none;
		        border-radius: 4px;
		        padding: 8px 12px;
		        font-size: 1.2rem;
		    }
		}
        
        @media (max-width: 768px) {
            .sidebar-toggle {
                display: block;
            }
        }
    </style>
</head>
<?php 
if( !isset($user_permissions) ) 
{ 
	$user_permissions = $this->session->userdata('permissions');
} 
?>
<body>
	<!-- Sidebar Toggle Button (Mobile Only) -->
    <button class="sidebar-toggle" id="sidebarToggle">
        <i class="bi bi-list"></i>
    </button>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <h4>Vehicle Management</h4>
        </div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link <?php echo (strpos(current_url(), 'dashboard') !== false ? 'active' : ''); ?>" href="<?php echo base_url('dashboard'); ?>">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>
            </li>
            <?php if(in_array('view_users', $user_permissions)): ?>
            <li class="nav-item">
                <a class="nav-link <?php echo (strpos(current_url(), 'users') !== false ? 'active' : ''); ?>" href="<?php echo base_url('users'); ?>">
                    <i class="bi bi-people"></i> Users
                </a>
            </li>
            <?php endif; ?>
            <?php if(in_array('view_roles', $user_permissions)): ?>
            <li class="nav-item">
                <a class="nav-link <?php echo (strpos(current_url(), 'roles') !== false ? 'active' : ''); ?>" href="<?php echo base_url('roles'); ?>">
                    <i class="bi bi-shield-lock"></i> Roles
                </a>
            </li>
            <?php endif; ?>
            <?php if(in_array('view_drivers', $user_permissions)): ?>
            <li class="nav-item">
                <a class="nav-link <?php echo (strpos(current_url(), 'drivers') !== false ? 'active' : ''); ?>" href="<?php echo base_url('drivers'); ?>">
                    <i class="bi bi-person-badge"></i> Drivers
                </a>
            </li>
            <?php endif; ?>
            <?php if(in_array('view_vehicles', $user_permissions)): ?>
            <li class="nav-item">
                <a class="nav-link <?php echo (strpos(current_url(), 'vehicles') !== false ? 'active' : ''); ?>" href="<?php echo base_url('vehicles'); ?>">
                    <i class="bi bi-truck"></i> Vehicles
                </a>
            </li>
            <?php endif; ?>
            <li class="nav-item mt-4">
                <a class="nav-link logout" href="<?php echo base_url('auth/logout'); ?>">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </a>
            </li>
        </ul>
    </div>
            
    <!-- Main Content -->
	<div class="main-content" id="mainContent">
    <?php if($this->session->flashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?php echo $this->session->flashdata('success'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php endif; ?>
    
    <?php if($this->session->flashdata('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?php echo $this->session->flashdata('error'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php endif; ?>