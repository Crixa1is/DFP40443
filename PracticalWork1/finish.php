<div class="container">
<div class="col-sm-3">
<?php
    require_once 'config/app_config.php';
    require_once 'includes/heading.php';
    echo "Your final score is " .$_SESSION['score'] ;
?>
</div>
</div>
<?php
    require_once 'includes/footer.php';
?>

