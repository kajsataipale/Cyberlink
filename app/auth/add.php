<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

if (isset($_POST['email'], $_POST['password'])) {
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);

    $statement = $pdo->prepare('INSERT INTO users (email, username, password) VALUES (:email, :username, :password)');
    $statement->bindParam(':email', $email, PDO::PARAM_STR);
    $statement->bindParam(':username', $username, PDO::PARAM_STR);
    $statement->bindParam(':password', $password, PDO::PARAM_STR);
    $statement->execute();

    $user = $statement->fetch(PDO::FETCH_ASSOC);
}
redirect('/account.php');
