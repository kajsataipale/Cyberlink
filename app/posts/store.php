<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';


if (isset($_POST['title'], $_POST['link'])) {
  $title = filter_var(trim($_POST['title']), FILTER_SANITIZE_STRING);
  $link = filter_var(trim($_POST['link']), FILTER_SANITIZE_STRING);
  $description = filter_var(trim($_POST['description']), FILTER_SANITIZE_STRING);

  $statement = $pdo->prepare('INSERT INTO posts (title, link_url, description) VALUES (:title, :link, :description)');
  $statement->bindParam(':title', $title, PDO::PARAM_STR);
  $statement->bindParam(':link', $link, PDO::PARAM_STR);
  $statement->bindParam(':description', $description, PDO::PARAM_STR);
  $statement->execute();

   $post = $statement->fetch(PDO::FETCH_ASSOC);

  if(!$post){
    redirect('/postlinks.php');
  } if ($post){
  $statement = $pdo->prepare('SELECT posts.title AS title, posts.description AS description, posts.link_url AS link, AS title, users.username AS username, users.image AS image  FROM posts INNER JOIN users ON posts.post_id=users.user_id');

  $statement->execute();

  $posts = $statement->fetchAll(PDO::FETCH_ASSOC);

  redirect('/home.php');
}
}

// In this file we store/insert new posts in the database.
