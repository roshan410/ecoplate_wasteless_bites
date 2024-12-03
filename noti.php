
<?php
 	include("dbconnect.php");
	extract($_POST);
	session_start();


// Process feedback form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['btn'])) {
    $feedback = mysqli_real_escape_string($conn, $_POST['noti']); // Escape user input
    $date = date("Y-m-d"); // Get the current date

    // Insert feedback into the feedback table
    $sql = "INSERT INTO noti (date,  notification) VALUES ('$date',  '$noti')";
    
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Notification submitted successfully!')</script>";
		
		
		
		
		
    } else {
        echo "<p align='center'>Error: " . mysqli_error($conn) . "</p>";
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
                <a href="adminhome.php" class="nav-link ">
                    <i class="fa-solid fa-user-plus"></i>
                  Add  
                </a>
                <a href="orders.php" class="nav-link ">
      <i class="fa-solid fa-cart-shopping"></i>
                   Orders
                </a>
               
                <a href="noti.php" class="nav-link active">
                    <i class="fa-solid fa-bell"></i>
                    Notification
                </a>
				<a href="vfeed.php" class="nav-link">
                   <i class="fa-solid fa-comment-dots"></i>
                    Feedbacks
                </a>
				<a href="vstudent.php" class="nav-link">
        <i class="fa-solid fa-user-graduate"></i>
                    Student
                </a>
				<a href="myordersadmin.php" class="nav-link ">
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
	
    <div class="login-container" style="width:500px  ;">
        <h1>Add Notification</h1>

        <form method="POST">
            <div class="input-group">
                <label for="feedback">Notifacation</label>
                <textarea name="noti" placeholder="Enter Notifiaction Details" required></textarea>
            </div>
            
            <div class="input-group">
                <input type="submit" value="Submit" name="btn">
            </div>
        </form>
    </div>
 <br /><br /><br />
 <br /><br /><br />


   
   
   
   <script src="script.js"></script>
</body>
</html>