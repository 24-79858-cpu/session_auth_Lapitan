<?php
session_start();
require_once "db.php";

if (!isset($_SESSION["username"])) {
    header("Location: index.php");
    exit;
}

$username = $_SESSION["username"];

$stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-dark bg-dark px-3">
    <span class="navbar-brand">SessionAuthSystem</span>
    <a href="logout.php" class="btn btn-danger btn-sm">Logout</a>
</nav>

<div class="container mt-5">
    <div class="card p-5">
        <h1 class="text-primary">Welcome, <?php echo $user["username"]; ?>!</h1>
        <p>This page is protected and only visible to logged-in users.</p>
        <hr>
        <p><strong>User ID:</strong> <?php echo $user["id"]; ?></p>
        <p><strong>Username:</strong> <?php echo $user["username"]; ?></p>
        <p><strong>Email:</strong> <?php echo $user["email"]; ?></p>
        <p><strong>Joined:</strong> <?php echo $user["created_at"]; ?></p>
    </div>
</div>

<marquee behavior="scroll" direction="left">This is a demo dashboard. You can log out and log back in to see session regeneration in action.</marquee>


</body>
</html>