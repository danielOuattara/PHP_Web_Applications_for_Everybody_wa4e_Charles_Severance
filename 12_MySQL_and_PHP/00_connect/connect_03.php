<?php

/** 
 * Simply connect to DB and fetch all users.
 * No While loop in printing results 
 * 
 * Require external DB connexion tools
 * 
*/

echo "<pre>\n";
require_once "./../pdo.php";

$stmt = $pdo->query("SELECT name, email, password FROM users");
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo '<table border="1">'."\n";
echo 
'<tr>
    <td>Name</td>
    <td>Email</td>
    <td>Password</td>
</tr>';

foreach ( $rows as $row ) {
    echo "<tr><td>";
    echo($row['name']);
    echo("</td><td>");
    echo($row['email']);
    echo("</td><td>");
    echo($row['password']);
    echo("</td></tr>\n");
}
echo "</table>\n";
