<?php
include "conn.php";
//if($db){ echo "connection success";}
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
     <table style="margin-left: auto; margin-right: auto;">
     <?php
     if ($result->num_rows > 0) {
        //echo '<table>';
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
            echo '<td>' . $row['matric'] . '</td>';
            echo '<td>' . $row['name'] . '</td>';
            echo '<td>' . $row['role'] . '</td>';
            echo '<td><a href="updateUser.php?matric=' . $row['matric'] . '" class="btn btn-primary">Update</a></td>';
            echo '<td><a href="deleteUser.php?matric=' . $row['matric'] . '" class="btn btn-danger">Delete</a></td>';
            echo '</tr>';
        }
        
        echo '</tbody>';
        //echo '</table>';
    } else {
        echo "No records found";
    }
$conn->close();
?>
</table><br><br>
<div class="button-container">
    <button type="button" onclick="window.location.href='login.php'">
        Logout
    </button>
</div>
</body>
</html>