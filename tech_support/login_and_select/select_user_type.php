<?php include '../view/header.php'; ?>
<link rel="stylesheet" type="text/css" href="../main.css">
<div id="main">
    <h2>Main Menu</h2>
    <ul class="nav">
        <li><a href="../login_and_select/index.php?action=show_sign_in&type=admin">Administrators</a></li>
        <li><a href="../login_and_select/index.php?action=show_sign_in&type=tech">Technicians</a></li>
        <li><a href="../login_and_select/index.php?action=show_sign_in&type=customer">Customers</a></li>
    </ul>
</div>
<?php include '../view/footer.php'; ?>