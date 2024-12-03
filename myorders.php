<?php
include("dbconnect.php");
session_start();

// Set timezone
date_default_timezone_set('Asia/Kolkata');

// Ensure user is logged in
if (!isset($_SESSION['rollno'])) {
    header("Location: login.php");
    exit();
}

$rollno = $_SESSION['rollno'];
$totalPrice = 0;
$selectedMonth='';
 $selectedDate='';

// Initialize an empty query
$query = "";

// Fetch orders based on month or date selection
if (!empty($_POST['month'])) {
    $selectedMonth = $_POST['month'];
    $query = "SELECT * FROM orders WHERE rollno='$rollno' AND DATE_FORMAT(date1, '%Y-%m') = '$selectedMonth'";
} elseif (!empty($_POST['date'])) {
    $selectedDate = $_POST['date'];
    $query = "SELECT * FROM orders WHERE rollno='$rollno' AND DATE(date1) = '$selectedDate'";
}

// Execute query only if $query is not empty
if ($query != "") {
    $result = mysqli_query($conn, $query);
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
                <a href="myorders.php" class="nav-link active">
                    <i class="fa-solid fa-file-alt"></i>Report
                </a>
                <a href="profile.php" class="nav-link">  <i class="fas fa-user"></i>  
                Profile
                </a>
                <a href="givef.php" class="nav-link">
                  <i class="fa-solid fa-comment-dots"></i>Feedback
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
	
	<br><br><br>  <br><br>

    <div style="padding-top: 150px; font-family: Arial, sans-serif;">
        <h3 style="text-align: center; color: #2c3e50; font-size: 24px; margin-bottom: 20px;">
           Report for Roll No: <?php echo $rollno; ?>
        </h3>
        
        <!-- Date Filters -->
       <form method="POST" action="" style="font-family: Arial, sans-serif; max-width: 400px; margin: 20px auto; padding: 20px; background-color: #f8f9fa; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
    <div style="margin-bottom: 20px;">
        <label for="month" style="display: block; margin-bottom: 8px; font-weight: 600; color: #333;">Select Month:</label>
        <input type="month" id="month" name="month" value="<?php echo isset($selectedMonth) ? $selectedMonth : ''; ?>" 
            style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; font-size: 14px; margin-bottom: 10px;">
        <button type="submit" 
            style="background-color: #007bff; color: white; border: none; padding: 10px 20px; border-radius: 4px; cursor: pointer; font-size: 14px; transition: background-color 0.2s;">Filter by Month</button>
    </div>

    <div style="margin-bottom: 20px;">
        <label for="date" style="display: block; margin-bottom: 8px; font-weight: 600; color: #333;">Select Date:</label>
        <input type="date" id="date" name="date" value="<?php echo isset($selectedDate) ? $selectedDate : ''; ?>" 
            style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; font-size: 14px; margin-bottom: 10px;">
        <button type="submit" 
            style="background-color: #007bff; color: white; border: none; padding: 10px 20px; border-radius: 4px; cursor: pointer; font-size: 14px; transition: background-color 0.2s;">Filter by Date</button>
    </div>
</form>


  <?php    if($selectedMonth  || $selectedDate){       ?>


        <!-- Order Table -->
        <div style="overflow-x: auto; margin-top: 20px;">
            <table style="width: 100%; border-collapse: collapse; background-color: white; box-shadow: 0 1px 3px rgba(0,0,0,0.2); border-radius: 5px;">
                <tr style="background-color: #34495e; color: white;">
                    <th style="padding: 12px 15px; text-align: left; border-bottom: 2px solid #ddd;">Roll No</th>
                    <th style="padding: 12px 15px; text-align: left; border-bottom: 2px solid #ddd;">Day Order</th>
                    <th style="padding: 12px 15px; text-align: left; border-bottom: 2px solid #ddd;">Month</th>
                    <th style="padding: 12px 15px; text-align: left; border-bottom: 2px solid #ddd;">Date</th>
                    <th style="padding: 12px 15px; text-align: left; border-bottom: 2px solid #ddd;">Food Items</th>
                    <th style="padding: 12px 15px; text-align: left; border-bottom: 2px solid #ddd;">Price</th>
                    <th style="padding: 12px 15px; text-align: left; border-bottom: 2px solid #ddd;">Order Time</th>
                  
                </tr>

                <?php 
                $totalPrice = 0;
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $totalPrice += $row['price']; 
                ?>
                    <tr style="border-bottom: 1px solid #ddd; transition: background-color 0.3s ease;">
                        <td style="padding: 12px 15px;"><?php echo $row['rollno']; ?></td>
                        <td style="padding: 12px 15px;"><?php echo $row['day_order']; ?></td>
                        <td style="padding: 12px 15px;"><?php echo date('Y-m', strtotime($row['date1'])); ?></td>
                        <td style="padding: 12px 15px;"><?php echo $row['date1']; ?></td>
                        <td style="padding: 12px 15px;"><?php echo $row['food_items']; ?></td>
                        <td style="padding: 12px 15px;"><?php echo number_format($row['price'], 2); ?></td>
                        <td style="padding: 12px 15px;"><?php echo $row['order_time']; ?></td>
                       
                    </tr>
                <?php 
                    }
                } else { 
                ?>
                    <tr>
                        <td colspan="8" style="padding: 20px; text-align: center; color: #7f8c8d;">No orders found.</td>
                    </tr>
                <?php } ?>
            </table>
        </div>

        <!-- Display Total Price -->
        <div style="text-align: right; margin-top: 15px; font-size: 18px; color: #34495e;">
            <strong>Total Price: Rs.<?php echo number_format($totalPrice, 2); ?></strong>
        </div>
		
		
		    <?php } ?>
		
		
    </div>
</body>
</html>
