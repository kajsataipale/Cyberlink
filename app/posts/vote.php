<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

// Check to see if the postid is in the post request.
if (isset($_POST['post_id'])) {

$PostId = filter_var($_POST['post_id'], FILTER_SANITIZE_NUMBER_INT);
$user_id= filter_var($_SESSION['user']['user_id'], FILTER_SANITIZE_NUMBER_INT);

if (isset($_POST['up'] )){
// if the post request is up, the value is 1
  $direction= filter_var($_POST['up'], FILTER_SANITIZE_NUMBER_INT);

} elseif (isset($_POST['down'])){
// if the post request is down, the value is -1
  $direction= filter_var($_POST['down'], FILTER_SANITIZE_NUMBER_INT);
}

$statement = $pdo->prepare('SELECT * from votes WHERE user_id=:user_id AND post_id=:post_id');
if (!$statement) {
 die(var_dump($pdo->errorInfo()));
}

$statement->bindParam(':user_id', $_SESSION['user']['user_id'], PDO::PARAM_INT);
$statement->bindParam(':post_id', $_POST['post_id'], FILTER_SANITIZE_NUMBER_INT);
$statement->execute();

$vote = $statement->fetch(PDO::FETCH_ASSOC);

if($vote){
  if($vote['direction']===$direction){
      redirect('/home.php');

  } // Update to current vote
$statement= $pdo->prepare('UPDATE votes SET direction=:direction WHERE user_id=:user_id AND post_id=:post_id');
$statement->bindParam(':direction', $direction, PDO::PARAM_INT);
$statement->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$statement->bindParam(':post_id', $PostId, PDO::PARAM_INT);
$statement->execute();

  redirect('/home.php');
}else {
  $statement = $pdo->prepare('INSERT INTO votes (user_id, post_id, direction) VALUES (:user_id, :post_id, :direction)');
    if (!$statement) {
     die(var_dump($pdo->errorInfo()));
   }

   $statement->bindParam(':user_id', $user_id, PDO::PARAM_INT);
   $statement->bindParam(':post_id', $PostId, PDO::PARAM_INT);
   $statement->bindParam(':direction', $direction, PDO::PARAM_INT);
   $statement->execute();

    redirect('/home.php');
}
}
