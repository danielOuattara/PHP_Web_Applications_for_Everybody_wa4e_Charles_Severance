<?php
echo "<pre>\n";
$pdo = new PDO(
    'mysql:host=localhost;port=3307;dbname=wa4e_misc_2',
    'fred',
    'zap'
);

$stmt = $pdo->query("SELECT * FROM users");
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

print_r($rows);

echo "</pre>\n";
