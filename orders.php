<?php
include("dbconnect.php");
session_start();

// Get tomorrow's date in 'Y-m-d' format
$dateTomorrow = date('Y-m-d', strtotime('+1 day'));

// Fetch distinct meal types for tomorrow's date
$mealTypesQuery = "SELECT DISTINCT meal_type FROM orders WHERE date1 = '$dateTomorrow'";
$mealTypesResult = mysqli_query($conn, $mealTypesQuery);

$totalCount = 0; // Initialize total count

// Prepare an associative array to hold meal type data
$mealData = [];

while ($mealTypeRow = mysqli_fetch_assoc($mealTypesResult)) {
    $mealType = $mealTypeRow['meal_type'];

    // Fetch data for each meal type
    $query = "
        SELECT * 
        FROM orders 
        WHERE date1 = '$dateTomorrow' AND meal_type = '$mealType'
    ";
    $result = mysqli_query($conn, $query);

    // Initialize count for the current meal type
    $mealCount = 0;

    // Store data in the mealData array
    $mealData[$mealType] = mysqli_fetch_all($result, MYSQLI_ASSOC);

    // Count the number of orders for this meal type
    $mealCount = count($mealData[$mealType]);
    
    // Update total count
    $totalCount += $mealCount;
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
            <a style="margin-right:50px" href="#" class="logo">ECOPLATE: WASTELESS BITES</a>
            <button class="menu-btn">
                <i class="fas fa-bars"></i>
            </button>
            <div class="nav-links">
                <button class="close-btn">
                    <i class="fas fa-times"></i>
                </button>
                <a href="adminhome.php" class="nav-link ">
                    <i class="fa-solid fa-user-plus"></i> Add  
                </a>
                <a href="orders.php" class="nav-link active">
                  <i class="fa-solid fa-cart-shopping"></i>Orders
                </a>
                <a href="noti.php" class="nav-link">
                     <i class="fa-solid fa-bell"></i>Notification
                </a>
                <a href="vfeed.php" class="nav-link">
                 <i class="fa-solid fa-comment-dots"></i> Feedbacks
                </a>
                <a href="vstudent.php" class="nav-link">
				
                  <i class="fa-solid fa-user-graduate"></i> Student
                </a>
                <a href="myordersadmin.php" class="nav-link">
                    <i class="fa-solid fa-file-alt"></i>Bills
                </a>
                <a href="index.php" class="nav-link">
                     <i class="fa-solid fa-right-from-bracket"></i> Logout
                </a>
            </div>
        </div>
    </nav>

    <br /><br /><br /><br />

   <div class="container" style="max-width: 1200px; margin: 100px auto; padding: 20px; font-family: Arial, sans-serif; box-shadow: 0 0 10px rgba(0,0,0,0.1); border-radius: 8px;">
    <h2 style="color: #2c3e50; margin-bottom: 20px; font-size: 24px; border-bottom: 2px solid #3498db; padding-bottom: 10px;">Orders for Tomorrow (<?php echo date('Y-m-d', strtotime('+1 day')); ?>)</h2>
    <?php if (empty($mealData)): ?>
        <p style="color: #7f8c8d; font-size: 16px; text-align: center; padding: 20px;">No orders for tomorrow.</p>
    <?php else: ?>
        <?php foreach ($mealData as $mealType => $orders): ?>
            <h3 style="color: #34495e; margin: 20px 0 15px; font-size: 20px;"><?php echo htmlspecialchars($mealType); ?> Orders</h3>
            <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px; background-color: #ffffff;">
                <thead>
                    <tr style="background-color: #3498db; color: white;">
                        
                        <th style="padding: 12px; text-align: left; border: 1px solid #bdc3c7;">Roll No</th>
                        <th style="padding: 12px; text-align: left; border: 1px solid #bdc3c7;">Meal Type</th>
                        <th style="padding: 12px; text-align: left; border: 1px solid #bdc3c7;">Date</th>
                        <th style="padding: 12px; text-align: left; border: 1px solid #bdc3c7;">Food Items</th>
                        <th style="padding: 12px; text-align: left; border: 1px solid #bdc3c7;">Price</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $order): ?>
                        <tr style="transition: background-color 0.3s ease;">
                            
                            <td style="padding: 12px; border: 1px solid #bdc3c7;"><?php echo htmlspecialchars($order['rollno']); ?></td>
                            <td style="padding: 12px; border: 1px solid #bdc3c7;"><?php echo htmlspecialchars($order['meal_type']); ?></td>
                            <td style="padding: 12px; border: 1px solid #bdc3c7;"><?php echo htmlspecialchars($order['date']); ?></td>
                            <td style="padding: 12px; border: 1px solid #bdc3c7;"><?php echo htmlspecialchars($order['food_items']); ?></td>
                            <td style="padding: 12px; border: 1px solid #bdc3c7;"><?php echo htmlspecialchars($order['price']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <p style="color: #2c3e50; font-size: 16px; margin: 10px 0;">Total Count for <?php echo htmlspecialchars($mealType); ?>: <span style="font-weight: bold; color: #3498db;"><?php echo count($orders); ?></span></p>
            <br>
        <?php endforeach; ?>
    <?php endif; ?>
    <h3 style="color: #2c3e50; font-size: 20px; margin-top: 20px; padding: 15px; background-color: #f8f9fa; border-radius: 5px; text-align: center;">Overall Total Count for Tomorrow: <span style="color: #3498db; font-weight: bold;"><?php echo $totalCount; ?></span></h3>
</div>

    <br /><br /><br /><br />
    <script src="script.js"></script>
</body>
</html>
