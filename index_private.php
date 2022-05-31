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

?>

<p class="title_text"> <?php echo "User: " . $_SESSION["user"]; ?></p>
<p class="title_text"> <?php echo "User ID: " . $_SESSION["user_id"]; ?></p>
<br>
<div class="center menu_link">

    <p>
        <a href="hotels.php" >Hotels</a>
    </p>

    <p>
        <a href="current_reservations.php" >Current Reservations</a>
    </p>
    
    <p>
        <a href="logout.php">Logout</a>
    </p>


</div>

</body>
</html>