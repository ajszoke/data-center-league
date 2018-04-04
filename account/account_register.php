<?php include '../view/header.php'; ?>
<?php 
if (!isset($password_message)) { $password_message = ''; } 
?>
<main>
    <section class="login_box">
        <h1>Register</h1>
        <form action="." method="post" id="register_form">
            <input type="hidden" name="action" value="register">
    
            <label>E-Mail:</label>
            <input type="text" name="email"
                   value="<?php echo htmlspecialchars($email); ?>" size="30">
            <?php echo $fields->getField('email')->getHTML(); ?><br>
    
            <label>Password:</label>
            <input type="password" name="password_1" size="30">
            <?php echo $fields->getField('password_1')->getHTML(); ?>
            <span class="error"><?php echo htmlspecialchars($password_message); ?></span><br>
    
            <label>Retype Password:</label>
            <input type="password" name="password_2" size="30">
            <?php echo $fields->getField('password_2')->getHTML(); ?><br>
    
            <label>First Name:</label>
            <input type="text" name="first_name"
                   value="<?php echo htmlspecialchars($first_name); ?>" 
                   size="30">
            <?php echo $fields->getField('first_name')->getHTML(); ?><br>
    
            <label>Last Name:</label>
            <input type="text" name="last_name"
                   value="<?php echo htmlspecialchars($last_name); ?>"
                   size="30">
            <?php echo $fields->getField('last_name')->getHTML(); ?><br>
    
            <label>&nbsp;</label>
            <input type="submit" value="Register">
        </form>
    </section>
</main