<?php session_start(); ?>
<?php include '../view/header.php'; ?>
<link rel="stylesheet" type="text/css" href="../main.css">
<div id="main">
    <main>
        <?php if($_SESSION['user']['type'] == 'admin'): ?>
        <h2>Admin Menu</h2>
        <ul class="nav">
            <li><a href="../product_manager">Manage Products</a></li>
            <li><a href="../technician_manager">Manage Technicians</a></li>
            <li><a href="../customer_manager">Manage Customers</a></li>
            <li><a href="../incident_creator">Create Incident</a></li>
            <li><a href="../assign_incident">Assign Incident</a></li>
            <li><a href="../display_incidents">Display Incidents</a></li>
        </ul>
        
        <?php else: ?>
        <h2>Technicians</h2>
        <ul class="nav">
            <li><a href="../update_incident">Update Incident</a></li>
        </ul>
        <?php endif; ?>
        
        <h2>Login Status</h2>               
        <?php 
        if($_SESSION['user']['type'] == 'admin')
        {
            $user = $_SESSION['user']['username'];
        }
        else
        {
            $user = $_SESSION['user']['email'];
        }
        ?>        
        <p>You are logged in as <?php echo $user; ?></p>
        <form action="." method="post" id="aligned">
            <input type="hidden" name="action" value="logout"/>
            <input type="submit" value="Logout"/>
        </form>
    </main>
    
</div>
<?php include '../view/footer.php'; ?>