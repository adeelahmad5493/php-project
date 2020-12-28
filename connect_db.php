<?php
    $server_name = "localhost";
    $user_name = "root";
    $password = "";

    $conn = mysqli_connect($server_name, $user_name, $password);

    if(!$conn)
    {
        die("Cant Connect To SERVER: ".mysqli_error($conn));
    }

    $db_selected = mysqli_select_db($conn, 'khired_networks');
    if(!$db_selected)
    {
        die("Database Not Selected:".mysqli_error($conn));
    }

?>