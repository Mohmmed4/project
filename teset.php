<?php

$password='12345';
$passwordhashed = password_hash($password, PASSWORD_DEFAULT);

if (password_verify($password,'$2y$10$38jd2F8P8wFvYCEZoqmvBOS')) {
//

    echo ''.$passwordhashed.'   '.$password;
    echo '    -->>ok';
    exit();

    header("Location: home_page.php");
} else {

    echo 'not ok';
    exit();
}