<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

if (isset($_POST['email'], $_POST['password'], $_POST['username'])) {
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $username = filter_var(trim($_POST['username']), FILTER_SANITIZE_STRING);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $statement = $pdo->prepare('INSERT INTO users (email, username, password) VALUES (:email, :username,:password)');


    if (!$statement) {
     die(var_dump($pdo->errorInfo()));
 }

    $statement->bindParam(':email', $email, PDO::PARAM_STR);
    $statement->bindParam(':username', $username, PDO::PARAM_STR);
    $statement->bindParam(':password', $password, PDO::PARAM_STR);
    $statement->execute();


    if (!$user) {
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
      //Check to see if the user is unique, if it is add the user in to the database.
      // store the information in $_SESSION['user'] and redirect the user to the accountpage. 

    }

    if ($user) {
      redirect('/register.php');
      // If the user already exist in the database, direct back to the registerpage

    }
}
