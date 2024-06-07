<!doctype html>
<html lang="en">
<head>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="mx-auto" style="width: auto;">
                <h1><b>UPDATE USER</b></h1>
            </div>
            <div class="col-md-12 col-md-offset-3">
                <p></p>
                
                <p></p>
                <form method="POST">
                    <div class="form-group">
                    <?php 
                        include "conn.php";
                        // Check if matric is set in the URL
                        if(isset($_GET['matric'])) {
                            $matric = $_GET['matric'];
                            
                            // Fetch user details from the database
                            $sql = "SELECT * FROM users WHERE matric='$matric'";  
                            $rows = $conn->query($sql);    
                            $row = $rows->fetch_assoc();
                        } else {
                            // Handle case where matric is not provided
                            echo "Matric number not provided.";
                            exit; // Exit script
                        }
                    ?>
                    <label for="matric">ID :</label>
                    <input type="text" name="matric" class="form-control" id="matric" value="<?php echo $row['matric']; ?>" readonly><br><br>
                    <label for="name">Name:</label>
                    <input type="text" name="name" class="form-control" id="name" value="<?php echo $row['name']; ?>" required><br><br>
                    <label for="role">Role:</label>
                    <select name="role" id="role" class="form-control" required>
                        <option value="lecturer" <?php if ($row['role'] == 'lecturer') echo 'selected'; ?>>Lecturer</option>
                        <option value="student" <?php if ($row['role'] == 'student') echo 'selected'; ?>>Student</option>
                    </select><br><br>
                    </div>
                    <button type="submit" name="send" class="btn btn-primary">Update</button>
                    <a class="btn btn-outline-danger" href="user.php" role="button">Back</a>
                </form>
                <?php 
                if(isset($_POST['send'])){
                    $matric = $_POST['matric'];
                    $name = $_POST['name'];
                    $role = $_POST['role'];

                    if($conn->connect_error){
                        die("Connection failed: " . $conn->connect_error);
                    }
                    if(!empty($matric) && !empty($name) && !empty($role)) {
                        $sql = "UPDATE users SET name = '$name', role = '$role' WHERE matric = '$matric'";

                        if($conn->query($sql)){
                            header('Location: user.php');
                            exit();
                        } else {
                            echo("Error updating record: " . $conn->error);
                        }
                    } else {
                        echo "<br>";
                        echo "<center>";
                        echo "<span style='color:red; font-size:30px;'>FILL UP <strong>All OF THE FIELDS ON THE FORM IN ORDER TO UPDATE </strong> !!</span>";
                        echo "</center>";
                    }
                }
                $conn->close();
                ?>
            </div>
        </div>
    </div>
</body>
</html>
