<?php
session_start();
$errors = [];
$events = ["Science Fair", "Sports Day", "Math Olympiad", "Music Fest"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $event = $_POST["event"];

    // Validation
    if (empty($name) || empty($email) || empty($event)) {
        $errors[] = "All fields are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    } else {
        $_SESSION["user"] = ["name" => $name, "email" => $email, "event" => $event];
        header("Location: index.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register for Event</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Event Registration</h2>
        <?php if ($errors): ?>
            <div class="error"><?php echo implode("<br>", $errors); ?></div>
        <?php endif; ?>
        <form method="POST">
            <input type="text" name="name" placeholder="Enter Full Name" required>
            <input type="email" name="email" placeholder="Enter Email" required>
            <select name="event">
                <option value="">Select Event</option>
                <?php foreach ($events as $e): ?>
                    <option value="<?= $e ?>"><?= $e ?></option>
                <?php endforeach; ?>
            </select>
            <button type="submit">Register</button>
        </form>
        <p>Already registered? <a href="login.php">Login here</a></p>
    </div>
</body>
</html>
