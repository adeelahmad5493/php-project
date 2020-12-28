<?php
    include 'connect_db.php';

    
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    

    $name = test_input($_POST['name']);
    $email = test_input($_POST['email']);
    $password = test_input($_POST['password']);
    $re_password = test_input($_POST['confirm_password']);

    
    //print_r("Hello ".$name.". Email: ".$email." Password: ".$password);

    if(empty($name) || empty($email) || empty($password) || empty($re_password))
    {
        die("Incomplete Information. Please Try Again!");
    }
    else{
        $query = "INSERT INTO CREDENTIALS VALUES('','$name', '$email', '$password')";
        if($conn->query($query) === TRUE)
        {
            echo "Data updated Successfully..!";
            header("Location: login_page.php");
        }
        else{
            die("Data not stored.".mysqli_error($conn));
        }
    }
?>
