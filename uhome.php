<?php
include("dbconnect.php");
session_start();

// Set the timezone to Kolkata, India
date_default_timezone_set('Asia/Kolkata');

// Fetch order details for tomorrow if the user is logged in
if (isset($_SESSION['rollno'])) {
    $rollno = $_SESSION['rollno'];
    // Calculate tomorrow's date
    $tomorrow_date = date('Y-m-d', strtotime('+1 day'));
    $orderQry = mysqli_query($conn, "SELECT * FROM orders WHERE rollno='$rollno' AND date1='$tomorrow_date'");
}

// Check if delete is requested
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    // Perform delete operation
    mysqli_query($conn, "DELETE FROM orders WHERE order_id='$delete_id'");
    header("Location: uhome.php"); // Redirect after deletion
    exit();
}

// Get the current time
$current_time = new DateTime();
$cutoff_time = new DateTime('19:00:00'); // 7 PM IST
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
                <a href="uhome.php" class="nav-link active">
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

    <br /><br /><br /><br />
 <div style="padding: 20px; font-family: Arial, sans-serif; margin-top: 120px">
    <h3 style="text-align: center; color: #2c3e50; font-size: 24px; margin-bottom: 20px;">
        Order Details for Tomorrow for Roll No: <?php echo isset($_SESSION['rollno']) ? $_SESSION['rollno'] : ''; ?>
    </h3>
    
    <h4 style="color: #e74c3c; text-align: center; font-size: 18px; margin-bottom: 25px; padding: 10px; background-color: #fde8e7; border-radius: 5px;">
        <?php if ($current_time < $cutoff_time): ?>
            You have to delete orders before 7 PM. Current time: <?php echo $current_time->format('H:i:s'); ?>
        <?php else: ?>
            Time's up! You can't delete orders. Current time: <?php echo $current_time->format('H:i:s'); ?>
        <?php endif; ?>
    </h4>

    <div style="overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse; background-color: white; box-shadow: 0 1px 3px rgba(0,0,0,0.2); border-radius: 5px;">
            <tr style="background-color: #34495e; color: white;">
             
                <th style="padding: 12px 15px; text-align: left; border-bottom: 2px solid #ddd;">Roll No</th>
                <th style="padding: 12px 15px; text-align: left; border-bottom: 2px solid #ddd;">Day Order</th>
                <th style="padding: 12px 15px; text-align: left; border-bottom: 2px solid #ddd;">Month</th>
                <th style="padding: 12px 15px; text-align: left; border-bottom: 2px solid #ddd;">Date</th>
                <th style="padding: 12px 15px; text-align: left; border-bottom: 2px solid #ddd;">Food Items</th>
                <th style="padding: 12px 15px; text-align: left; border-bottom: 2px solid #ddd;">Price</th>
                <th style="padding: 12px 15px; text-align: left; border-bottom: 2px solid #ddd;">Order Time</th>
                <th style="padding: 12px 15px; text-align: left; border-bottom: 2px solid #ddd;">Action</th>
            </tr>

            <?php if (isset($orderQry) && mysqli_num_rows($orderQry) > 0) {
                while ($row = mysqli_fetch_array($orderQry)) { ?>
                    <tr style="border-bottom: 1px solid #ddd; transition: background-color 0.3s ease;">
                   
                        <td style="padding: 12px 15px;"><?php echo $row['rollno']; ?></td>
                        <td style="padding: 12px 15px;"><?php echo $row['day_order']; ?></td>
                        <td style="padding: 12px 15px;"><?php echo $row['month']; ?></td>
                        <td style="padding: 12px 15px;"><?php echo $row['date']; ?></td>
                        <td style="padding: 12px 15px;"><?php echo $row['food_items']; ?></td>
                        <td style="padding: 12px 15px;"><?php echo $row['price']; ?></td>
                        <td style="padding: 12px 15px;"><?php echo $row['order_time']; ?></td>
                        <td style="padding: 12px 15px;">
                            <?php if ($current_time < $cutoff_time): ?>
                                <a href="uhome.php?delete_id=<?php echo $row['order_id']; ?>" 
                                   onclick="return confirm('Are you sure you want to delete this order?');"
                                   style="text-decoration: none;">
                                    <button style="background-color: #e74c3c; color: white; border: none; padding: 8px 15px; border-radius: 4px; cursor: pointer; transition: background-color 0.3s ease;">Delete</button>
                                </a>
                            <?php else: ?>
                                <span style="color: #7f8c8d;">N/A</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php } 
            } else { ?>
                <tr>
                    <td colspan="9" style="padding: 20px; text-align: center; color: #7f8c8d;">No orders found for tomorrow.</td>
                </tr>
            <?php } ?>
        </table>
    </div>
</div>

    <script src="script.js"></script>
</body>
</html>
