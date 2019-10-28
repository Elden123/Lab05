<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);


$mysqli = new mysqli("mysql.eecs.ku.edu", "nolanblankenau", "uVai4ohm", "nolanblankenau");

/* check connection */
if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}

$query = "SELECT * FROM Users";
$isAlreadyThere = False;
if ($result = $mysqli->query($query)) {

    echo "<table>";
    echo "<tr>";
    echo "<th>user_id</th>";
    echo "</tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["user_id"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";

    $result->free();
} else {
    echo "An error has occured";
}

/* close connection */
$mysqli->close();


?>