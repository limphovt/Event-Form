<?php
session_start();
if (!isset($_SESSION["logged_in"])) {
    header("Location: login.php");
    exit();
}

$user = $_SESSION["user"];
$upcoming_events = [
    ["name" => "Science Fair", "date" => "August 20, 2025", "location" => "Main Hall"],
    ["name" => "Sports Day", "date" => "September 5, 2025", "location" => "Sports Complex"],
    ["name" => "Math Olympiad", "date" => "October 15, 2025", "location" => "Room 305"],
    ["name" => "Music Fest", "date" => "November 30, 2025", "location" => "Auditorium"]
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Event Portal</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Welcome, <?= htmlspecialchars($user["name"]) ?>!</h2>
        <p><strong>You are registered for:</strong> <?= htmlspecialchars($user["event"]) ?></p>

        <hr>

        <h3>🔥 Upcoming Events</h3>
        <ul class="event-list">
            <?php foreach ($upcoming_events as $event): ?>
                <li>
                    <strong><?= $event["name"] ?></strong><br>
                    📅 <?= $event["date"] ?> | 📍 <?= $event["location"] ?>
                </li>
            <?php endforeach; ?>
        </ul>

        <hr>

        <a href="register.php" class="btn">Join Another Event</a>
        <a href="logout.php" class="btn logout">Logout</a>
    </div>
</body>
</html>
