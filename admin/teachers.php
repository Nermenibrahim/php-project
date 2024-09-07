
<?php


require_once "./includes/conn.php";
require_once "./includes/logged.php";

try{
$sql = "SELECT * FROM `teachers`";

$stmt = $conn->prepare($sql);

$stmt->execute();


$teachers = $stmt->fetchAll();

}catch(PDOException $e){
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
          <h2 class="fw-bold fs-2 mb-5 pb-2">All Teachers</h2>
          <div class="table-responsive">
          <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">Registration Date</th>
                <th scope="col">FullName</th>
                <th scope="col">Job Title</th>
                <th scope="col">Published</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
              </tr>
            </thead>
            <tbody>

<?php 


  foreach($teachers as $teacher){

    $date = date_create($teacher['RegDate']);



    ?>


              <tr>
                <th scope="row"><?php echo  date_format($date,"d M Y ")?></th>
                <td><?php echo $teacher['fullname'] ?></td>
                <td><?php echo $teacher['jobtitle'] ?></td>
                <td><?php echo $teacher['published'] ?></td>
                <td><a href="edit_teacher.php?id=<?php echo $teacher['id'] ?>" class="text-decoration-none"><i>✒️</i></a></td>
                <td><a href="delete-teacher.php?id=<?php echo $teacher['id'] ?>" onclick ="return confirm('Are you sure you want to delete?')" class="text-decoration-none"><img src="../img/trash-bin.png" alt="" style="max-width: 35px"></a></td>
              </tr>
              
              
              
              
            </tbody>


            <?php } ?>

            <?php
			if (isset($error)) {
    ?>
    <div style="color: #ee0002; padding: 5px;">
    <?php echo $error ?>
    </div>
    <?php
			}
			?>
          </table>
        </div>
        </div>
      </div>
    </main>
    <script src="js/bootstrap.bundle.min.js"></script>
  </body>
</html>
