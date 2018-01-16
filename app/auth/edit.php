<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

if (isset($_POST['email'], $_POST['password'], $_POST['biography'])) {
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $username = filter_var(trim($_POST['username']), FILTER_SANITIZE_STRING);
    $bio = filter_var(trim($_POST['biography']), FILTER_SANITIZE_STRING);

    if (isset($_POST['password'])){
      $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

      // first I fetch all the users except the one thats logged in
      $statement = $pdo->prepare("SELECT * FROM users where user_id != :id");
      $statement->bindParam(':id', $_SESSION['user']['user_id'], PDO::PARAM_INT);
      $statement->execute();
      $users = $statement->fetchAll(PDO::FETCH_ASSOC);
        foreach ($users as $user) {
          $userEmail = $user['email'];
          $Username = $user['username'];
          $userID = $user['user_id'];
          // If the email entered by the user is equal to an existing email an error session is saved and the database is not updated
       if ($userEmail === $email) {
         //if the email alreary exist echo out a message
           $_SESSION['error'] = "The email address already exists";
           redirect('/editaccount.php');
       }
       // If the username enered by the user is equal to an existing username an error session is saved and the database is not updated
       if ($Username === $username) {
         //if the username alreary exist echo out a message
           $_SESSION['error'] = "The username already exists";
           redirect('/editaccount.php');
       }
   }


    $statement = $pdo->prepare('UPDATE users SET email=:email, username=:username, biography=:bio, password=:password WHERE user_id=:id');
    // Update the user information

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
  // fetch the updated information about the user and redirect to the accountpage

$user = $statement->fetch(PDO::FETCH_ASSOC);


$_SESSION['user'] = [
          'user_id'=> $user['user_id'],
          'username' => $user['username'],
          'email' => $user['email'],
          'biography' => $user['biography'],
      ];

redirect('/account.php');
