<?php include '../../view/header.php'; ?>
<main>
    <section class="login_box">
    <h1>Delete Account</h1>
    <p>Are you sure you want to delete the account for
       <?php echo htmlspecialchars($lastName) . ', ' . 
                  htmlspecialchars($firstName) .
                  ' (' . htmlspecialchars($email) . ')'; ?>?</p>
    <form action="." method="post">
        <input type="hidden" name="action" value="delete">
        <input type="hidden" name="adminID"
               value="<?php echo $adminID; ?>">
        <input type="submit" value="Delete Account">
    </form>
    <form action="." method="post">
        <input type="submit" value="Cancel">
    </form>
    </section>
</main>