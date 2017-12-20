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


    }

    // If we found the user in the database, compare the given password from the
    // request with the one in the database using the password_verify function.
    if ($user) {
      redirect('/register.php');
        // If the password was valid we know that the user exists and provided
        // the correct password. We can now save the user in our session.
        // Remember to not save the password in the session!

    }
}
