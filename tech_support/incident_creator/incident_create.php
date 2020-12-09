<?php session_start(); ?>
<?php include '../view/header.php'; ?>
<link rel="stylesheet" type="text/css" href="../main.css">
<div id="main">
    <main>
        <h1>Create Incident</h1>
        <?php if ($action == 'login'): ?>
            <form action="." method="post" id="aligned">
                <input type="hidden" name="action" value='create_incident'/>
                <input type='hidden' name='customer_id' value='<?php echo $customer['customerID'];?>'/>
                <label>Customer: </label>
                <label><?php echo $customer['firstName'];?> <?php echo $customer['lastName'];?></label><br>
                <label>Product: </label>
                <select name='code'>
                    <?php foreach ($products as $product): ?>
                    <option value="<?php echo $product['productCode'];?>">
                        <?php echo $product['name'];?>
                    </option>
                    <?php endforeach ?>
                </select><br>
                <label>Title: </label>
                <input type="text" name='title'/><br>
                <label>Description: </label>
                <textarea name='description'></textarea><br>
                <label>&nbsp;</label>
                <input type='submit' value='Create Incident'/>
            </form>
        <?php elseif ($action == 'create_incident'):?>
            <p>This incident was added to our database</p>
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