<?php session_start(); ?>
<?php include '../view/header.php'; ?>
<link rel="stylesheet" type="text/css" href="../main.css">
<div id="main">
    <main>
        <h1>Add/Update Customer</h1>
        <form action='.' method='post' id='aligned'>
            <input type='hidden' name='action' value = '<?php if($action == 'show_update_form') {echo 'update_customer';} else {echo 'add_customer';}?>'>
            <input type='hidden' name='customer_id' value='<?php echo $customer["customerID"];?>' />

            <label>First Name:</label>
            <input type='text' name='first_name' value='<?php echo $customer['firstName'];?>' />
            <?php echo $fields->getField('first_name')->getHTML(); ?><br>

            <label>Last Name:</label>
            <input type='text' name='last_name' value='<?php echo $customer['lastName'];?>' />
            <?php echo $fields->getField('last_name')->getHTML(); ?><br>

            <label>Address:</label>
            <input type='text' name='address' value='<?php echo $customer["address"];?>' />
            <?php echo $fields->getField('address')->getHTML(); ?><br>

            <label>City:</label>
            <input type='text' name='city' value='<?php echo $customer["city"];?>' />
            <?php echo $fields->getField('city')->getHTML(); ?><br>

            <label>State:</label>
            <input type='text' name='state' value='<?php echo $customer["state"];?>' />
            <?php echo $fields->getField('state')->getHTML(); ?><br>

            <label>Postal Code:</label>
            <input type='text' name='postal_code'  value='<?php echo $customer["postalCode"];?>' />
            <?php echo $fields->getField('postal_code')->getHTML(); ?><br>

            <label>Country:</label>
            <select name="country_code">
                <?php foreach ($countries as $country): ?>
                <option value='<?php echo $country['countryCode'];?>' <?php if($country['countryCode'] == $customer['countryCode']) {echo ' selected="selected"';} ?>>
                    <?php echo $country['countryName'];?>
                </option>
                <?php endforeach; ?>
            </select><br>

            <label>Phone:</label>
            <input type='text' name='phone' value='<?php echo $customer["phone"];?>' />
            <?php echo $fields->getField('phone')->getHTML(); ?><br>

            <label>Email:</label>
            <input type='text' name='email' value='<?php echo $customer["email"];?>' />
            <?php echo $fields->getField('email')->getHTML(); ?><br>

            <label>Password:</label>
            <input type='text' name='password' value='<?php echo $customer["password"];?>' />
            <?php echo $fields->getField('password')->getHTML(); ?><br>

            <label>&nbsp;</label>
            <input type='submit' <?php if($action == 'show_update_form') {echo 'value = "Update Customer"';} else {echo 'value = "Add Customer"';}?>/>
        </form>
        <p><a href="?action=list_customers">Search Customers</a></p>
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