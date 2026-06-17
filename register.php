<?php
include 'db.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

try {

    $sql = "INSERT INTO users (username, password)
            VALUES ('$username', '$password')";

    $conn->query($sql);

    $message = "Registration Successful!";

} catch (mysqli_sql_exception $e) {

    $message = "Username already exists. Try another username.";

}
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>

<h2>User Registration</h2>

<form method="POST">
    Username:
    <input type="text" name="username" required>
    <br><br>

    Password:
    <input type="password" name="password" required>
    <br><br>

    <button type="submit">Register</button>
</form>

<p><?php echo $message; ?></p>

</body>
</html>