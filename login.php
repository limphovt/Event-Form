<?php
session_start();
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);

    if (empty($email)) {
        $errors[] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    } elseif (!isset($_SESSION["user"]) || $_SESSION["user"]["email"] !== $email) {
        $errors[] = "No registration found for this email.";
    } else {
        $_SESSION["logged_in"] = true;
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
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <?php if ($errors): ?>
            <div class="error"><?php echo implode("<br>", $errors); ?></div>
        <?php endif; ?>
        <form method="POST">
            <input type="email" name="email" placeholder="Enter Email" required>
            <button type="submit">Login</button>
        </form>
        <p>New user? <a href="register.php">Register here</a></p>
    </div>
</body>
</html>
