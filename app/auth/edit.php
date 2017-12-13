<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

if (isset($_POST['email'], $_POST['password'])) {
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $bio = filter_var($_POST['bio'], FILTER_SANITIZE_STRING);
    $image = filter_var($_POST['image'], FILTER_SANITIZE_STRING);


    $statement = $pdo->prepare('UPDATE users (email, username, biography, image) VALUES (:email, :username, :bio, :image)');
    $statement->bindParam(':email', $email, PDO::PARAM_STR);
    $statement->bindParam(':username', $username, PDO::PARAM_STR);
    $statement->bindParam(':bio', $bio, PDO::PARAM_STR);
    $statement->bindParam(':image', $image, PDO::PARAM_STR);
    $statement->execute();

    $user = $statement->fetch(PDO::FETCH_ASSOC);

}
redirect('/account.php');
