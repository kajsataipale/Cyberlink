<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';


if (isset($_POST['title'], $_POST['link'])) {
  $title = filter_var(trim($_POST['title']), FILTER_SANITIZE_STRING);
  $link = filter_var(trim($_POST['link']), FILTER_SANITIZE_STRING);
  $description = filter_var(trim($_POST['description']), FILTER_SANITIZE_STRING);

  $statement = $pdo->prepare('INSERT INTO posts (title, link_url, description, user_id) VALUES (:title, :link, :description, :user_id)');
    if (!$statement) {
     die(var_dump($pdo->errorInfo()));
   }
  $statement->bindParam(':title', $title, PDO::PARAM_STR);
  $statement->bindParam(':link', $link, PDO::PARAM_STR);
  $statement->bindParam(':description', $description, PDO::PARAM_STR);
  $statement->bindParam(':user_id', $_SESSION['user']['user_id'], PDO::PARAM_INT);
  $statement->execute();





  }


    $statement = $pdo->prepare("SELECT * from users NATURAL JOIN posts WHERE user_id=user_id ORDER BY post_id DESC");

      if (!$statement) {
       die(var_dump($pdo->errorInfo()));
     }
  $statement->execute();

  $posts = $statement->fetchAll(PDO::FETCH_ASSOC);

  redirect('/home.php');



// In this file we store/insert new posts in the database.
