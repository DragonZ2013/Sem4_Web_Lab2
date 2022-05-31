
<link rel="stylesheet" href="style.css">
<a href="hotels_admin.php">Back</a>
<br>
<?php
session_start();    

function add_room()
    {
        
$mysqli = new mysqli("localhost", "root", "", "uni_db");
    

            if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['hotelId'])&&strlen($_POST['nightlyCost'])>0 && is_numeric($_POST['nightlyCost'])&&strlen($_POST['numberOfPeople'])>0 && is_numeric($_POST['numberOfPeople']))
            {
                
                $createStmt = $mysqli->prepare("INSERT INTO hotel_rooms(hotel_id,nightly_cost,nr_people,misc) VALUES (?, ?,?,?)");
                $nightlyCost = 200;
                if(strlen($_POST['nightlyCost'])>0 && is_numeric($_POST['nightlyCost']))
                    $nightlyCost = $_POST['nightlyCost'];
                $noPeople = 1;
                if(strlen($_POST['numberOfPeople'])>0 && is_numeric($_POST['numberOfPeople']))
                    $noPeople = $_POST['numberOfPeople'];
                $createStmt->bind_param("ssss", $_POST['hotelId'],$nightlyCost,$noPeople,$_POST['description']);
                $createStmt->execute();
                $createStmt->close();
                header("Location:success.php");
                
            }
            else
                header("Location:error.php");
        }

        
    /*echo $_POST['roomId'];
    echo "<br>";
    echo $_POST['userId'];
    echo "<br>";
    echo $_POST['dateFrom'];
    echo "<br>";
    echo $_POST['dateTo'];
    echo "<br>";*/
    
    if($_SERVER['REQUEST_METHOD'] == "POST" )
    {
        add_room();
    }
//echo "Hotel: " . $_SESSION["hotel_id"];
//echo " ";
//echo $_SESSION["user_id"];?> 

<h2 class="title_text"> <?php echo "Hotel: " . $_SESSION["hotel_id"]; ?></h2>
<form class = "center" action="add_room.php" method="post">   
                    <?php
                    echo "<input type='hidden' id='hotelId' name='hotelId' value=".$_SESSION["hotel_id"].">";
                    ?>
<p>Nightly Cost:</p>

<input type="text" name="nightlyCost" value="" />

    <p>Number of rooms:</p>
    
    <input type="text" name="numberOfPeople" value="" />
    
        <p>Description:</p>
    
    <input type="text"  name="description" value="" />
    <br><br>
    
                <input type="submit" name="submit" value="Add Room"/>
                </form>
