<?php

/** 
 * Simply connect to DB and fetch all users.
 * No While loop.
 * Printing result, each one row in a table 
 * 
 */

$pdo = new PDO(
    $dsn = 'mysql:host=localhost;port=3306;dbname=wa4e_misc',
    $username = 'root',
    $password = ''
);

$stmt = $pdo->query("SELECT name, email, password FROM users");
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);


echo '<table border="1">' . "\n";
echo
'<tr>
<td>Name</td>
<td>Email</td>
<td>Password</td>
</tr>';

foreach ($rows as $row) {
    echo "<tr><td>";
    echo ($row['name']);
    echo ("</td><td>");
    echo ($row['email']);
    echo ("</td><td>");
    echo ($row['password']);
    echo ("</td></tr>\n");
}
echo "</table>\n";


$pdo = null;
