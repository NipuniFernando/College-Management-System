<?php include 'f_header.php'; ?>
<?php include 'conn.php'; ?>
<?php include 'helper.php'; ?>
<?php include 'config.php'; ?>

<?php 
// $course_id=NULL;
if($_SERVER['REQUEST_METHOD']=="GET"){
  $course_id=clean_data($_GET['course_id']);

    $sql="SELECT * FROM tb_offline_course 
    LEFT JOIN tb_course_category ON tb_course_category.cat_id=tb_offline_course.cat_id 
    LEFT JOIN tb_non_academic_staff ON tb_non_academic_staff.s_id=tb_offline_course.s_id 
    WHERE tb_offline_course.course_id='$course_id'";
    $result_offline_course = $conn->query($sql);

    //subject
  // $sql_module="SELECT * FROM tb_offline_course_modules 
  // LEFT JOIN tb_subject ON tb_subject.sub_id=tb_offline_course_modules.sub_id 
  // WHERE tb_offline_course_modules.course_id='$course_id'";
  // $result_module=$conn->query($sql_module);
  // $result_module->num_rows;


  $sql_batch="SELECT * FROM tb_batch WHERE tb_batch.course_id='$course_id'";
  $result_batch=$conn->query($sql_batch); 
  
?>


  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs" data-aos="fade-in">
      <div class="container">
        <!-- PHP part -->
        
          <?php  
            if($result_offline_course->num_rows>0){
              while($row = $result_offline_course->fetch_assoc()){
              ?>
        <!-- PHP part -->
        <h2><?php echo $row['course_name']; ?> - Course Details</h2>
        <p>CKC COLLEGE - Your Home of Education</p>
      </div>
    </div><!-- End Breadcrumbs -->

    <!-- ======= Cource Details Section ======= -->
    <section id="course-details" class="course-details">
      <div class="container" data-aos="fade-up">

        <div class="row">
          <div class="col-lg-8">
            <img src="uploads/offlineCourses/<?php echo $row['course_image']; ?>" width="800px" class="img-fluid" alt="">
            <h3><?php echo $row['course_name']; ?></h3>
          </div>

          <div class="col-lg-4">
            <div class="course-info d-flex justify-content-between align-items-center">
              <h5>Course Type</h5>
              <p><?php echo $row['cat_name']; ?></p>
            </div>

            <div class="course-info d-flex justify-content-between align-items-center">
              <h5>Course Duration</h5>
              <p><a href="#"><?php echo $row['course_duration']." ".$row['course_dur_type']; ?></a></p>
            </div>

            <div class="course-info d-flex justify-content-between align-items-center">
              <h5>Course Fee</h5>
              <p>LKR <?php echo $row['course_fee']; ?></p>
            </div>

            <div class="course-info d-flex justify-content-between align-items-center">
              <h5>Course Registration Fee</h5>
              <p>LKR <?php echo $row['course_reg_fee']; ?></p>
            </div>

            <div class="course-info d-flex justify-content-between align-items-center">
              <h5>Course Level</h5>
              <p><?php echo $row['course_level']; ?></p>
            </div>

            <div class="course-info d-flex justify-content-between align-items-center">
              <h5>Contact Person</h5>
              <p><?php echo $row['staff_first_name']; ?></p>
            </div>

            <div class="course-info d-flex justify-content-between align-items-center">
              <h5>Tel No</h5>
              <p><?php echo $row['staff_contact_no']; ?></p>
            </div>
          </div>
        </div>
      </div>
    </section><!-- End Cource Details Section -->
    <?php } } ?>

         
    <!-- Batch -->
    <div class="container">
      <div class="card">
        <div class="card-header">
          <h5>Batch Details</h5>

        </div>
        <div class="card-body">
            <table class="table table-strip">
              <thead>
                <tr>
                  <th>Available Batches</th>
                  <th>Commence Date</th>
                  <th>Day</th>
                  <th>Staring Time</th>
                  <th>Ending Time</th>
                  <th>Available Seats</th>  
                </tr>
              </thead>
              <tbody>
                <?php 
                  if($result_batch->num_rows>0){
                    while($row_batch=$result_batch->fetch_assoc()){ 
               ?>          
              
                <tr>
                  <td><?php echo $row_batch['batch_name']; ?></td>
                  <td><?php echo $row_batch['commence_date']; ?></td>
                  <td><?php echo $row_batch['batch_day']; ?></td>
                  <td><?php echo $row_batch['s_time']; ?></td>
                  <td><?php echo $row_batch['e_time']; ?></td>
                  <td><?php echo $row_batch['no_of_stu']-$row_batch['no_of_enrolled']; ?></td>
                  <td><a href="login_stu.php?course_id=<?php echo $row_batch['course_id'];?>&batch_id=<?php echo $row_batch['batch_id'];?>" class=" btn btn-outline-primary">Enroll now</a></td>
                </tr>
                <?php }} ?>
              </tbody>
            
        </div>
        <div class="card-footer">
          
        </div>
      </table>

      </div> <!-- card -->
    </div> <!-- container -->

    <br><br>

    <!-- VIEW -->
    <div class="container">
        
            <div class="card">
              <div class="card-header">
                <h5>Course Content</h5>
              </div>

            <div class="card-body">

            <table class="table table-strip">
              <thead>
                <tr>
                  <th>Module Name</th>
                  <th>Course Content</th>
                  <th>Lecturer</th>
                  
                  
                </tr>
              </thead>
              <tbody>
                <?php 
                  $sql_module="SELECT * FROM tb_offline_course_modules 
                  LEFT JOIN tb_subject ON tb_subject.sub_id=tb_offline_course_modules.sub_id 
                  WHERE tb_offline_course_modules.course_id='$course_id'";
                  $result_module=$conn->query($sql_module);

                  if($result_module->num_rows>0){
                    while($roww=$result_module->fetch_assoc()){
                      ?>
                      
                      <tr>
                        <td colspan="2"> <?php echo $roww['sub_name']; ?> </td>
                        <td>
                          <?php 
                            $sql_lecturer="SELECT * FROM tb_lecturer_subject
                            LEFT JOIN tb_lecturer ON tb_lecturer.lecturer_id=tb_lecturer_subject.lecturer_id  
                            LEFT JOIN tb_subject ON tb_subject.sub_id=tb_lecturer_subject.sub_id  
                            WHERE tb_lecturer_subject.sub_id='".$roww['sub_id']."' ";
                            $result_lecturer=$conn->query($sql_lecturer);

                            if($result_lecturer->num_rows>0){
                            while($row_lecturer=$result_lecturer->fetch_assoc()){

                            // $row_lecturer=$result_lecturer->fetch_assoc();
                            ?>
                            
                            <img class="img-fluid" style="width:60px;" src="uploads/lecturer/<?php echo $row_lecturer['profile_image'];?>" />
                            <?php echo $row_lecturer['title']." ".$row_lecturer['lec_first_name']; ?>
                            <?php }} ?>
                          
                        </td>
                      </tr>
                      <?php  
                      $sql_content="SELECT * FROM tb_subject_content WHERE tb_subject_content.sub_id='".$roww['sub_id']."'";
                      $result_content=$conn->query($sql_content); 
                      if($result_content->num_rows>0){
                        while($row_content=$result_content->fetch_assoc()){
                      ?>
                      <tr>
                        <td></td>
                        <td> <?php echo $row_content['content_name']; ?> </td>
                        <td></td>
                      </tr>
                      <?php
                      //lecturer
                    } 
                  }

                    //module
                    }
                  } 

              
                ?>
                
              </tbody>
            </table>
            </div>
            </div>
          
        </div>
        <br><br>
        <!-- VIEW -->

       
    

   

  </main><!-- End #main -->
<?php } ?>

 <?php include 'f_footer.php'; ?>