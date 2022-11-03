<?php
$pdo = new PDO(
    $dsn = 'mysql:host=localhost;port=3306;dbname=wa4e_profile',
    $username = 'root',
    $password = ''
);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
