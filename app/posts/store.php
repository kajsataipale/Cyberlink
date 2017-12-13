<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

if (isset($_POST['title'], $_POST['link'])) {
  $title = filter_var(trim($_POST['title']), FILTER_SANITIZE_STRING);
  $link = filter_var(trim($_POST['link']), FILTER_SANITIZE_STRING);
  $description = filter_var(trim($_POST['description']), FILTER_SANITIZE_STRING);

  $statement = $pdo->prepare('INSERT INTO posts (title, link, description) VALUES (:title, :link, :description)');
  $statement->bindParam(':title', $title, PDO::PARAM_STR);
  $statement->bindParam(':link', $link, PDO::PARAM_STR);
  $statement->bindParam(':description', $description, PDO::PARAM_STR);
  $statement->execute();

  $user = $statement->fetch(PDO::FETCH_ASSOC);
}

// In this file we store/insert new posts in the database.

redirect('/home.php');
