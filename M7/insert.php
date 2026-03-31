<?php
require_once("config/app_config.php");
?>
<?php
$sqlPeranan = "SELECT * FROM spmp.roles;";
$HasilSQLPeranan = mysqli_query($conn, $sqlPeranan);

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $namaPengguna =$_POST['username'];
    $kataLaluan =$_POST['password'];
    $peranan = $_POST['peranan_id'];

    $arahansQL = mysqli_prepare($conn,"INSERT INTO users (username,password,role_id) VALUES (?,?,?)");
    mysqli_stmt_bind_param($arahansQL, "ssi", $namaPengguna,$kataLaluan,$peranan);
    if(mysqli_stmt_execute($arahansQL)){
        $mesej = "<p>Anda berjaya masuk</p>";
    } else {
        $mesej = "<p>Anda gagal masuk</p>".mysqli_stmt_error($sqlPeranan);
    }
    $HasilSQLPeranan = mysqli_query($conn, $sqlPeranan);

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <form method="POST" action="">
    <h2>Enter New User</h2>
    username
    <input type="text" name="username" id="username"> <br>
    password
    <input type="password" name="password" id="password" > <br>
    <select name="peranan_id" id="">
        <option value="1">---Sila Pilih Peranan---</option>
        <?php while ($row = mysqli_fetch_assoc($HasilSQLPeranan)): ?>
        <option value="<?php echo $row['id']; ?>">
        <?php echo $row ['name']; ?>
        </option>
        <?php endwhile; ?>
    </select>
    <input type="submit" value="Enter Data" >   
    </form>
</body>
</html>