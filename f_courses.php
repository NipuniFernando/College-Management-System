<?php include 'f_header.php'; ?>
<?php include 'conn.php'; ?>

  <main id="main" data-aos="fade-in">

    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs">
      <div class="container">

        <h2>Courses</h2>
        <p>Details about Cources we offer to our Students</p>
      </div>
    </div><!-- End Breadcrumbs -->

    <!-- ======= Courses Section ======= -->
    <section id="popular-courses" class="courses">
      <div class="container" data-aos="fade-up">

        <div class="row" data-aos="zoom-in" data-aos-delay="100">
          <?php 
            $sql="SELECT * FROM tb_offline_course LEFT JOIN tb_course_category ON tb_course_category.cat_id=tb_offline_course.cat_id ";
            $result = $conn->query($sql);
          ?>

          <?php  
            if($result->num_rows>0){
              while($row = $result->fetch_assoc()){
              ?>

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0">
            <div class="course-item">
              <img src="uploads/offlineCourses/<?php echo $row['course_image']; ?>" class="img-fluid" width="500px" alt="...">
              <div class="course-content">
                <div class="d-flex justify-content-between align-items-center mb-3">
                  <h4><?php echo $row['cat_name']; ?></h4>
                  <p class="price">LKR <?php echo $row['course_fee']; ?></p>
                </div>

                <h3><a href="f_course-details.php?course_id=<?php echo $row['course_id'];?>"><?php echo $row['course_name']; ?></a></h3>
                <p><?php echo $row['course_description']; ?></p>

                <div class="trainer d-flex justify-content-between align-items-center">
                  <div class="trainer-profile d-flex align-items-center">
                    
                    <a href="f_course-details.php?course_id=<?php echo $row['course_id'];?>" class=" btn btn-outline-primary">View Course</a>
                  </div>
                  
                </div><br>
                
              </div>
            </div>
          </div> <!-- End Course Item--><br><br>
        <?php } } ?>

          

        </div>

      </div>
    </section>

  </main><!-- End #main -->

 <?php include 'f_footer.php'; ?>