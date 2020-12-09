<?php session_start(); ?>
<?php include '../view/header.php'; ?>
<link rel="stylesheet" type="text/css" href="../main.css">
<div id="main">
    <main>
        <h1>Assign Incident</h1>
        <?php if($assigned == true): ?>
        <p>This incident was assigned to a technician</p>
        <a href="index.php?action=list_incidents">Select Another Incident</a>
        <?php endif; ?>
        <?php if($assigned == false): ?>
        <form action='.' method='post' id='aligned'>
            <input type="hidden" name="action" value='assign_incident'/>
            <label>Customer:</label>
            <label><?php echo $_SESSION['incident']['customerFirstName'] . " " . $_SESSION['incident']['customerLastName']; ?></label><br>
            <label>Product:</label>
            <label><?php echo $_SESSION['incident']['productCode']; ?></label><br>
            <label>Technician:</label>
            <label><?php echo $_SESSION['incident']['technicianFirstName'] . " " . $_SESSION['incident']['technicianLastName']; ?></label><br>
            <input type='submit' value="Assign Incident"/>
        </form>
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