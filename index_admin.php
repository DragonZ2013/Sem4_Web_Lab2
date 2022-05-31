<!DOCTYPE html>
<html>
<head>
    <title>Lab PHP</title>
</head>
<body>
<?php
//session_start();
    //echo "User: " . $_SESSION["user"] . "<br>";
    //echo "ID: " . $_SESSION["user_id"] . "<br>";
    //echo "ID: " . $_SESSION["admin"] . "<br>";
?>

<p class="title_text"> <?php echo "User: " . $_SESSION["user"]; ?></p>
<p class="title_text"> <?php echo "User ID: " . $_SESSION["user_id"]; ?></p>
<p class="title_text"> <?php echo "Admin?: " . $_SESSION["admin"]; ?></p>
<div class="center menu_link">

    <p>
        <a href="hotels_admin.php">Add Room Type</a>
    </p>

    <p>
        <a href="add_hotel.php">Add Hotel</a>
    </p>
    
    <p>
        <a href="logout.php">Logout</a>
    </p>


</div>

</body>
</html>