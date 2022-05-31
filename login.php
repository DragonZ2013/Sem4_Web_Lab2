<html>
<head>
    <title>Login</title>
</head>
<link rel="stylesheet" href="style.css">
<?php
session_start();

$mysqli = new mysqli("localhost", "root", "", "uni_db");
if (isset($_POST['username'])) {

    // verificam daca s-au completat formurile, cu un default value daca nu au fost completate.
    // posibil aici sa facem si o validare in care verificam daca putem folosii datele de la user.
    $username = $_POST['username'] ?? "";

    $password = $_POST['password'] ?? "";
    $pass_hash = md5($password);

    $stmt = $mysqli->prepare("SELECT * FROM users WHERE username=?");
    $stmt->bind_param("s", $_POST['username']);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    foreach ($result as $row) {
        ?>
        <tr>
            <td><?php echo $row['ID'] ?></td>
            <td><?php echo $row['username'] ?></td>
            <td><?= $row['password_hash'] ?></td>
        </tr>
        <?php
    }
    $check = 0;
    if ($result->num_rows > 0) {
        
        echo "User: " . $_POST["username"] . ".<br>";
        foreach ($result as $row) {
            if(strcmp($row['password_hash'],$pass_hash)==0){
                $_SESSION["user"]=$row['username'];
                $_SESSION["user_id"]=$row['ID'];
                $_SESSION["admin"]=$row['admin'];
                $check=1;
                echo "User: " . $_POST["username"] . ".<br>";
                header("location:index.php");
            }
        }
    }
    echo "User: " . $_SESSION["user"] . ".<br>";
    if($check==0)
        header("location:login.php");
}
?>
<body>
<a href="index.php">Back</a>
<h1 class = "title_text">Login User</h1>

<div class="form center">
    <form method="post" action="login.php">

        <div>
            <label>
                <p>Username:</p>
                <input type="text" name="username" value=""/>
            </label>
        </div>
        <div>
            <label>
                <p>Password:</p>
                <input type="password" name="password" value=""/>
            </label>
        </div>
        <br>
        <button type="submit">Login</button>
    </form>
</div>
</body> 
