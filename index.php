<?php
session_start();
include 'db.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$result = $conn->query("SELECT * FROM posts ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html>

<head>
    <title>Dashboard</title>
</head>

<body>

    <h1>Welcome <?php echo $_SESSION['username']; ?></h1>

    <a href="create.php">Create Post</a>
    <br><br>

    <h2>All Posts</h2>

    <?php while ($row = $result->fetch_assoc()) { ?>

        <h3><?php echo $row['title']; ?></h3>

        <p><?php echo $row['content']; ?></p>

        <a href="edit.php?id=<?php echo $row['id']; ?>">
            Edit
        </a>

        |
        <a href="delete.php?id=<?php echo $row['id']; ?>"
            onclick="return confirm('Are you sure?')">
            Delete
        </a>

        <small>
            <?php echo $row['created_at']; ?>
        </small>

        <hr>

    <?php } ?>

    <a href="logout.php">Logout</a>

</body>

</html>