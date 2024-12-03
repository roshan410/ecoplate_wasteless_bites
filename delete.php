<?php
include("dbconnect.php");
session_start();
 
	
	$id=$_REQUEST['id'];
	
	$qy=mysqli_query($conn,"delete from register where id='$id'");
if($qy){?>
	<script> alert('Deleted Successfully')
window.location.href=("vstudent.php");</script>

<?php } ?>