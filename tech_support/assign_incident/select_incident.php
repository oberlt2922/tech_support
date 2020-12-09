<?php session_start(); ?>
<?php include '../view/header.php'; ?>
<link rel="stylesheet" type="text/css" href="../main.css">
<div id="main">
    <main>
        <h1>Select Incident</h1>
        <table>
            <tr>
                <td>Customer</td>
                <td>Product</td>
                <td>Date Opened</td>
                <td>Title</td>
                <td>Description</td>
                <td>&nbsp;</td>
            </tr>
            <?php foreach($incidents as $incident): ?>
            <tr>
                <td><?php echo $incident['firstName'] . " " . $incident['lastName']; ?></td>
                <td><?php echo $incident['productCode']; ?></td>
                <td><?php $date_opened = $incident['dateOpened'];
                          $date_opened = strtotime($date_opened);
                          $date_opened = date('n/j/Y', $date_opened);
                          echo $date_opened; ?></td>
                <td><?php echo $incident['title']; ?></td>
                <td><?php echo $incident['description']; ?></td>
                <td>
                    <form action='.' method='post'>
                        <input type='hidden' name='action' value='list_technicians'/>
                        <input type='hidden' name='incident_id' value='<?php echo $incident['incidentID']; ?>'/>
                        <input type='hidden' name='first_name' value='<?php echo $incident['firstName']; ?>'/>
                        <input type='hidden' name='last_name' value='<?php echo $incident['lastName']; ?>'/>
                        <input type='hidden' name='product_code' value='<?php echo $incident['productCode']; ?>'/>
                        <input type='submit' value='Select'/>
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
<?php include '../view/footer.php'; ?>