<title>
Reserve
</title>
<a href="hotels.php">Back</a>

<link rel="stylesheet" href="style.css">
<br>
<?php
session_start();    

function reserve_room()
    {
        
$mysqli = new mysqli("localhost", "root", "", "uni_db");
    
    $stmt = $mysqli->prepare("SELECT hotel_rooms.nr_people-COUNT(*) AS spots FROM reservations INNER JOIN hotel_rooms ON hotel_rooms.id=reservations.id_hotel_room WHERE not(date_start<='" .  $_POST['dateTo'] .  "' AND date_end<='" .  $_POST['dateFrom'] . "') AND id_hotel_room=? GROUP BY id_hotel_room;");
    
        $stmt->bind_param("s",$_POST['roomId']);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        $spots = 0;
        if($result->num_rows == 0)
            $spots = 1;
        else
        {
            foreach ($result as $row)
                $spots=$row['spots'];
        }
        if($_POST['dateTo']>=$_POST['dateFrom'])
        {
            if($spots>0)
            {
                //echo $spots;
                
                $createStmt = $mysqli->prepare("INSERT INTO reservations (id_hotel_room,id_user,date_start,date_end) VALUES (?, ?,?,?)");
                $createStmt->bind_param("ssss", $_POST['roomId'],$_POST['userId'],$_POST['dateFrom'],$_POST['dateTo']);
                $createStmt->execute();
                $createStmt->close();
                header("Location:success.php");
                
            }
            else
                header("Location:error.php");
        }
        else
            header("Location:error.php");
        
    /*echo $_POST['roomId'];
    echo "<br>";
    echo $_POST['userId'];
    echo "<br>";
    echo $_POST['dateFrom'];
    echo "<br>";
    echo $_POST['dateTo'];
    echo "<br>";*/
    }
    if($_SERVER['REQUEST_METHOD'] == "POST" )
    {
        reserve_room();
    }
    //echo " ";
//echo $_SESSION["user_id"];
    ?> 
<h2 class="title_text"> <?php echo "Room: " . $_SESSION["room_id"]; ?></h2>

<form class="center" action="reserve.php" method="post">   
                    <?php
                    echo "<input type='hidden' id='roomId' name='roomId' value=".$_SESSION["room_id"].">";
                    ?>
                                        <?php
                    echo "<input type='hidden' id='userId' name='userId' value=".$_SESSION["user_id"].">";
                    ?>
<p>From:</p>
<input type="date" name="dateFrom" value="<?php echo date('Y-m-d'); ?>" />
<p>
    To:</p>
    <input type="date" name="dateTo" value="<?php echo date('Y-m-d'); ?>" />
    <br><br>
                <input type="submit" name="submit" value="Confirm Reservation"/>
                </form>
