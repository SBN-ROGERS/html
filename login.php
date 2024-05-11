<?php

$conn=new mysqli("localhost","root","","rogers");
if(isset($_POST['name']) && isset($_POST['password'])) {
    // Your code to process the login here
    $username = $_POST['name'];
    $password = $_POST['password'];
    
    // Further processing...
} else {
    // Handle case when name or password is not set
    echo "Name or password not provided.";
}
if($conn->connect_error){
    die("Failed to connect".$conn->connect_error);
}
else{
    $stmt=$conn->prepare("select * from user where name=?");
    $stmt->bind_param("s",$username);
    $stmt->execute();
    $stmt_result=$stmt->get_result();

    if($stmt_result->num_rows>0){
        $data=$stmt_result->fetch_assoc();
        if($data['password']==$password){
            echo "<h2>Login Successfully</h2>";
        }
        else{
            echo "<h2>Invalid user name or password</h2>";
        }
    }
    else{
        echo "Invalid username or password";
    }

}
?>