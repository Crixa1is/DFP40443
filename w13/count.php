<?php 
include 'db.php';

$sql = "SELECT COUNT(*) AS total FROM users";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);
echo $row['total'];

?>
