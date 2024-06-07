<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Page</title>
</head>

<body>
    <h1>Registartion Page</h1>
    <form action="addUser.php" method="post">
        <label for="matric">ID:</label>
        <input type="text" name="matric" id="matric" required><br><br>
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required><br><br><label for="password">Password:</label>
        <input type="password" name="password" id="password" required><br><br>
        <label for="role">Role:</label>
        <select name="role" id="role">
            <option value="lecturer">Lecturer</option>
            <option value="student">Student</option>
        </select><br><br>
        <input type="submit" name="submit" value="Submit">
        <a class="btn btn-outline-danger" href="login.php" role="button">Back</a>
    </form>
</body>

</html>
