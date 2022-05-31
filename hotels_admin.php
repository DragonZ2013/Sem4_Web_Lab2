<title>Hotels
</title>
<link rel="stylesheet" href="style.css">
<?php
// ia toate randurile din db
session_start();
$mysqli = new mysqli("localhost", "root", "", "uni_db");

$stmt = $mysqli->prepare("SELECT * FROM hotels");
$stmt->execute();
$result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt->close();
?>

<?php

    function get_hotel_id($input)
    {
        echo $input;
        
        $_SESSION["hotel_id"]=$input;
        header("Location:add_room.php");
    }
    if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['new_room']))
    {
        $hotel_id = $_POST['hotelId'];
        get_hotel_id($hotel_id);
    }

?>
<a href="index.php">Back</a>
<h1 class = "title_text">Rooms</h1>
<table style="border-spacing: 15px;" class="center">
    <tbody>
    <?php
    foreach ($result as $row) {
        //echo $row['room_id']
        ?>
        <tr>
            <td><h2><?php echo $row['name'] ?></h2></td>
        </tr>
        <tr>
            <td width="300px">
                <p>Address: <?= $row['address'] ?></p>
            </td>
            <td>
                <p>
                <form action="hotels_admin.php" method="post">
                    <input type="submit" name="new_room" value="Add Room" />
                    <?php
                    echo "<input type='hidden' id='hotelId' name='hotelId' value=".$row['id'].">";
                    ?>
                </form>
                </p>
            </td>
            
        </tr>

        <?php
    }
    ?>
    </tbody>
</table>