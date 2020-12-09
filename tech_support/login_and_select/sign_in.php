<?php session_start(); ?>
<?php include '../view/header.php'; ?>
<link rel="stylesheet" type="text/css" href="../main.css">
<div id="main">
    <main>
        <?php if($type == 'admin'): ?>
        <h2>Admin Login</h2>
        <?php endif; ?>
        <?php if($type == 'tech'): ?>
        <h2>Technician Login</h2>
        <p>You must login before you can update an incident</p>
        <?php endif; ?>
        <?php if($type == 'customer'): ?>
        <h2>Customer Login</h2>
        <p>You must login before you can register a product.</p>
        <?php endif; ?>
        <?php if($loginFailed): ?>
        <p style="color: red;">Login Failed</p>
        <?php endif; ?>
        <form action="." method="post" id="aligned">
            <?php if($type == 'admin'): ?>
            <label>Username:</label>
            <input type="text" name="username"/><br>
            <?php else: ?>
            <label>Email:</label>
            <input type="text" name="email"/><br>
            <?php endif; ?>
            <label>Password:</label>
            <input type="text" name="password"/><br>
            <input type="submit" value="Login"/>
            <input type="hidden" name="action" value="login"/>
            <input type="hidden" name="type" value="<?php echo $type; ?>"/>
        </form>
    </main>
</div>
<?php include '../view/footer.php'; ?>