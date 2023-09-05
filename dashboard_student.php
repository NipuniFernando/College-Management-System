<?php
if(isset($_SESSION['course_id']) && isset($_SESSION['batch_id']) && isset($_SESSION['user_id'])){   
	$course_id = $_SESSION['course_id'];
    $batch_id = $_SESSION['batch_id'];
    $user_id = $_SESSION['user_id'];

    $sql_stu="SELECT * FROM tb_student WHERE user_id='$user_id'";
    $result_stu=$conn->query($sql_stu);
    $row_stu = $result_stu->fetch_assoc();
    $stu_id=$row_stu['stu_id'];

		if(isset($_SESSION['action']) && $_SESSION['action']="enroll_course"){
			

			$sql_err2="SELECT * FROM tb_student_course WHERE course_id='$course_id' AND stu_id='$stu_id' AND status='1'" ;
			$result_err2=$conn->query($sql_err2);
			if($result_err2->num_rows>0){
				?>
<div class="card" data-aos="fade-in" style="margin-top:100px; ">
    <div class="container">
        <div class="card-header">
            <h2 class="text-success text-center"> <i class="fas fa-check-circle fa-2x"></i> <br>You Already enrolled !!
            </h2>

            <h4 class="text-center">Click <a href="m_student_vle/reg_card.php">here</a> to get your registration Card
            </h4>
        </div>
    </div>
</div>

<?php
			}

			if($result_err2->num_rows<=0 AND @$_POST['operate']!="yes"){
				//Register to Course
				?>
<!-- sureMessage -->
<div class="container ">
    <div class="row h-100">
        <div class="col-12 text-center">
            <div class="alert alert-primary alert-dismissible">
                <h5 align="center"> <i class="icon fas fa-exclamation-circle"></i> Confirm Enrollment</h5>
                <p align="center">Are you sure to enroll to this Course?</p>
                <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
                    <!-- <input type="hidden" name="sub_id" value="<?php //echo $sub_id; ?>"> -->
                    <button type="submit" class="btn btn-warning" name="operate" value="yes">Yes</button>
                    <button type="submit" class="btn btn-success" name="operate" value="no">No</button>

                </form>
            </div>
        </div>
    </div>
</div>
<!-- sureMessage -->
<?php

			}//else End
		}//if end

		if($_SERVER['REQUEST_METHOD']=="POST" && @$_POST['operate']=="yes"){
							$date = date('y-m-d');

							  $sql_stu_course="INSERT INTO `tb_student_course`( `stu_id`, `course_id`,`batch_id`,`date`,`status`) VALUES('$stu_id','$course_id','$batch_id','$date','1')";
							$result_stu_course=$conn->query($sql_stu_course);

							// $sql_u="UPDATE tb_batch SET no_of_enrolled=no_of_enrolled+1 WHERE course_id='$course_id' AND batch_id='$batch_id'";
     					// 	$conn->query($sql_u);

               $sql_payment = "INSERT INTO `tb_payment`(`stu_id`, `course_id`, `batch_id`,`payment_status_id`) VALUES('$stu_id','$course_id','$batch_id','1')";  
              $r_payment=$conn->query($sql_payment);

							
							 
              //SELECT
							       $sql="SELECT * FROM tb_batch LEFT JOIN tb_offline_course ON tb_offline_course.course_id=tb_batch.course_id WHERE tb_batch.course_id='$course_id' AND tb_batch.batch_id='$batch_id' ";
							       $result=$conn->query($sql); 
							     
 
							       if($result->num_rows>0){
							         while($row = $result->fetch_assoc()){
							         ?>

<div class="card" data-aos="fade-in" style="margin-top:100px; ">
    <div class="container">
        <div class="card-header">
            <h2 class="text-success text-center"> <i class="fas fa-check-circle fa-2x"></i> <br>Successfully Registed !!
            </h2>
        </div>
        <div class="card-body">
            <!-- PHP part -->
            <table class="table table-striped">

                <tr>
                    <td>
                        <h2>Course Name </th>
                    <td><?php echo $row['course_name']; ?> </h2>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h2>Batch Name </th>
                    <td><?php echo $row['batch_name']; ?></h2>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h2>Commence Date </th>
                    <td><?php echo $row['commence_date']; ?></h2>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h2>Batch Date </th>
                    <td><?php echo $row['batch_day']; ?></h2>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h2>Time </th>
                    <td><?php echo $row['s_time']." to ".$row['e_time']; ?></h2>
                    </td>
                </tr>
            </table>
            <hr>

            <h4 class="text-center">Click <a href="m_student_vle/reg_card.php">here</a> to get your registration Card
            </h4>
        </div>
        <?php }} ?>
        <?php

						}


					}//1st isset


		?>

        

		<!-- new -->    <!-- ======= Events Section ======= -->
    <section id="events" class="events">
      <div class="container-fluid" data-aos="fade-up">
	  <img src="uploads/logo.jpg" alt="" class="img-fluid">

        <div class="row">
          <div class="col-md-3 text-center m-1" height="300px">
            <div class="card">
              <div class="card-img">
                <img src="assets/img/facilities/vertual_learning.jpg" width="200px" alt="...">
              </div>
              <div class="card-body">
                <h5 class="card-title"><a href="<?php echo SITE_URL; ?>m_student_vle/student_vle.php">Vertual Learning Environment</a></h5>
              </div>
            </div>
          </div>
          <div class="col-md-3 text-center m-1" height="300px">
            <div class="card">
              <div class="card-img">
                <img src="assets/img/facilities/exam.jpg" width="200px" alt="...">
              </div>
              <div class="card-body">
                <h5 class="card-title"><a href="<?php echo SITE_URL; ?>m_student_vle/student_vle.php">Online Exam And Assignments</a></h5>
              </div>
            </div>
          </div>

          <div class="col-md-3 text-center m-1" height="300px">
            <div class="card">
              <div class="card-img">
                <img src="assets/img/facilities/payments.jpg" width="200px" alt="...">
              </div>
              <div class="card-body">
                <h5 class="card-title"><a href="<?php echo SITE_URL; ?>m_student_vle/make_course_payments.php">Make Course Payments</a></h5>   
              </div>
            </div>
          </div>

          

        </div>

      </div>
    </section><!-- End Events Section -->