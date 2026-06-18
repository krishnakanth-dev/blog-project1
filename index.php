<?php
session_start();
include 'db.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$search = "";

if (isset($_GET['search'])) {

    $search = $_GET['search'];

    $sql = "SELECT * FROM posts
            WHERE title LIKE '%$search%'
            OR content LIKE '%$search%'
            ORDER BY created_at DESC";
} else {

    $sql = "SELECT * FROM posts
            ORDER BY created_at DESC";
}

$result = $conn->query($sql);
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
    <form method="GET">

        <input
            type="text"
            name="search"
            placeholder="Search posts">

        <button type="submit">
            Search
        </button>

    </form>

    <br>

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