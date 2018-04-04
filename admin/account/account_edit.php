<?php include '../../view/header.php'; ?>
<main>
    <section class="login_box">
    <h1>Edit Account</h1>
    <div id="edit_account_form">
    <form action="." method="post">
        <input type="hidden" name="action" value="update">
        <input type="hidden" name="adminID"
               value="<?php echo $adminID; ?>">
        <label>E-Mail:</label>
        <input type="text" name="email" 
               value="<?php echo htmlspecialchars($email); ?>">
        <?php echo $fields->getField('email')->getHTML(); ?><br>
        
        <label>First Name:</label>
        <input type="text" name="firstName" 
               value="<?php echo htmlspecialchars($firstName); ?>">
        <?php echo $fields->getField('firstName')->getHTML(); ?><br>
        
        <label>Last Name:</label>
        <input type="text" name="lastName" 
               value="<?php echo htmlspecialchars($lastName); ?>">
        <?php echo $fields->getField('lastName')->getHTML(); ?><br>
        
        <label>New Password:</label>
        <input type="password" name="password_1">
        <span>Leave blank to leave unchanged</span>
        <?php echo $fields->getField('password_1')->getHTML(); ?><br>
        
        <label>Retype Password:</label>
        <input type="password" name="password_2">
        <?php echo $fields->getField('password_2')->getHTML(); ?><br>
        
        <label>&nbsp;</label>
        <input type="submit" value="Update Account">
        <span class="error">
            <?php echo htmlspecialchars($password_message); ?>
        </span><br>
    </form>
    <form action="." method="post">
        <label>&nbsp;</label>
        <input type="submit" value="Cancel">
    </form>
    </div>
    </section>
</main>