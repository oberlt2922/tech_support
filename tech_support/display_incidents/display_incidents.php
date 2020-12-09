<?php session_start(); ?>
<?php include '../view/header.php'; ?>
<link rel="stylesheet" type="text/css" href="../main.css">
<div id="main">
    <main>
        <?php if($action == 'display_unassigned'): ?>
        <h1>Unassigned Incidents</h1>
        <a href="index.php?action=display_assigned">View Assigned Incidents</a>
        <?php endif; ?>
        <?php if($action == 'display_assigned'): ?>
        <h1>Assigned Incidents</h1>
        <a href="index.php?action=display_unassigned">View Unassigned Incidents</a>
        <?php endif; ?>
        <table>
            <tr>
                <td>Customer</td>
                <td>Product</td>
                <?php if($action == 'display_assigned'): ?>
                <td>Technician</td>
                <?php endif; ?>
                <td>Incident</td>
            </tr>
            <?php foreach($incidents as $incident): ?>
            <tr>
                <td><?php echo $incident['customerName']; ?></td>
                <td style="width: 8em;"><?php echo $incident['name']; ?></td>
                <?php if($action == 'display_assigned'): ?>
                <td><?php echo $incident['technicianName']; ?></td>
                <?php endif; ?>
                <td style="width: 20em;">
                    <form id="aligned">                
                        <label>ID:</label>
                        <label><?php echo $incident['incidentID']; ?></label><br>
                        <label>Opened</label>
                        <label><?php $date_opened = $incident['dateOpened'];
                                     $date_opened = strtotime($date_opened);
                                     $date_opened = date('n/j/Y', $date_opened);
                                     echo $date_opened; ?></label><br>
                        <?php if($action == 'display_assigned'): ?>
                        <label>Closed</label>
                        <label>
                            <?php if($incident['dateClosed'] == NULL): ?>
                            OPEN
                            <?php endif; ?>
                            <?php if($incident['dateClosed'] != NULL): ?>
                            <?php $date_opened = $incident['dateClosed'];
                                  $date_opened = strtotime($date_opened);
                                  $date_opened = date('n/j/Y', $date_opened);
                                  echo $date_opened; ?>
                            <?php endif; ?>
                        </label><br>
                        <?php endif; ?>
                        <label>Title</label>
                        <label><?php echo $incident['title']; ?></label><br>
                        <label>Description</label>
                        <label><?php echo $incident['description']; ?></label>
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