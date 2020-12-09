<?php session_start(); ?>
<?php include '../view/header.php'; ?>
<link rel="stylesheet" type="text/css" href="../main.css">
<div id="main">
    <main>
        <h1>Get Customer</h1>
        <form action="." method="post" id='aligned'>
            <p>You must enter the customer's email address to select the customer</p><br>
            <input type="hidden" name='action' value='login'/>
            <label>Email: </label>
            <input type='text' name='email'/>
            <input type="submit" value="Get Customer"/>
        </form>
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