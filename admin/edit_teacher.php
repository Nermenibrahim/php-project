<?php 


require_once "./includes/conn.php";
require_once "./includes/logged.php";


if ($_SERVER["REQUEST_METHOD"] === "POST") {

  try{

$sql = "UPDATE `teachers` SET `fullname`=?,`jobtitle`=?,`published`=?,`image`=? WHERE `id`=?";


$stmt = $conn->prepare($sql);
$fullname = $_POST['fullname'];
$jobtitle = $_POST['jobtitle'];



if (isset($_POST['published'])) {
  $published = 'Yes';
} else {
  $published = 'No';
}

$oldImage = $_POST['oldImage'];
require_once "./includes/updateImage.php";

$id = $_POST['id'];


$stmt->execute([$fullname,$jobtitle,$published,$image_name,$id]);

  }catch(PDOException $e){
    $error =  "Connection failed: " . $e->getMessage();
  }

}


if (isset($_GET['id'])) {

  $sql = "SELECT * FROM `teachers` WHERE id = ?";
  $stmt = $conn->prepare($sql);

  $id = $_GET['id'];

  $stmt->execute([$id]);
  $teacher = $stmt->fetch();

  

  if ($teacher === false) {
      header('Location: teachers.php');
      die();
  }
} else {
  header('Location: teachers.php');
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
    <?php 

      require_once "../includes/nav.php";
      
      
      
      
      ?>
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
                    <li><a class="dropdown-item" href="add_user.html">Add user</a></li>
                    <li><hr class="dropdown-divider" /></li>
                    <li><a class="dropdown-item" href="users.html">All users</a></li>
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
          <h2 class="fw-bold fs-2 mb-5 pb-2">Edit Teacher</h2>
          <form action="" method="POST" class="px-md-5" enctype="multipart/form-data">
          <input type="hidden" name="id" value="<?php echo $id ?>">
          <input type="hidden" name="oldImage" value="<?php echo $teacher['image'] ?>">
            <div class="form-group mb-3 row">
              <label for="" class="form-label col-md-2 fw-bold text-md-end"
                >Fullname:</label
              >
              <div class="col-md-10">
                <input
                  type="text"
                  name="fullname"
                  placeholder="e.g. John Doe"
                  class="form-control py-2"
                  value="<?php echo $teacher['fullname'] ?>"
                />
              </div>
            </div>
            <div class="form-group mb-3 row">
              <label for="" class="form-label col-md-2 fw-bold text-md-end"
                >Job Title:</label
              >
              <div class="col-md-10">
                <input
                name="jobtitle"
                  type="text"
                  placeholder="e.g. Content Creator"
                  class="form-control py-2"
                  value="<?php echo $teacher['jobtitle'] ?>"
                />
              </div>
            </div>
            <div class="form-group mb-3 row">
              <label for="" class="form-label col-md-2 fw-bold text-md-end"
                >Published:</label
              >
              <div class="col-md-10">
                <input
                  
                  type="checkbox"
                  name="published"
                  class="form-check-input"
                  style="padding: 0.7rem"
                  <?php echo ($teacher['published'] === 'Yes') ? 'checked' : '' ?>
                />
              </div>
            </div>
            <hr />
            <div class="form-group mb-3 row">
              <label for="image" class="form-label col-md-2 fw-bold text-md-end"
                >Image:</label
              >
              <div class="col-md-10">
                <input
                id="image"
                name="image"
                  type="file"
                  class="form-control"
                  style="padding: 0.7rem"
                   accept="image/*"
                />
              </div>
            </div>
            <div class="row justify-content-end">
              <div class="col-md-10">
                <img
                  src="../img/<?php echo $teacher['image'] ?>"
                  alt="teacher-image"
                  style="max-width: 150px"
                 
                />
              </div>
            </div>
            <div class="text-md-end">
              <button
                class="btn mt-4 btn-secondary text-white fs-5 fw-bold border-0 py-2 px-md-5"
              >
                Edit Teacher
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
