<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

// Check if both email and password exists in the POST request.
if (isset($_POST['email'], $_POST['password'])) {
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);

     $statement = $pdo->prepare('SELECT * FROM users WHERE email = :email OR username= :email');
     $statement->bindParam(':email', $email, PDO::PARAM_STR);
     $statement->execute();

    // Fetch the user as an associative array.
     $user = $statement->fetch(PDO::FETCH_ASSOC);

    // If we couldn't find the user in the database, redirect back to the login page

    if (!$user) {
          $_SESSION['error']="The user does not exist";
        redirect('/login.php');
        // If the user does not exist, redirect back to the login page
    }
    if (!password_verify($_POST['password'], $user['password'])) {
      $_SESSION['error']="The password was invalid";
        redirect('/login.php');
          // If the password and user does not exit/match redirect to the login page.
    }


    if (password_verify($_POST['password'], $user['password'])) {
      // If the user is found in the database and the password is correct
      // then I store the information in $_SESSION['user'] and redirect to the account page.

        unset($user['password']);



        $_SESSION['user'] = [
                  'user_id'=> $user['user_id'],
                  'username' => $user['username'],
                  'email' => $user['email'],
                  'biography' => $user['biography'],
              ];

        redirect('/account.php');
    }
}
