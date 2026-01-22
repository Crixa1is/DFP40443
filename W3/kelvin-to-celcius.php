<!DOCTYPE html>
<html>
    <head>

    </head>
    <body>
<form method="post" action=<?php echo $_SERVER['PHP_SELF'] ?>>
    <div>
    <label for="Kelvin">Kelvin</label>
    <input type="number" name="kelvinVal" id="">
    <input type="submit" value="Convert">
    </div>
<body>
<?php
$celcius='';
if($_SERVER ['REQUEST_METHOD'] == "POST"){
    $kelvin= $_POST['kelvinVal'];
    $celcius = $kelvin-273.15;
}
?>

<?php
echo $celcius;
?>
</html>
