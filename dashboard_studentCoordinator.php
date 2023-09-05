
<div>
  
  <div class="card-columns">
    <div class="card bg-primary">
      <div class="card-body text-center">
        
          <a href="m_front_office/mark_attendence.php"><p class="card-text text-white">Student Attendence</p></a>
        
      </div>
    </div>
    <div class="card bg-warning">
      <div class="card-body text-center">
        <a href="m_front_office/view_course_details.php"><p class="card-text text-white">Course Details</p></a>
      </div>
    </div>
    <div class="card bg-success">
      <div class="card-body text-center">
        <a href="m_front_office/payments.php"><p class="card-text text-white">Student Payments</p></a>
      </div>
    </div>
    <div class="card bg-info">
      <div class="card-body text-center">
        <a href="m_front_office/add_lecturer_hall.php"><p class="card-text text-white">Lecturer Hall Mnnagement</p></a>
      </div>
    </div>   
    
  </div>
</div>



<!-- VIEW -->
<div class="card">
  <div class="card-header">
  	<h3>Mark Students Attendence</h3>
    <h5>Today's Batches</h5>
  </div>
  <?php  
  $sql="SELECT * FROM tb_batch 
  LEFT JOIN tb_offline_course ON tb_offline_course.course_id=tb_batch.course_id
  WHERE batch_day='".date('l')."' ";
  $result=$conn->query($sql);
  $result->num_rows;
?>

<table class="table table-strip">
  <thead>
    <tr>
      <th></th>
      <th>Batch Name</th>
      <th>Course Name</th>
      <th>Commence Date</th>
      <th>Batch Day</th>
      <th>Starting Time</th>
      <th>Ending Time</th>
      <th>Max Students</th>
      <th>Duration</th>
    </tr>
  </thead>
  <tbody>
    <?php 
      if($result->num_rows>0){
        while($row=$result->fetch_assoc()){
          ?>
          <tr>
            <td></td>
            <td> <?php echo $row['batch_name']; ?> </td>
            <td> <?php echo $row['course_name']; ?> </td>
            <td> <?php echo $row['commence_date']; ?> </td>
            <td> <?php echo $row['batch_day']; ?> </td>
            <td> <?php echo $row['s_time']; ?> </td>
            <td> <?php echo $row['e_time']; ?> </td>
            <td> <?php echo $row['no_of_stu']; ?> </td>
            <td> <?php echo $row['course_duration']; ?> - <?php echo $row['course_dur_type']; ?>  </td>
            <td>
              <?php if($row['commence_date'] == date('Y-m-d') OR $row['commence_date'] < date('Y-m-d'))  { ?>
              <a href="<?php echo SITE_URL; ?>m_front_office/mark_stu_attendence.php?batch_id=<?php echo $row['batch_id'];?>" class="btn btn-success">View Students</a>
            <?php } ?>
            </td>

            
          </tr>
          <?php
        }
      } 
    ?>
    
  </tbody>
</table>
</div>


