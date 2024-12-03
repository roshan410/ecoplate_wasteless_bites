
<?php
 	include("dbconnect.php");
	extract($_POST);
	session_start();

if(isset($_POST['btn']))
{
$qry1=mysqli_query($conn,"select * from register where rollno='$rollno'");
$count=mysqli_num_rows($qry1);
if($count>0){                                                                                           
echo "<script>alert('Roll Number already taken')</script>";
}else{
$qry=mysqli_query($conn,"insert into register values('','$name','$dob','$email','$phone','$dep','$year','$rollno','$roomno','$guard')");
	if($qry)
	{
	
	echo "<script>alert('Registered sucessfully')</script>";
	
	}	
}
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ECOPLATE</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    
	
	
	
	
	<link rel="stylesheet" href="index.css">
</head>
<body>
    <nav class="navbar">
        <div class="nav-content" >
            <a style="margin-right:50px" href="#" class="logo">ECOPLATE: WASTELESS BITES</a>
            <button class="menu-btn">
                <i class="fas fa-bars"></i>
            </button>
            <div class="nav-links">
                <button class="close-btn">
                    <i class="fas fa-times"></i>
                </button>
                <a href="uhome.php" class="nav-link ">
                    <i class="fas fa-home"></i> Home 
                </a>
                <a href="view.php" class="nav-link">
                    <i class="fa-solid fa-utensils"></i> View
                </a>
                <a href="myorders.php" class="nav-link">
                    <i class="fa-solid fa-file-alt"></i>Report
                </a>
                <a href="profile.php" class="nav-link">
                    <i class="fas fa-user"></i> Profile
                </a>
                <a href="givef.php" class="nav-link">
                <i class="fa-solid fa-comment-dots"></i>Feedback
                </a>
				<a href="vnoti.php" class="nav-link active">
           <i class="fa-solid fa-bell"></i>
                    Notification
                </a>
                <a href="index.php" class="nav-link">
                    <i class="fa-solid fa-right-from-bracket"></i>Logout
                </a>
				
            </div>
        </div>
    </nav>

   
    <br /><br /><br /><br />
	
        <br /><br /><br /><br />
	
  <h3 style="text-align: center; color: #2c3e50; font-size: 24px; margin: 30px 0; font-family: Arial, sans-serif; border-bottom: 2px solid #3498db; padding-bottom: 15px;">Notification</h3>

<table style="width: 100%; border-collapse: collapse; margin: 20px auto; background-color: white; font-family: Arial, sans-serif; box-shadow: 0 0 20px rgba(0,0,0,0.1); border-radius: 8px; overflow: hidden;">
    <tr>
        <td colspan="10" style="padding: 15px;">&nbsp;</td>
    </tr>
    <tr style="background-color: #3498db;">
        <td style="padding: 15px;">&nbsp;</td>
        <td style="padding: 15px;"><div style="text-align: center; color: white; font-weight: bold;">S.NO</div></td>
        <td style="padding: 15px;"><div style="text-align: center; color: white; font-weight: bold;">DATE</div></td>
        <td style="padding: 15px;"><div style="text-align: center; color: white; font-weight: bold;">NOTIFICATION</div></td>
  
    </tr>
    <tr>
        <td colspan="7" style="padding: 10px;">&nbsp;</td>
    </tr>
    
    <?php
    $qry=mysqli_query($conn,"select * from noti");
    $i=1;
    while($row=mysqli_fetch_array($qry))
    {
    ?>
    <tr style="transition: all 0.3s ease; hover: background-color: #f5f6fa;">
        <td style="width: 1%; padding: 12px;">&nbsp;</td>
        <td style="padding: 12px; border-bottom: 1px solid #e9ecef;"><div style="text-align: center; color: #2d3436;"><?php echo $row['id'];?></div></td>
        <td style="padding: 12px; border-bottom: 1px solid #e9ecef;"><div style="text-align: center; color: #2d3436;"><?php echo $row['date'];?></div></td>
        <td style="padding: 12px; border-bottom: 1px solid #e9ecef;"><div style="text-align: center; color: #2d3436;"><?php echo $row['notification'];?></div></td>
       
    </tr>
    
    <tr style="background-color: #ffffff;">
        <td style="padding: 8px;">&nbsp;</td>
        <td style="padding: 8px;">&nbsp;</td>
        <td style="padding: 8px;">&nbsp;</td>
      
       
    </tr>
    <?php
    $i++;
    }
    ?>
    
    <tr>
        <td colspan="7" style="text-align: center; padding: 15px;">&nbsp;</td>
    </tr>
</table>
 <br /><br /><br />
 <br /><br /><br />


   
   
   
   <script src="script.js"></script>
</body>
</html>