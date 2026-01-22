<!DOCTYPE html>
<html>
    <head>

    </head>
    <body>
<form method="post" action=<?php echo $_SERVER['PHP_SELF'] ?>>
<label>Height (cm)</label>
<input type="number" name="heightVal" id="">
<div>
<label>Weight (kg)</label>
<input type="number" name="weightVal" id="">
</div>
<div>
<input type="submit" value="Calculate">
</form>
</div>
    </body>
<?php 
    if($_SERVER ['REQUEST_METHOD'] == "POST"){
$height = $_POST['heightVal'];
$weight = $_POST['weightVal'];

$bmi = $weight/(($height/100)*($height/100));
    }
?>

<?php
 echo $bmi;
?>
</html>

