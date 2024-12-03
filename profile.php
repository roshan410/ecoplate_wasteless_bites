<?php
include("dbconnect.php");
session_start();

if (!isset($_SESSION['rollno'])) {
    // Redirect to login page if not logged in
    header("Location: index.php");
    exit();
}

$rollno = $_SESSION['rollno'];

// Fetch user data from the register table
$userQuery = mysqli_query($conn, "SELECT * FROM register WHERE rollno='$rollno'");
$userData = mysqli_fetch_assoc($userQuery);

if (!$userData) {
    echo "User not found.";
    exit();
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
                         <i class="fa-solid fa-utensils"></i> View
                </a>
                <a href="myorders.php" class="nav-link ">
                  <i class="fa-solid fa-file-alt"></i>Report
                </a>
                <a href="profile.php" class="nav-link active">
                    <i class="fas fa-user"></i> Profile
                </a>
                <a href="givef.php" class="nav-link">
                  <i class="fa-solid fa-comment-dots"></i> Feedback
                </a>
				
				<a href="vnoti.php" class="nav-link ">
                <i class="fa-solid fa-bell"></i>
                    Notification
                </a>
                <a href="index.php" class="nav-link">
          <i class="fa-solid fa-right-from-bracket"></i>Logout
                </a>
            </div>
        </div>
    </nav>

   <!DOCTYPE html>
<html>
<head>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
<br><br><br><br><br><br>
    <div class="profile-container" style="
        max-width: 500px;
        margin: 80px auto;
        padding: 30px;
        background-color: #ffffff;
        border-radius: 15px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        font-family: Arial, sans-serif;
        text-align: center;
        border: 1px solid #eaeaea;">
        
        <h2 style="
            color: #2c3e50;
            margin-bottom: 25px;
            font-size: 24px;
            font-weight: 600;">Profile Details</h2>
        
        <div class="profile-icon" style="
            font-size: 60px;
            color: #3498db;
            margin-bottom: 25px;">
            <i class="fas fa-user-circle"></i>
        </div>
        
        <div style="
            display: grid;
            gap: 12px;
            text-align: left;
            max-width: 400px;
            margin: 0 auto;">
            
            <p style="
                margin: 0;
                padding: 10px 15px;
                background-color: #f8f9fa;
                border-radius: 8px;
                border: 1px solid #eef0f2;">
                <strong style="
                    color: #34495e;
                    display: inline-block;
                    width: 100px;">Name:</strong> 
                <?php echo htmlspecialchars($userData['name']); ?>
            </p>
            
            <p style="
                margin: 0;
                padding: 10px 15px;
                background-color: #f8f9fa;
                border-radius: 8px;
                border: 1px solid #eef0f2;">
                <strong style="
                    color: #34495e;
                    display: inline-block;
                    width: 100px;">Date of Birth:</strong> 
                <?php echo htmlspecialchars($userData['dob']); ?>
            </p>
            
            <p style="
                margin: 0;
                padding: 10px 15px;
                background-color: #f8f9fa;
                border-radius: 8px;
                border: 1px solid #eef0f2;">
                <strong style="
                    color: #34495e;
                    display: inline-block;
                    width: 100px;">Email:</strong> 
                <?php echo htmlspecialchars($userData['email']); ?>
            </p>
            
            <p style="
                margin: 0;
                padding: 10px 15px;
                background-color: #f8f9fa;
                border-radius: 8px;
                border: 1px solid #eef0f2;">
                <strong style="
                    color: #34495e;
                    display: inline-block;
                    width: 100px;">Phone:</strong> 
                <?php echo htmlspecialchars($userData['phone']); ?>
            </p>
            
            <p style="
                margin: 0;
                padding: 10px 15px;
                background-color: #f8f9fa;
                border-radius: 8px;
                border: 1px solid #eef0f2;">
                <strong style="
                    color: #34495e;
                    display: inline-block;
                    width: 100px;">Dept:</strong> 
                <?php echo htmlspecialchars($userData['dep']); ?>
            </p>
            
            <p style="
                margin: 0;
                padding: 10px 15px;
                background-color: #f8f9fa;
                border-radius: 8px;
                border: 1px solid #eef0f2;">
                <strong style="
                    color: #34495e;
                    display: inline-block;
                    width: 100px;">Year:</strong> 
                <?php echo htmlspecialchars($userData['year']); ?>
            </p>
            
            <p style="
                margin: 0;
                padding: 10px 15px;
                background-color: #f8f9fa;
                border-radius: 8px;
                border: 1px solid #eef0f2;">
                <strong style="
                    color: #34495e;
                    display: inline-block;
                    width: 100px;">Roll No:</strong> 
                <?php echo htmlspecialchars($userData['rollno']); ?>
            </p>
            
            <p style="
                margin: 0;
                padding: 10px 15px;
                background-color: #f8f9fa;
                border-radius: 8px;
                border: 1px solid #eef0f2;">
                <strong style="
                    color: #34495e;
                    display: inline-block;
                    width: 100px;">Room No:</strong> 
                <?php echo htmlspecialchars($userData['roomno']); ?>
            </p>
            
            <p style="
                margin: 0;
                padding: 10px 15px;
                background-color: #f8f9fa;
                border-radius: 8px;
                border: 1px solid #eef0f2;">
                <strong style="
                    color: #34495e;
                    display: inline-block;
                    width: 100px;">Guardian:</strong> 
                <?php echo htmlspecialchars($userData['guard']); ?>
            </p>
        </div>
    </div>
</body>
</html>
    <script src="script.js"></script>
</body>
</html>
