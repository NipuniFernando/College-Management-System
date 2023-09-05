<h1 class="text-primary"> <b><i>LECTURER DASHBOARD</i></b> </h1>

<h1></h1>
<br><br>
<?php 
if(isset($_SESSION['user_id'])){   
	$user_id=$_SESSION['user_id'];
}
	  
	$sql="SELECT * FROM tb_user
	LEFT JOIN tb_lecturer ON  tb_user.user_id=tb_lecturer.user_id
	WHERE tb_lecturer.user_id='$user_id'";
	$result=$conn->query($sql);
	$result->num_rows;

	if($result->num_rows>0){
		while($row=$result->fetch_assoc()){
					
?>

<div class="container">
  <div class="row">
    <div class="col-md-4 img">
      <img src="<?php echo SITE_URL; ?>/uploads/lecturer/<?php echo $row['profile_image'];?>" align="left" alt="" width="250px" class="img-rounded img-fluid">
      <br><br>
    </div>
    <div class="col-md-8 details">
      <blockquote>
        <h2 class="text-primary"><?php echo $row['title'];?> <?php echo $row['lec_first_name']; ?> <?php echo $row['lec_last_name']; ?></h2>
        <small><cite title="Source Title"><?php echo $row['lec_qual_name'];?><i class="icon-map-marker"></i></cite></small><br> 
        <!-- small><cite title="Source Title">Lecturing Languages : <?php //echo $row['lang_name'];?><i class="icon-map-marker"></i></cite></small> -->
      </blockquote>

    </div>
  </div>
</div>

<?php $lecturer_id =$row['lecturer_id']; ?>

<?php } } ?>


<!-- VIEW 1-->
<br>
<div class="row">
	<div class="col-md-4 card">
	
	<div class="card-header bg-primary">
	  <h2 class="text-white "> <i> <b>Your Subjects</b> </i> </h2>
	</div>

	<?php  
	$sql="SELECT * FROM tb_lecturer_subject
    LEFT JOIN tb_subject ON tb_subject.sub_id=tb_lecturer_subject.sub_id  
    WHERE tb_lecturer_subject.lecturer_id='$lecturer_id' ";
	$result=$conn->query($sql);
	$result->num_rows;
?>
<br><br>
<table class="table table-strip">
	
	<tbody>
		<?php 
			if($result->num_rows>0){
				while($row=$result->fetch_assoc()){
					?>
					<tr>
						<td> <?php echo $row['sub_name']; ?> </td>
	
					</tr>
					<?php
				}
			} 
		?>
		
	</tbody>
</table>
</div>
</div>

<!-- VIEW 2-->
<br>
<div class="row">
	<div class="col-md-8 card">
	
	<div class="card-header bg-primary">
	  <h2 class="text-white "> <i> <b>Your Timetable</b> </i> </h2>
	</div>

	<?php  
	$sql="SELECT * FROM tb_timetable
    LEFT JOIN tb_subject ON tb_subject.sub_id=tb_timetable.sub_id  
    LEFT JOIN tb_batch ON tb_batch.batch_id=tb_timetable.batch_id  
    LEFT JOIN tb_offline_course ON tb_offline_course.course_id=tb_timetable.course_id  
    WHERE tb_timetable.lecturer_id='$lecturer_id' ";
	$result=$conn->query($sql);
	$result->num_rows;
?>
<br><br>
<table class="table table-strip">
	<thead>
		<tr>
			<th>Course</th>
			<th>Subject Name</th>
			<th>Batch Name</th>
			<th>Day</th>
			<th>Starting Time</th>
			<th>Ending Time</th>
		</tr>
	</thead>
	<tbody>
		<?php 
			if($result->num_rows>0){
				while($row=$result->fetch_assoc()){
					?>
					<tr>
						<td> <?php echo $row['course_name']; ?> </td>
						<td> <?php echo $row['sub_name']; ?> </td>
						<td> <?php echo $row['batch_name']; ?> </td>
						<td> <?php echo $row['classDays']; ?> - <?php echo $row['batch_day']; ?> </td>
						<td> <?php echo $row['s_time']; ?> </td>
						<td> <?php echo $row['e_time']; ?> </td>
	
					</tr>
					<?php
				}
			} 
		?>
		
	</tbody>
</table>
</div>
</div>

