
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
	
	
	
	<style>
	
	table,th,td{
	
	border:1px solid black;
	border-collapse:collapse;
	}
	
	</style>
	
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
                <a href="adminhome.php" class="nav-link ">
                   <i class="fa-solid fa-user-plus"></i>
                  Add  
                </a>
                <a href="orders.php" class="nav-link ">
    <i class="fa-solid fa-cart-shopping"></i>
                   Orders
                </a>
               
                <a href="noti.php" class="nav-link">
                  <i class="fa-solid fa-bell"></i>
                    Notification
                </a>
				<a href="vfeed.php" class="nav-link">
                <i class="fa-solid fa-comment-dots"></i>
                    Feedbacks
                </a>
				<a href="vstudent.php" class="nav-link active">
                 <i class="fa-solid fa-user-graduate"></i>
                    Student
                </a>
				
				<a href="myordersadmin.php" class="nav-link">
                    <i class="fa-solid fa-file-alt"></i>Bills
                </a>
				<a href="index.php" class="nav-link">
                      <i class="fa-solid fa-right-from-bracket"></i>
                    Logout
                </a>
				
				
				
            </div>
        </div>
    </nav>

   
    <br /><br /><br /><br />
	 <br /><br /><br /><br />
     	<div style="padding: 20px; font-family: Arial, sans-serif;">
    <h3 style="text-align: center; color: #2c3e50; font-size: 24px; margin-bottom: 30px; text-transform: uppercase; letter-spacing: 2px;">Students Details</h3>
    
    <table style="width: 100%; border-collapse: collapse; background-color: #ffffff; box-shadow: 0 0 20px rgba(0,0,0,0.1); border-radius: 8px; overflow: hidden;">
        <tr style="background-color: #f8f9fa;">
            <td colspan="10" style="padding: 15px;">&nbsp;</td>
        </tr>
        <tr style="background-color: #3498db;">
            <td style="padding: 15px;">&nbsp;</td>
            <td style="padding: 15px;"><div style="text-align: center; color: #ffffff; font-weight: bold;">Name</div></td>
            <td style="padding: 15px;"><div style="text-align: center; color: #ffffff; font-weight: bold;">Department</div></td>
            <td style="padding: 15px;"><div style="text-align: center; color: #ffffff; font-weight: bold;">DOB</div></td>
            <td style="padding: 15px;"><div style="text-align: center; color: #ffffff; font-weight: bold;">Roll Number</div></td>
            <td style="padding: 15px;"><div style="text-align: center; color: #ffffff; font-weight: bold;">Room Number</div></td>
        </tr>
        
        <?php
        $qry=mysqli_query($conn,"select * from register ORDER BY name ASC");
        $i=1;
        while($row=mysqli_fetch_array($qry))
        {
        ?>
        <tr style="transition: all 0.3s ease;">
            <td style="padding: 15px; border-bottom: 1px solid #eee;">&nbsp;</td>
            <td style="padding: 15px; border-bottom: 1px solid #eee;"><div style="text-align: center;"><?php echo $row['name'];?></div></td>
            <td style="padding: 15px; border-bottom: 1px solid #eee;"><div style="text-align: center;"><?php echo $row['dep'];?></div></td>
            <td style="padding: 15px; border-bottom: 1px solid #eee;"><div style="text-align: center;"><?php echo $row['dob'];?></div></td>
            <td style="padding: 15px; border-bottom: 1px solid #eee;"><div style="text-align: center;"><?php echo $row['rollno'];?></div></td>
            <td style="padding: 15px; border-bottom: 1px solid #eee;"><div style="text-align: center;"><?php echo $row['roomno'];?></div></td>
            <td style="padding: 15px; border-bottom: 1px solid #eee;">
                <div style="text-align: center;">
                    <a href="delete.php?id=<?php echo $row['id'];?>" style="text-decoration: none; color: #e74c3c; font-weight: bold; padding: 5px 10px; border-radius: 4px; transition: all 0.3s ease;">Delete</a>
                </div>
            </td>
        </tr>
        <tr style="background-color: #ffffff;">
            <td style="padding: 8px;">&nbsp;</td>
            <td style="padding: 8px;">&nbsp;</td>
            <td style="padding: 8px;">&nbsp;</td>
            <td style="padding: 8px;">&nbsp;</td>
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
</div>

		
 <br /><br /><br />


   
   
   
   <script src="script.js"></script>
</body>
</html>