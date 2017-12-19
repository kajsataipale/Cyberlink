<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';


if (isset($_POST['post_id'],$_POST['title'],$_POST['description'],$_POST['link_url'] )){
  $PostId = filter_var($_POST['post_id'], FILTER_SANITIZE_NUMBER_INT);
  $title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
  $description = filter_var($_POST['description'], FILTER_SANITIZE_STRING);
  $link_url = filter_var($_POST['link_url'], FILTER_SANITIZE_URL);


  $statement = $pdo->prepare("UPDATE posts set title=:title, description=:description, link_url=:link_url WHERE post_id=:post_id");
  if (!$statement) {
    die(var_dump($pdo->errorInfo()));
  }
}

$statement->bindParam(':title', $title, PDO::PARAM_STR);
 $statement->bindParam(':description', $description, PDO::PARAM_STR);
 $statement->bindParam(':link_url', $link_url, PDO::PARAM_STR);
 $statement->bindParam(':post_id', $PostId, PDO::PARAM_INT);
 $statement->execute();

redirect('/editpost.php');
// In this file we upate posts in the database.
