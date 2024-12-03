<?php
 	include("dbconnect.php");
	session_start();

//if (!isset($_SESSION['uname'])) {
  //  header("Location: login.php");
    //exit();
//}

$totalPrice = 0;
$selectedMonth = '';
$selectedDate = '';
$selectedRollNo = '';
$query = "";

// Fetch orders based on admin input
if (!empty($_POST['rollno'])) {
    $selectedRollNo = $_POST['rollno'];

    if (!empty($_POST['month'])) {
        $selectedMonth = $_POST['month'];
        $query = "SELECT * FROM orders WHERE rollno='$selectedRollNo' AND DATE_FORMAT(date1, '%Y-%m') = '$selectedMonth'";
    } elseif (!empty($_POST['date'])) {
        $selectedDate = $_POST['date'];
        $query = "SELECT * FROM orders WHERE rollno='$selectedRollNo' AND DATE(date1) = '$selectedDate'";
    }
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
				<a href="vstudent.php" class="nav-link">
                 <i class="fa-solid fa-user-graduate"></i>
                    Student
                </a>
				
				<a href="myordersadmin.php" class="nav-link active">
                    <i class="fa-solid fa-file-alt"></i>Bills
                </a>
				<a href="index.php" class="nav-link">
                      <i class="fa-solid fa-right-from-bracket"></i>
                    Logout
                </a>
				
            </div>
        </div>
    </nav>

    <div style="padding: 170px; font-family: Arial, sans-serif;">
        <h3 style="text-align: center; color: #2c3e50; font-size: 24px; margin-bottom: 20px;">
           View Bills
        </h3>
        
        <form method="POST" action="" style="font-family: Arial, sans-serif; max-width: 400px; margin: 20px auto; padding: 20px; background-color: #f8f9fa; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
            <div style="margin-bottom: 20px;">
                <label for="rollno" style="display: block; margin-bottom: 8px; font-weight: 600; color: #333;">Enter Roll Number:</label>
                <input type="text" id="rollno" name="rollno" value="<?php echo $selectedRollNo; ?>" 
                    style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; font-size: 14px; margin-bottom: 10px;">
            </div>

            <div style="margin-bottom: 20px;">
                <label for="month" style="display: block; margin-bottom: 8px; font-weight: 600; color: #333;">Select Month:</label>
                <input type="month" id="month" name="month" value="<?php echo $selectedMonth; ?>" 
                    style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; font-size: 14px; margin-bottom: 10px;">
            </div>

            <div style="margin-bottom: 20px;">
                <label for="date" style="display: block; margin-bottom: 8px; font-weight: 600; color: #333;">Select Date:</label>
                <input type="date" id="date" name="date" value="<?php echo $selectedDate; ?>" 
                    style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; font-size: 14px; margin-bottom: 10px;">
            </div>

            <button type="submit" style="background-color: #007bff; color: white; border: none; padding: 10px 20px; border-radius: 4px; cursor: pointer; font-size: 14px; transition: background-color 0.2s;">Filter</button>
        </form>

        <?php if ($selectedRollNo && ($selectedMonth || $selectedDate)) { ?>
            <div style="overflow-x: auto; margin-top: 20px;">
                <table style="width: 100%; border-collapse: collapse; background-color: white; box-shadow: 0 1px 3px rgba(0,0,0,0.2); border-radius: 5px;">
                    <tr style="background-color: #34495e; color: white;">
                        <th>Roll No</th>
                        <th>Day Order</th>
                        <th>Month</th>
                        <th>Date</th>
                        <th>Food Items</th>
                        <th>Price</th>
                        <th>Order Time</th>
                    </tr>

                    <?php 
                    $totalPrice = 0;
                    if ($result && mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $totalPrice += $row['price'];
                    ?>
                        <tr>
                            <td><?php echo $row['rollno']; ?></td>
                            <td><?php echo $row['day_order']; ?></td>
                            <td><?php echo date('Y-m', strtotime($row['date1'])); ?></td>
                            <td><?php echo $row['date1']; ?></td>
                            <td><?php echo $row['food_items']; ?></td>
                            <td><?php echo number_format($row['price'], 2); ?></td>
                            <td><?php echo $row['order_time']; ?></td>
                        </tr>
                    <?php 
                        }
                    } else { 
                    ?>
                        <tr>
                            <td colspan="7" style="text-align: center;">No orders found.</td>
                        </tr>
                    <?php } ?>
                </table>
            </div>

            <div style="text-align: right; margin-top: 15px;">
                <strong>Total Price: Rs.<?php echo number_format($totalPrice, 2); ?></strong>
            </div>
        <?php } ?>
    </div>
    
</body>
</html>
