<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';


if (isset($_POST['post_id'])){
  $PostId = filter_var($_POST['post_id'], FILTER_SANITIZE_NUMBER_INT);


  $statement = $pdo->prepare("DELETE FROM posts WHERE post_id=:post_id");
  if (!$statement) {
    die(var_dump($pdo->errorInfo()));
  }
}
// here the database check to see if the postid matches and if they do the database deletes the post.
 $statement->bindParam(':post_id', $PostId, PDO::PARAM_INT);
 $statement->execute();

redirect('/home.php');

// In this file we delete posts in the database.
