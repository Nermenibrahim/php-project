<?php 

require_once "./admin/includes/conn.php";






    try{

$sql = " SELECT teachers.image AS timage , classes.image AS cimage , fullname , jobtitle , classname ,  age1 , age2 ,time1 ,time2 , capacity ,price FROM `classes` INNER JOIN teachers WHERE   classes.teacher_id = teachers.id  AND teachers.published = 'Yes' AND classes.published = 'Yes' ";

$stmt = $conn->prepare($sql);

$stmt->execute();

$infos = $stmt->fetchAll();

} catch(PDOException $e){
    $error =  "Connection failed: " . $e->getMessage();
  }








?>



  <!-- Classes Start -->
  <div class="container-xxl py-5">
            <div class="container">
                <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                    <h1 class="mb-3">School Classes</h1>
                    <p>Eirmod sed ipsum dolor sit rebum labore magna erat. Tempor ut dolore lorem kasd vero ipsum sit eirmod sit. Ipsum diam justo sed rebum vero dolor duo.</p>
                </div>
                <div class="row g-4">
                    <?php foreach($infos as $info){ ?>
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="classes-item">
                            <div class="bg-light rounded-circle w-75 mx-auto p-3">
                                <img class="img-fluid rounded-circle" src="img/<?php echo $info['cimage']?>" alt="">
                            </div>
                            <div class="bg-light rounded p-4 pt-5 mt-n5">
                                <a class="d-block text-center h3 mt-3 mb-4" href=""><?php echo $info['classname']?></a>
                                <div class="d-flex align-items-center justify-content-between mb-4">
                                    <div class="d-flex align-items-center">
                                        <img class="rounded-circle flex-shrink-0" src="img/<?php echo $info['timage']?>" alt="" style="width: 45px; height: 45px;">
                                        <div class="ms-3">
                                            <h6 class="text-primary mb-1"><?php echo $info['fullname']?></h6>
                                            <small><?php echo $info['jobtitle']?></small>
                                        </div>
                                    </div>
                                    <span class="bg-primary text-white rounded-pill py-2 px-3" href="">$<?php echo $info['price']?></span>
                                </div>
                                <div class="row g-1">
                                    <div class="col-4">
                                        <div class="border-top border-3 border-primary pt-2">
                                            <h6 class="text-primary mb-1">Age:</h6>
                                            <small><?php echo $info['age1']?>-<?php echo $info['age2']?> Years</small>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="border-top border-3 border-success pt-2">
                                            <h6 class="text-success mb-1">Time:</h6>

                                            <?php  
                    
                                         $time1 =  strtotime($info['time1']);
                                        $time2 =  strtotime($info['time2']);
                   
                    
                    
                                            ?>

                                            <small><?php echo date('h:i',$time1)?> -<?php echo date('h:iA',$time2) ?> </small>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="border-top border-3 border-warning pt-2">
                                            <h6 class="text-warning mb-1">Capacity:</h6>
                                            <small><?php  echo    $info['capacity']  . ' ' .'Kids'?> </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                 
                 
                </div>
            </div>
        </div>

        <?php
			if (isset($error)) {
    ?>
    <div style="color: #ee0002; padding: 5px;">
    <?php echo $error ?>
    </div>
    <?php
			}
			?>
        <!-- Classes End -->
