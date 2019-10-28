<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

$username = $_POST["username"];
$postText = $_POST["postText"];

if (strlen($username) > 0 && strlen($postText) > 0) {
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
        //echo "about to create post";
        $query = "INSERT INTO Posts (content, author_id) VALUES ('$postText', '$username')";
        if($result = $mysqli->query($query)) {
            echo "Post Created";
        } else {
            echo "An error has occured while createing post";
        }
    } else {
        echo "Sorry, but that username does not exist. Please create a user with that username.";
    }

    /* close connection */
    $mysqli->close();
} else {
    echo "Username and Post Text must be longer than 0 characters";
}

?>