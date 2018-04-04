<?php include '../view/header.php'; ?>
<main>
    <section class="login_box">
        <h1>My Account</h1>
        <p><?php echo $user_name . ' (' . $email . ')'; ?></p>
        <form action="." method="post">
            <input type="hidden" name="action" value="view_account_edit">
            <input type="submit" value="Edit Account">
        </form>
        <form action="." method="post">
            <input type="hidden" name="action" value="logout">
            <input type="submit" value="Logout">
        </form>
    </section>
</main>
