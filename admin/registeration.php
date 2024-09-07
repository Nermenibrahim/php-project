<?php 

require_once "./includes/conn.php";


if($_SERVER["REQUEST_METHOD"] === "POST"){

try{

$sql = "INSERT INTO `users`( `fullname`, `username`, `email`, `password`, `phone`) VALUES (?,?,?,?,?)";

$stmt = $conn->prepare($sql);

$fullname = $_POST['fullname'];
$username = $_POST['username'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$phone = $_POST['phone'];

$stmt->execute([$fullname,$username,$email,$password,$phone]);

header('location: login.php');
die();

}catch(PDOException $e){
  $error =  "Connection failed: " . $e->getMessage();

}

}








?>










<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login/Registeration</title>
  <link rel="stylesheet" href="css/main.min.css">
  <link rel="stylesheet" href="css/styles.css">
</head>
<body class="bg-dark">
  <div class="container" >
    <div class="row justify-content-center mt-5">
      <div class="col-lg-5 main position-relative mt-5 d-flex flex-column align-items-center">
        <h2 class="text-white mt-5 fw-bold">Registeration Form</h2>

        <form action="" method="POST" class="mt-3 w-100 px-3">
          <div class="form-group mb-3">
            <label for="" class="text-white form-label">Fullname*</label>
            <input type="text" placeholder="e.g. John Doe" class="form-control form-control-input py-2" name="fullname" required>
          </div>
          <div class="form-group mb-3">
            <label for="" class="text-white form-label">Username*</label>
            <input type="text" placeholder="Username" class="form-control form-control-input py-2" name="username" required>
          </div>
          <div class="form-group mb-3">
            <label for="" class="text-white form-label">Email*</label>
            <input type="email" placeholder="Email" class="form-control form-control-input py-2" name="email" required>
          </div>
          <div class="form-group mb-3">
            <label for="" class="text-white form-label">Password*</label>
            <input type="password" placeholder="Password" class="form-control form-control-input py-2" name="password" required>
          </div>
          <div class="form-group mb-3">
            <label for="" class="text-white form-label">Phone</label>
            <input type="text" placeholder="e.g. +2011423253" class="form-control form-control-input py-2" name="phone">
          </div>
          <button class="btn my-4 bg-light fs-5 fw-bold w-100 border-0 py-2">Register</button>
          <a href="login.php" class="text-center d-block fs-4 text-white mb-5">Already have account?</a>
        </form>

        <?php
			if (isset($error)) {
    ?>
    <div style="color: #ee0002; padding: 5px;">
    <?php echo $error ?>
    </div>
    <?php
			}
			?>
      </div>
    </div>
  <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>