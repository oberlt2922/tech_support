<?php session_start(); ?>
<?php include '../view/header.php'; ?>
<link rel="stylesheet" type="text/css" href="../main.css">
<div id="main">
    <main>
        <h1>Select Technician</h1>
        <table>
            <tr>
                <td>Name</td>
                <td>Open Incidents</td>
                <td>&nbsp;</td>
            </tr>
            <?php foreach($technicians as $technician): ?>
            <tr>
                <td><?php echo $technician['firstName'] . " " . $technician['lastName']; ?></td>
                <td><?php echo $technician['openIncidents']; ?></td>
                <td>
                    <form action='.' method='post'>
                        <input type='hidden' name='action' value='show_assign_incident'/>
                        <input type='hidden' name='tech_id' value='<?php echo $technician['techID']; ?>' />
                        <input type='hidden' name='first_name' value='<?php echo $technician['firstName']; ?>' />
                        <input type='hidden' name='last_name' value='<?php echo $technician['lastName']; ?>' />
                        <input type='submit' value='select'/>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
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
<?php include '../view/header.php'; ?>