<?php

        $servername = "localhost";
        $username = "root";
        $password = "";

        $conn = mysqli_connect($servername, $username, $password);
        
        $selected_db = mysqli_select_db($conn, "khired_networks");


        $name = $_POST['name'];
        $job_descr = $_POST['job_descr'];
        $distance = $_POST['distance'];
        $job = $_POST['job'];
        $keywords = $_POST['key_words'];
        $role = $_POST['role'];
        $status = $_POST['status'];
        $shift = $_POST['shift'];
        $type = $_POST['type'];

        if(empty($name) || empty($job_descr) || empty($distance) || empty($job) || empty($keywords) || empty($role) || empty($status) || empty($shift) || empty($type))
        {
            die("Incomplete Information ! ");
        }
        else{

            $search_query = "SELECT * FROM employees INNER JOIN ROLES ON employees.ROLE_ID = ROLES.ROLE_ID WHERE ROLES.ROLE = '$role' AND employees.NAME = '$name' AND employees.JOB = '$job' AND employees.STATUS = '$status' AND employees.SHIFT = '$shift' AND employees.DESCRIPTION = '$job_descr' AND employees.TYPE = '$type' AND employees.KEY_WORDS = '$keywords' AND employees.DISTANCE = '$distance'";
            $result = mysqli_query($conn, $search_query);

                if($result->num_rows > 0) {
                        
                       $return_arr =  array();
                        while($row = mysqli_fetch_array($result))
                        {
                            $name = $row['NAME'];
                            $job = $row['JOB'];
                            $status = $row['STATUS'];
                            $shift = $row['SHIFT'];
                            $role = $row['ROLE'];
                            $type = $row['TYPE'];
                            
                            $return_arr[] = array('name' => $name,'job' => $job, 'status' => $status, 'shift' => $shift, 'role' => $role, 'type' => $type);
                        }    
                        echo json_encode($return_arr);	
                    }
                    else {
                        header('Location: home.php');
                        //echo('This is the problem');
                        }
                }
        mysqli_close($conn);
    ?>