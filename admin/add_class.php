<?php 


require_once "./includes/conn.php";
require_once "./includes/logged.php";



if ($_SERVER["REQUEST_METHOD"] === "POST") {
  if (!empty($_POST['teacher_id'])) {

    try{

    $sql = "INSERT INTO `classes`( `classname`, `price`, `capacity`, `age1`, `age2`, `time1`, `time2`, `published`, `image`, `teacher_id`) VALUES (?,?,?,?,?,?,?,?,?,?)";

    $stmt = $conn->prepare($sql);

    $classname = $_POST['classname'];
    $price = $_POST['price'];
    $capacity = $_POST['capacity'];
    $age1 = $_POST['age1'];
    $age2 = $_POST['age2'];
    $time1 = $_POST['time1'];
    $time2 = $_POST['time2'];

    if(isset($_POST['published'])){
      $published = 'Yes';
    }else{
      $published = 'No';
    }

    require_once "./includes/addimage.php";

    $teacher_id = $_POST['teacher_id'];


    $stmt->execute([$classname, $price ,$capacity , $age1 , $age2 , $time1 ,  $time2 ,  $published ,$image_name , $teacher_id ]);

    header('Location: classes.php');
    die();


  } catch (PDOException $e) {
    $error = "Connection failed: " . $e->getMessage();
}
} else {
echo "teacher is required";
}

  




}

try{

$sqlteac = "SELECT * FROM `teachers`";
$stmtteac = $conn->prepare($sqlteac);
$stmtteac->execute();

$teachers = $stmtteac->fetchAll();

} catch(PDOException $e){

  $error = "Connection failed: " . $e->getMessage();

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
          <h2 class="fw-bold fs-2 mb-5 pb-2">Add Class</h2>
          <form action="" method="POST" class="px-md-5" enctype="multipart/form-data">
            <div class="form-group mb-3 row">
              <label for="" class="form-label col-md-2 fw-bold text-md-end"
                >Class Name:</label
              >
              <div class="col-md-10">
                <input
                  type="text"
                  placeholder="e.g. Art & Design"
                  class="form-control py-2"
                  name="classname"
                />
              </div>
            </div>
            <div class="form-group mb-3 row">
              <label for="" class="form-label col-md-2 fw-bold text-md-end"
                >Teacher:</label
              >
              
              <div class="col-md-10">
                <select name="teacher_id" id="" class="form-control py-1" >
                  <?php 
                  foreach($teachers as $teacher){
                  
                  ?>
                  <option value="<?php echo $teacher['id']  ?>"><?php echo $teacher['fullname'] ?></option>

                  <?php } ?>
                  
                </select>
              </div>
              
            </div>
            <div class="form-group mb-3 row">
              <label for="" class="form-label col-md-2 fw-bold text-md-end"
                >Price:</label
              >
              <div class="col-md-10">
                <input
                  type="number"
                  step="0.1"
                  placeholder="Enter price"
                  class="form-control py-2"
                  name="price"
                />
              </div>
            </div>
            <div class="form-group mb-3 row">
              <label for="" class="form-label col-md-2 fw-bold text-md-end"
                >Capacity:</label
              >
              <div class="col-md-10">
                <input
                  type="number"
                  step="1"
                  placeholder="Enter catpacity"
                  class="form-control py-2"
                  name="capacity"
                />
              </div>
            </div>
            <div class="form-group mb-3 row">
              <label for="" class="form-label col-md-2 fw-bold text-md-end"
                >Age:</label
              >
              <div class="col-md-10">
                <label for="" class="form-label">From <input type="number" class="form-control" name="age1"></label>
                <label for="" class="form-label">To <input type="number" class="form-control" name="age2"></label>
              </div>
            </div>
            <div class="form-group mb-3 row">
              <label for="" class="form-label col-md-2 fw-bold text-md-end"
                >Time:</label
              >
              <div class="col-md-10" >
                <label for="" class="form-label">From <input type="time" class="form-control" name="time1"></label>
                <label for="" class="form-label">To <input type="time" class="form-control" name="time2"></label>
              </div>
            </div>
            <div class="form-group mb-3 row">
              <label for="" class="form-label col-md-2 fw-bold text-md-end"
                >Published:</label
              >
              <div class="col-md-10">
                <input
                  type="checkbox"
                  class="form-check-input"
                  style="padding: 0.7rem;"
                  name="published"
                  <?php echo ($teacher['published'] === 'Yes') ? 'checked' : '' ?>
                />
              </div>
            </div>
            <hr>
            <div class="form-group mb-3 row">
              <label for="" class="form-label col-md-2 fw-bold text-md-end"
                >Image:</label
              >
              <div class="col-md-10">
                <input
                  type="file"
                  class="form-control"
                  style="padding: 0.7rem;"
                  name="image"
                  id="image"
                  accept="image/*"
                />
              </div>
            </div>
            <div class="text-md-end">
            <button
              class="btn mt-4 btn-secondary text-white fs-5 fw-bold border-0 py-2 px-md-5"
            >
              Add Class
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
