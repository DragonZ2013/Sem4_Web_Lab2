
<link rel="stylesheet" href="style.css">
<a href="index.php">Back</a>
<br>
<?php
session_start();    

function add_room()
    {
        
$mysqli = new mysqli("localhost", "root", "", "uni_db");
    

            if($_SERVER['REQUEST_METHOD'] == "POST" && strlen($_POST['hotelName'])>0 && strlen($_POST['hotelAddress'])>0)
            {
                
                $createStmt = $mysqli->prepare("INSERT INTO hotels(name,address) VALUES (?, ?)");
                $name = "hotelName";
                if(strlen($_POST['hotelName'])>0)
                    $name = $_POST['hotelName'];
                $address = "default Address";
                if(strlen($_POST['hotelAddress'])>0)
                    $address = $_POST['hotelAddress'];
                $createStmt->bind_param("ss", $name,$address);
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
//echo " ";
//echo $_SESSION["user_id"];?> 
<form class="center" action="add_hotel.php" method="post">   
<p>Hotel Name:</p>

<input type="text" name="hotelName" value="" />

    <p>Hotel Address:</p>
    
    <input type="text" name="hotelAddress" value="" />

    <br><br>
    
                <input type="submit" name="submit" value="Add Hotel"/>
                </form>
