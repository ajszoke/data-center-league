<?php include '../view/header.php'; ?>
<?php include '../view/sidebar.php'; ?>

<div id="content">
    <h1>Database Error</h1>
    <p>An error occurred connecting to the database.</p>
    <p>Error message: <?php echo $error_message; ?></p>
</div>
<?php include '../view/footer.php'; ?>