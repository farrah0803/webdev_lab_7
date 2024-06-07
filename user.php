<?php
session_start();
include "conn.php";

// Check if the user is logged in
if (!isset($_SESSION['matric'])) {
    header('Location: login.php');
    exit();
}

$sql = "SELECT * FROM users";    
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <style>    
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 50%;
            margin: auto; /* Center the table */
        }
        th{
            border: 1px solid #dddddd;
            text-align: center;
            padding: 8px;
        }
        td{
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        .button-container {
            text-align: center;
        }
    </style>
</head>
<body>
     <h1 style="text-align: center;"><b>LIST OF USER</b></h1>
     <table>
     <?php
     if ($result->num_rows > 0) {
        echo '<thead>';
        echo '<tr>';
        echo '<th scope="col"><b>ID</b></th>';
        echo '<th scope="col"><b>NAME</b></th>';
        echo '<th scope="col"><b>ROLE</b></th>';
        echo '<th scope="col" colspan="2"><b>ACTION</b></th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
        
        // Fetch the results and display them
        while($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($row['matric']) . '</td>';
            echo '<td>' . htmlspecialchars($row['name']) . '</td>';
            echo '<td>' . htmlspecialchars($row['role']) . '</td>';
            echo '<td><a href="updateUser.php?matric=' . htmlspecialchars($row['matric']) . '" class="btn btn-primary">Update</a></td>';
            echo '<td><a href="deleteUser.php?matric=' . htmlspecialchars($row['matric']) . '" class="btn btn-danger">Delete</a></td>';
            echo '</tr>';
        }
        
        echo '</tbody>';
    } else {
        echo "No records found";
    }
    $conn->close();
    ?>
    </table><br><br>
    <div class="button-container">
        <form action="logout.php" method="post">
            <button type="submit" name="logout">Logout</button>
        </form>
    </div>
</body>
</html>
