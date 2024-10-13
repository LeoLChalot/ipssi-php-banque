<?php
require('./vue/include/head.php');
require('./vue/include/header.php');
?>

<main>

<?= $content ?? '' ?>
    
</main>

<?php
require('./vue/include/footer.php');
?>