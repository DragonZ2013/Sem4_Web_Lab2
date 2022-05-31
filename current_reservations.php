<title>Current Reservations</title>
<link rel="stylesheet" href="style.css">
<a href="index.php">Back</a>
<br>
<?php

session_start();
$mysqli = new mysqli("localhost", "root", "", "uni_db");

$stmt = $mysqli->prepare("SELECT id_hotel_room,date_start,date_end FROM reservations WHERE id_user = ?");
$stmt->bind_param("s", $_SESSION["user_id"]);
$stmt->execute();
$result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt->close();
?>


<h2 class="title_text">Current Reservations</h2>
<table class = "center" width="300">
    <thead>
    <th>Room Id </th>
    <th>Date Start </th>
    <th>Date End </th>
    </thead>
    <tbody>
    <?php
    foreach ($result as $row) {
        ?>
        <tr>
            <td><?php echo $row['id_hotel_room'] ?></td>
            <td><?php echo $row['date_start'] ?></td>
            <td><?= $row['date_end'] ?></td>
        </tr>
        <?php
    }
    ?>
    </tbody>
</table>