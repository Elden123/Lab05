<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

$postId = $_POST["postId"];

$mysqli = new mysqli("mysql.eecs.ku.edu", "nolanblankenau", "uVai4ohm", "nolanblankenau");

if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}

foreach ($postId as $item){ 
    echo "Deleting post with id " . $item . "...";
    $query = "DELETE FROM Posts WHERE post_id = '$item'";
    if ($result = $mysqli->query($query)) {
        echo "Success" . "<br>";
    } else {
        echo "Error" . "<br>";
    }
}

$mysqli->close();

?>