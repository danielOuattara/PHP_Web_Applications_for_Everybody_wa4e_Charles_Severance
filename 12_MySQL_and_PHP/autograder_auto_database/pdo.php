<?php
$pdo = new PDO(
    $dsn = 'mysql:host=localhost;port=3306;dbname=wa4e_misc',
    $username = 'root',
    $password = ''
);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
