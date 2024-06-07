<?php
session_start();
include("conn.php");

if (isset($_POST['submit'])) {
    $matric = $_POST['matric'];
    $password = $_POST['password'];

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve user from database
    $sql = "SELECT * FROM users WHERE matric='$matric'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Fetch user data
        $row = $result->fetch_assoc();
        $hashedPwd = $row['password'];

        // Verify password
        if (password_verify($password, $hashedPwd)) {
            // Set session variables
            $_SESSION['matric'] = $row['matric'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['role'] = $row['role'];

            // Redirect to user page
            header('Location: user.php');
            exit();
        } else {
            // Password is incorrect
            header('Location: login.php?error=1');
            exit();
        }
    } else {
        // User not found
        header('Location: login.php?error=1');
        exit();
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
</head>
<body>
    <h1>Login Page</h1>
    <form action="login.php" method="post">
        <label for="matric">ID:</label>
        <input type="text" name="matric" id="matric" required><br><br>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required><br><br>
        <input type="submit" name="submit" value="Login">
    </form>
    <p>Don't have an account? <a href="registration.php">Register here</a></p>

    <?php
    if (isset($_GET['error'])) {
        echo "<p style='color:red;'>Invalid ID or Password. Please try again.</p>";
    }
    ?>
</body>
</html>
