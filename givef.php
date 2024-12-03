<?php
include("dbconnect.php");
session_start();

// Check if the user is logged in
if (isset($_SESSION['rollno'])) {
    $rollno = $_SESSION['rollno'];

    // Fetch order details if needed
    $orderQry = mysqli_query($conn, "SELECT * FROM orders WHERE rollno='$rollno'");
}

// Process feedback form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['btn'])) {
    $feedback = mysqli_real_escape_string($conn, $_POST['feed']); // Escape user input
    $date = date("Y-m-d"); // Get the current date

    // Insert feedback into the feedback table
    $sql = "INSERT INTO feedback (date, rollno, feedback) VALUES ('$date', '$rollno', '$feedback')";
    
    if (mysqli_query($conn, $sql)) {
        echo "<script>Feedback submitted successfully!</script>";
		
		
		
		
		
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
        <div class="nav-content">
            <a href="#" class="logo" style="margin-right:50px">ECOPLATE: WASTELESS BITES</a>
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
                <a href="view.php" class="nav-link ">
                          <i class="fa-solid fa-utensils"></i>View
                </a>
                <a href="myorders.php" class="nav-link ">
           <i class="fa-solid fa-file-alt"></i>Report
                </a>
                <a href="profile.php" class="nav-link ">
                    <i class="fas fa-user"></i> Profile
                </a>
                <a href="givef.php" class="nav-link active">
                    <i class="fa-solid fa-comment-dots"></i> Feedback
                </a>
				
				<a href="vnoti.php" class="nav-link ">
                <i class="fa-solid fa-bell"></i>
                    Notification
                </a>
                <a href="index.php" class="nav-link">
                  <i class="fa-solid fa-right-from-bracket"></i> Logout
                </a>
            </div>
        </div>
    </nav>

    <br /><br /><br /><br />    <br /><br /><br /><br />
    <div class="login-container" style="margin-top: 80px">
        <h1>Give Feedback</h1>
        <form method="POST">
            <div class="input-group">
                <label for="feedback">Feedback</label>
                <textarea name="feed" placeholder="Enter your feedback" required></textarea>
            </div>
            
            <div class="input-group">
                <input type="submit" value="Submit Feedback" name="btn">
            </div>
        </form>
    </div>
    <br /><br /><br /><br /> <br /><br /><br /><br />
    <script src="script.js"></script>
</body>
</html>
