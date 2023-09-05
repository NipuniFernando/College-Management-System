<?php include 'header.php'; ?>
<?php include 'nav.php';    ?>

<?php $dashboard="dashboard_".$_SESSION['role'].".php";
include "$dashboard";
 ?>

<?php include 'footer.php'; ?>