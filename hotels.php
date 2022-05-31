<html>
<head>
    <title>Hotels</title>
</head>

<link rel="stylesheet" href="style.css">
<?php
// ia toate randurile din db
session_start();
$mysqli = new mysqli("localhost", "root", "", "uni_db");

$stmt = $mysqli->prepare("SELECT hotel_rooms.id AS room_id,hotel_id,image,misc,name AS hotel_name,address,nr_people,nightly_cost FROM hotel_rooms INNER JOIN hotels ON hotel_rooms.hotel_id=hotels.id ORDER BY hotel_name");
$stmt->execute();
$result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt->close();
?>

<?php

    function get_room_id($input)
    {
        echo $input;
        
        $_SESSION["room_id"]=$input;
        header("Location:reserve.php");
    }
    if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['reserve']))
    {
        $room_id = $_POST['roomId'];
        get_room_id($room_id);
    }

?>
<body>
<a href="index.php">Back</a>
<h1 class = "title_text">Rooms</h1>
<table style="border-spacing: 15px;" class="center">
    <tbody>
    <?php
    foreach ($result as $row) {
        //echo $row['room_id']
        ?>
        <tr>
            <td><h2><?php echo $row['hotel_name'] ?></h2></td>
        </tr>
        <tr>
            <td><img src="img/<?= $row['image'] ?>" alt="Room Image" width="250" height="250"></td>
            <td width="300px">
                <p>Number of rooms: <?= $row['nr_people'] ?></p>
                <p>Nightly Cost: <?= $row['nightly_cost'] ?></p>
                <p>Address: <?= $row['address'] ?></p>
                <p>Description: <?= $row['misc'] ?></p>
            </td>
            <td>
                <p>
                <form action="hotels.php" method="post">
                    <input type="submit" name="reserve" value="Reserve" />
                    <?php
                    echo "<input type='hidden' id='roomId' name='roomId' value=".$row['room_id'].">";
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
</body>
</html>