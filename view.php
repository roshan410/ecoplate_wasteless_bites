<?php
include("dbconnect.php");
session_start();

$rollno = $_SESSION['rollno'];

// Define the days of the week
$daysOfWeek = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
$todayIndex = date("w");  // Returns 0 (for Sunday) through 6 (for Saturday)
$tomorrowIndex = ($todayIndex + 1) % 7; // Calculate index for tomorrow
$tomorrowDay = $daysOfWeek[$tomorrowIndex]; // Get tomorrow's day name

// Fetch menu data for tomorrow's day
$tomorrowMenuData = []; // Initialize an empty array to hold data
$qry = mysqli_query($conn, "SELECT * FROM weekly_menu WHERE day_of_week = '$tomorrowDay'");

while ($row = mysqli_fetch_array($qry)) {
    $tomorrowMenuData[] = $row; // Store each row of data in the array
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['need'])) {
    $date = date("Y-m-d");
	 $tomorrow = date("Y-m-d", strtotime("+1 day"));   // Current date
    $month = date("Y-m");     // Current month

    foreach ($_POST['need'] as $index => $value) {
        $day_of_week = $_POST['day_of_week'][$index];
        $meal_type = $_POST['meal_type'][$index];
        $food_item = $_POST['food_item'][$index];
        $price = $_POST['price'][$index];

        // Insert selected items into the database
        $sql = "INSERT INTO orders (rollno, day_order,meal_type, month, date, food_items, price,date1) VALUES ('$rollno', '$day_of_week','$meal_type', '$month', '$date', '$food_item', '$price','$tomorrow')";
        mysqli_query($conn, $sql);
    }

    echo "<p align='center'>Order saved successfully!</p>";
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
                <a href="view.php" class="nav-link active">
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
        <i class="fa-solid fa-right-from-bracket"></i> Logout
                </a>
            </div>
        </div>
    </nav>

    <br><br><br><br><br>

  <form method="POST" style="max-width: 1000px; margin: 80px auto; font-family: Arial, sans-serif; padding: 20px;">
    <h3 style="text-align: center; color: #2c3e50; font-size: 24px; margin-bottom: 30px;">Tomorrow's Menu (<?php echo $tomorrowDay; ?>)</h3>
    
    <table style="width: 100%; border-collapse: collapse; margin: 20px 0; background-color: #ffffff; box-shadow: 0 1px 3px rgba(0,0,0,0.2);">
        <tr>
            <td colspan="10" style="padding: 10px;">&nbsp;</td>
        </tr>
        <tr style="background-color: #3498db; color: white;">
            <td style="padding: 12px;">&nbsp;</td>
            <td style="padding: 12px; text-align: center; font-weight: bold;">Day</td>
            <td style="padding: 12px; text-align: center; font-weight: bold;">Meal Type</td>
            <td style="padding: 12px; text-align: center; font-weight: bold;">Food Items</td>
            <td style="padding: 12px; text-align: center; font-weight: bold;">Price</td>
            <td style="padding: 12px; text-align: center; font-weight: bold;">Need</td>
        </tr>
        <?php foreach ($tomorrowMenuData as $index => $menu) { ?>
        <tr style="border-bottom: 1px solid #ecf0f1; transition: background-color 0.3s ease;">
            <td style="padding: 12px; width: 1%;">&nbsp;</td>
            <td style="padding: 12px; text-align: center;"><?php echo $menu['day_of_week']; ?></td>
            <td style="padding: 12px; text-align: center;"><?php echo $menu['meal_type']; ?></td>
            <td style="padding: 12px; text-align: center;"><?php echo $menu['food_item']; ?></td>
            <td style="padding: 12px; text-align: center;"><?php echo $menu['price']; ?></td>
            <td style="padding: 12px; text-align: center;">
                <input type="checkbox" 
                       name="need[<?php echo $index; ?>]" 
                       value="1" 
                       style="width: 18px; height: 18px; cursor: pointer;"
                />
                <input type="hidden" name="day_of_week[<?php echo $index; ?>]" value="<?php echo $menu['day_of_week']; ?>" />
                <input type="hidden" name="meal_type[<?php echo $index; ?>]" value="<?php echo $menu['meal_type']; ?>" />
                <input type="hidden" name="food_item[<?php echo $index; ?>]" value="<?php echo $menu['food_item']; ?>" />
                <input type="hidden" name="price[<?php echo $index; ?>]" value="<?php echo $menu['price']; ?>" />
            </td>
        </tr>
        <?php } ?>
        <tr>
            <td colspan="7" style="padding: 20px; text-align: center;">&nbsp;</td>
        </tr>
    </table>
    <div style="text-align: center; margin-top: 20px;">
        <input type="submit" 
               name="btn" 
               value="Submit Selection" 
               style="background-color: #2ecc71; 
                      color: white; 
                      padding: 12px 24px; 
                      border: none; 
                      border-radius: 4px; 
                      cursor: pointer; 
                      font-size: 16px; 
                      transition: background-color 0.3s ease;"
               onmouseover="this.style.backgroundColor='#27ae60'" 
               onmouseout="this.style.backgroundColor='#2ecc71'"
        />
    </div>
</form>

    <br><br><br><br>
    <script src="script.js"></script>
</body>
</html>
