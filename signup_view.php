<?php include 'view/header.php'; ?>
<?php
    $doc_root = filter_input(INPUT_SERVER, 'DOCUMENT_ROOT', FILTER_SANITIZE_STRING);
?>
<main>
    <section class="login_box">
       <h4> You aren't entered in any leagues. </h4>
    </section>
</main>
</body>
</html>