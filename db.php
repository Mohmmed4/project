<?php

        //connection to the database (school)
        $conn = mysqli_connect('localhost', 'root', '', 'school');
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
        if (!$conn) {
            die('massage' . mysqli_error($conn));
        }

