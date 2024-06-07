<?php
include("conn.php");
if(isset($_POST['submit'])){
        $matric="";
        $name="";
        $password="";
        $role="";

    $matric = $_POST['matric'];
    $name = $_POST['name'];
    $password = $_POST['password'];
    $role = $_POST['role'];
         
    // check connection
    if($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }

     // Hash the password
     $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
    
    if($matric && $name && $password && $role ){
        $mysql = "INSERT INTO users (matric,name,password,role) VALUES ('$matric','$name','$hashedPwd','$role')";  

        if($conn->query($mysql)===TRUE){
            echo "Sucessfully registration";
            header('location:registration.php?success=1');
            exit();
}
else{
    echo("Error in Adding Records in Table : ".$conn->connect_error);
}
    }
    else{
        echo "<br><br><br>";
        echo "<center>";
        echo "<span style='color:red; font-size:30px;'>FILL UP <strong>All OF THE FIELDS ON THE FORM IN ORDER TO UPDATE </strong> !!</span>";
        echo "";
        echo "</center>";
    }   header('location:registration.php');
$conn->close();
}

else{
    echo "";
}

?>