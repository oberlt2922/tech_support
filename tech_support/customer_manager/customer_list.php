<?php session_start(); ?>
<?php include '../view/header.php'; ?>
<link rel="stylesheet" type="text/css" href="../main.css">
<div id="main">
    <main>
        <h1>Customer Search</h1>
        <form action="." method="post">
            <input type="hidden" name="action" value="list_customers">
            <label>Last Name</label>
            <input type="text" name="last_name"/>
            <input type="submit" value="Search"/>
        </form>
        <h1>Add a new customer</h1>
        <form action="." method="post">
            <input type="hidden" name="action" value="show_add_customer_form">
            <input type="submit" value="Add Customer"/>
        </form>
        <h1>Results</h1>
        <section>
            <table>
                <tr>
                    <th>Name</th>
                    <th>Email Address</th>
                    <th>City</th>
                </tr>
                <?php foreach ($customers as $customer) : ?>
                <tr>
                    <td><?php echo $customer['firstName']; ?> <?php echo $customer['lastName']; ?></td>
                    <td><?php echo $customer['email']; ?></td>
                    <td><?php echo $customer['city']; ?></td>
                    <td>
                        <form action="." method="post">
                            <input type="hidden" name="action" value="show_update_form">
                            <input type="hidden" name="customer_id"
                                   value="<?php echo $customer['customerID']; ?>"/>
                            <input type="hidden" name="first_name"
                                   value="<?php echo $customer['firstName']; ?>"/>
                            <input type="hidden" name="last_name"
                                   value="<?php echo $customer['lastName']; ?>"/>
                            <input type="hidden" name="address"
                                   value="<?php echo $customer['address']; ?>"/>
                            <input type="hidden" name="city"
                                   value="<?php echo $customer['city']; ?>"/>
                            <input type="hidden" name="state"
                                   value="<?php echo $customer['state']; ?>"/>
                            <input type="hidden" name="postal_code"
                                   value="<?php echo $customer['postalCode']; ?>"/>
                            <input type="hidden" name="country_code"
                                   value="<?php echo $customer['countryCode']; ?>"/>
                            <input type="hidden" name="phone"
                                   value="<?php echo $customer['phone']; ?>"/>
                            <input type="hidden" name="email"
                                   value="<?php echo $customer['email']; ?>"/>
                            <input type="hidden" name="password"
                                   value="<?php echo $customer['password']; ?>"/>
                            <input type="submit" value="Search"/>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
        </section>
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