<?php
session_start();
include 'db.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $title = $_POST['title'];
    $content = $_POST['content'];

    $sql = "INSERT INTO posts(title, content)
            VALUES('$title', '$content')";

    if ($conn->query($sql) === TRUE) {
        $message = "Post Created Successfully!";
    } else {
        $message = "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Create Post</title>
</head>
<body>

<h2>Create New Post</h2>

<form method="POST">

    Title:
    <input type="text" name="title" required>

    <br><br>

    Content:
    <br>

    <textarea name="content" rows="5" cols="40" required></textarea>

    <br><br>

    <button type="submit">Create Post</button>

</form>

<p><?php echo $message; ?></p>

<br>

<a href="index.php">Back to Dashboard</a>

</body>
</html>