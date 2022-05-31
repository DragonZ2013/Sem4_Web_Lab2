<html>
<head>
    <title>Register</title>
</head>

<link rel="stylesheet" href="style.css">
<?php

$mysqli = new mysqli("localhost", "root", "", "uni_db");
if (isset($_POST['id']) && isset($_POST['username']) && strlen($_POST['username'])>0 && isset($_POST['password']) && strlen($_POST['password'])>0) {

    // verificam daca s-au completat formurile, cu un default value daca nu au fost completate.
    // posibil aici sa facem si o validare in care verificam daca putem folosii datele de la user.
    $username = $_POST['username'] ?? "";

    $password = $_POST['password'] ?? "";
    $password_confirm = $_POST['password_confirm'] ?? "";
    $pass_hash = md5($password);
    $pass_hash_confirm = md5($password_confirm);

    if( strcmp($pass_hash,$pass_hash_confirm)==0) {    // cauta daca exista un rand cu id-ul respectiv
        $stmt = $mysqli->prepare("SELECT * FROM users WHERE ID = ?");
        $stmt->bind_param("i", $_POST['id']);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        // daca exista => update
        if ($result->num_rows > 0) {
            $updateStmt = $mysqli->prepare("UPDATE users SET username = ?, password_hash = ?   WHERE ID = ?");

            $updateStmt->bind_param("ssi", $username, $pass_hash, $_POST['id']);
            $updateStmt->execute();
            var_dump($updateStmt);
            $updateStmt->close();
        } else {
            // daca nu exista => create
            $createStmt = $mysqli->prepare("INSERT INTO users (username,password_hash) VALUES (?, ?)");
            $createStmt->bind_param("ss", $username, $pass_hash);
            $createStmt->execute();
            $createStmt->close();
        }
    }}
?>
<body>
<a href="index.php">Back</a>
<h1 class = "title_text">Register User</h1>
<div class="form center">
    <form method="post" action="register.php">


                <input type="hidden" name="id" value=""/>

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
        <div>
            <label>
                <p>Confirm Password:</p>
                <input type="password" name="password_confirm" value=""/>
            </label>
        </div>
        <br>
        <button type="submit">Register</button>
    </form>
</div>

<?php

// ia toate randurile din db

$stmt = $mysqli->prepare("SELECT * FROM users");
$stmt->execute();
$result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt->close();
?>
<!--
<h2>Users</h2>
<table>
    <thead>
    <th>Id</th>
    <th>Nume</th>
    <th>Pass_hash</th>
    </thead>
    <tbody>
    <?php
    foreach ($result as $row) {
        ?>
        <tr>
            <td><?php echo $row['ID'] ?></td>
            <td><?php echo $row['username'] ?></td>
            <td><?= $row['password_hash'] ?></td>
        </tr>
        <?php
    }
    ?>
    </tbody>
</table>
-->
</body>
</html>