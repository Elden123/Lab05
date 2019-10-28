<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

$username = $_POST["names"];

$mysqli = new mysqli("mysql.eecs.ku.edu", "nolanblankenau", "uVai4ohm", "nolanblankenau");

/* check connection */
if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}

$query = "SELECT * FROM Posts WHERE author_id = '$username'";
if ($result = $mysqli->query($query)) {

    echo "<table>";
    echo "<tr>";
    echo "<th>post_id</th>";
    echo "<th>content</th>";
    echo "</tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["post_id"] . "</td>";
        echo "<td>" . $row["content"] . "</td>";
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