<?php 

require_once "./includes/conn.php";
require_once "./includes/logged.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

  try{

$sql = "UPDATE `users` SET `fullname`=?,`username`=?,`email`=?,`password`=?,`phone`=?,`active`=? WHERE `id`=?";


$stmt = $conn->prepare($sql);
$fullname = $_POST['fullname'];
$username = $_POST['username'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$phone = $_POST['phone'];

if (isset($_POST['active'])) {
  $active = 'Yes';
} else {
  $active = 'No';
}
$id = $_POST['id'];


$stmt->execute([$fullname,$username,$email,$password,$phone,$active,$id]);

  }catch(PDOException $e){
    $error =  "Connection failed: " . $e->getMessage();
  }

}


if (isset($_GET['id'])) {

  $sql = "SELECT * FROM `users` WHERE id = ?";
  $stmt = $conn->prepare($sql);

  $id = $_GET['id'];

  $stmt->execute([$id]);
  $user = $stmt->fetch();

  if ($user === false) {
      header('Location: users.php');
      die();
  }
} else {
  header('Location: users.php');
  die();
}










?>










<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="css/main.min.css" />
    <link rel="stylesheet" href="css/styles.css" />
  </head>
  <body>
    <main>
      <nav
        class="navbar navbar-dark bg-dark navbar-expand-lg"
        aria-label="Dark offcanvas navbar"
      >
        <div class="container-fluid">
          <a class="navbar-brand" href="#">Hello, Jhon Doe</a>
          <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="offcanvas"
            data-bs-target="#offcanvasNavbarDark"
            aria-controls="offcanvasNavbarDark"
          >
            <span class="navbar-toggler-icon"></span>
          </button>
          <div
            class="offcanvas offcanvas-end text-bg-dark"
            tabindex="-1"
            id="offcanvasNavbarDark"
            aria-labelledby="offcanvasNavbarDarkLabel"
          >
            <div class="offcanvas-header">
              <button
                type="button"
                class="btn-close btn-close-white"
                data-bs-dismiss="offcanvas"
                aria-label="Close"
              ></button>
            </div>
            <div class="offcanvas-body">
              <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                <li class="nav-item dropdown">
                  <a
                    class="nav-link active dropdown-toggle"
                    href="#"
                    role="button"
                    data-bs-toggle="dropdown"
                    aria-expanded="false"
                  >
                    Users
                  </a>
                  <ul class="dropdown-menu dropdown-menu-dark">
                    <li><a class="dropdown-item" href="add_user.php">Add user</a></li>
                    <li><hr class="dropdown-divider" /></li>
                    <li><a class="dropdown-item" href="users.php">All users</a></li>
                  </ul>
                </li>
                <li class="nav-item dropdown">
                  <a
                    class="nav-link dropdown-toggle"
                    href="#"
                    role="button"
                    data-bs-toggle="dropdown"
                    aria-expanded="false"
                  >
                    Classes
                  </a>
                  <ul class="dropdown-menu dropdown-menu-dark">
                    <li><a class="dropdown-item" href="add_class.html">Add class</a></li>
                    <li><hr class="dropdown-divider" /></li>
                    <li><a class="dropdown-item" href="classes.html">All classes</a></li>
                  </ul>
                </li>
                <li class="nav-item dropdown">
                  <a
                    class="nav-link dropdown-toggle"
                    href="#"
                    role="button"
                    data-bs-toggle="dropdown"
                    aria-expanded="false"
                  >
                    Teachers
                  </a>
                  <ul class="dropdown-menu dropdown-menu-dark">
                    <li><a class="dropdown-item" href="add_teacher.html">Add teacher</a></li>
                    <li><hr class="dropdown-divider" /></li>
                    <li><a class="dropdown-item" href="teachers.html">All teachers</a></li>
                  </ul>
                </li>
                <li class="nav-item dropdown">
                  <a
                    class="nav-link dropdown-toggle"
                    href="#"
                    role="button"
                    data-bs-toggle="dropdown"
                    aria-expanded="false"
                  >
                    Testimonials
                  </a>
                  <ul class="dropdown-menu dropdown-menu-dark">
                    <li>
                      <a class="dropdown-item" href="add_testimonial.html">Add testimonial</a>
                    </li>
                    <li><hr class="dropdown-divider" /></li>
                    <li>
                      <a class="dropdown-item" href="testimonials.html">All testimonials</a>
                    </li>
                  </ul>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </nav>

      <div class="container my-5">
        <div class="bg-light p-5 rounded">
          <h2 class="fw-bold fs-2 mb-5 pb-2">Edit User</h2>
          <form action="" method="POST" class="px-5" enctype="multipart/form-data">
          <input type="hidden" name="id" value="<?php echo $id ?>">
            <div class="form-group mb-3 row">
              <label for="" class="form-label col-md-2 fw-bold text-end"
                >Fullname:</label
              >
              <div class="col-md-10">
                <input
                  type="text"
                  placeholder="e.g. John Doe"
                  class="form-control py-2"
                  name="fullname"
                  value="<?php echo $user['fullname'] ?>"
                />
              </div>
            </div>
            <div class="form-group mb-3 row">
              <label for="" class="form-label col-md-2 fw-bold text-end"
                >Username:</label
              >
              <div class="col-md-10">
                <input
                  type="text"
                  placeholder="Username"
                  class="form-control py-2"
                  name="username"
                  value="<?php echo $user['username'] ?>"
                />
              </div>
            </div>
            <div class="form-group mb-3 row">
              <label for="" class="form-label col-md-2 fw-bold text-end"
                >Email:</label
              >
              <div class="col-md-10">
                <input
                  type="email"
                  placeholder="email@example.com"
                  class="form-control py-2"
                  name="email"
                  value="<?php echo $user['email'] ?>"
                />
              </div>
            </div>
            <div class="form-group mb-3 row">
              <label for="" class="form-label col-md-2 fw-bold text-end"
                >Password:</label
              >
              <div class="col-md-10">
                <input
                  type="password"
                  placeholder="Password"
                  class="form-control py-2"
                  name="password"
                  value="<?php echo $user['password'] ?>"
                />
              </div>
            </div>
            <div class="form-group mb-3 row">
              <label for="" class="form-label col-md-2 fw-bold text-end"
                >Phone:</label
              >
              <div class="col-md-10">
                <input
                  type="text"
                  placeholder="+20133332323"
                  class="form-control py-2"
                  name="phone"
                  value="<?php echo $user['phone'] ?>"
                />
              </div>
            </div>
            <div class="form-group mb-3 row">
              <label for="" class="form-label col-md-2 fw-bold text-end"
                >Active:</label
              >
              <div class="col-md-10">
                <input
                  type="checkbox"
                  class="form-check-input"
                  <?php echo $user['active'] === 'Yes' ? 'checked' : '' ?>
                  style="padding: 0.7rem;"
                  name="active"
                  
                />
              

              </div>
            </div>
            <div class="text-end">
            <button
              class="btn mt-4 btn-secondary text-white fs-5 fw-bold border-0 py-2 px-md-5"
            >
              Update User
            </button>
          </div>
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
    </main>
    <script src="js/bootstrap.bundle.min.js"></script>
  </body>
</html>