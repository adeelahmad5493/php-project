<?php
    include 'connect_db.php';

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $username = test_input($_POST['username']);
    $password = test_input($_POST['password']);

    if(empty($username) || empty($password))
    {
        die("Incomplete Information: ".mysqli_error($conn));
    }
    
    $query = "SELECT * FROM CREDENTIALS WHERE CREDENTIALS.USERNAME = ? AND CREDENTIALS.PASSWORD = ? LIMIT 1";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ss', $username, $password);
    $stmt->execute();
    $stmt->store_result();
    
    if($stmt->fetch())
    {
        header("Location:home.php");
    }
    else{
        //$_SESSION['invalid'] = TRUE;
        header("Location:login_page.php");
    }

?>