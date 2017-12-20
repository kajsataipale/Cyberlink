<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

if (isset($_POST['email'], $_POST['password'], $_POST['biography'])) {
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $username = filter_var(trim($_POST['username']), FILTER_SANITIZE_STRING);
    $bio = filter_var(trim($_POST['biography']), FILTER_SANITIZE_STRING);

    if (isset($_POST['password'])){
      $password = password_hash($_POST['password'], PASSWORD_DEFAULT);


    $statement = $pdo->prepare('UPDATE users SET email=:email, username=:username, biography=:bio, password=:password WHERE user_id=:id');

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }
    $statement->bindParam(':id', $_SESSION['user']['user_id'], PDO::PARAM_INT);
    $statement->bindParam(':email', $email, PDO::PARAM_STR);
    $statement->bindParam(':username', $username, PDO::PARAM_STR);
    $statement->bindParam(':bio', $bio, PDO::PARAM_STR);
   $statement->bindParam(':password',$password, PDO::PARAM_STR);

    $statement->execute();

}
}

$statement = $pdo->query('SELECT * FROM users WHERE  username= :username');
$statement->bindParam(':username', $username, PDO::PARAM_STR);
$statement->execute();


$user = $statement->fetch(PDO::FETCH_ASSOC);


$_SESSION['user'] = [
          'user_id'=> $user['user_id'],
          'username' => $user['username'],
          'email' => $user['email'],
          'biography' => $user['biography'],
      ];

redirect('/account.php');
