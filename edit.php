<?php
session_start();
include 'db.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$id = $_GET['id'];

$result = $conn->query(
    "SELECT * FROM posts WHERE id=$id"
);

$post = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $title = $_POST['title'];
    $content = $_POST['content'];

    $sql = "UPDATE posts
            SET title='$title',
                content='$content'
            WHERE id=$id";

    if ($conn->query($sql) === TRUE) {

        header("Location: index.php");
        exit();

    } else {

        echo "Error: " . $conn->error;

    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Post</title>
</head>
<body>

<h2>Edit Post</h2>

<form method="POST">

    Title:
    <input
        type="text"
        name="title"
        value="<?php echo $post['title']; ?>"
        required
    >

    <br><br>

    Content:
    <br>

    <textarea
        name="content"
        rows="5"
        cols="40"
        required
    ><?php echo $post['content']; ?></textarea>

    <br><br>

    <button type="submit">
        Update Post
    </button>

</form>

</body>
</html>