<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

$username = $_POST["username"];

if (strlen($username) > 0) {
    $mysqli = new mysqli("mysql.eecs.ku.edu", "nolanblankenau", "uVai4ohm", "nolanblankenau");

    /* check connection */
    if ($mysqli->connect_errno) {
        printf("Connect failed: %s\n", $mysqli->connect_error);
        exit();
    }

    $query = "SELECT * FROM Users WHERE user_id = '$username'";
    $isAlreadyThere = False;
    if ($result = $mysqli->query($query)) {
        //echo "first if";
        /* fetch associative array */
        while ($row = $result->fetch_assoc()) {
            //echo "printing";
            if ($row["user_id"] == $username) {
                $isAlreadyThere = True;
            }
        }

        /* free result set */
        $result->free();
    } else {
        echo "An error has occured";
    }

    if($isAlreadyThere) {
        echo "Sorry, but that username already exists. Please pick another one";
    } else {
        //echo "about to insert";
        $query = "INSERT INTO Users (user_id) VALUES ('$username')";
        if($result = $mysqli->query($query)) {
            echo "User Created";
        } else {
            echo "An error has occured while createing user";
        }
    }

    /* close connection */
    $mysqli->close();
} else {
    echo "Username must be longer than 0 characters";
}

?>