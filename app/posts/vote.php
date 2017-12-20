<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

if (isset($_POST['image'])) {

=$_POST['image'];

  $statement = $pdo->prepare('INSERT INTO votes (user_id, post_id, direction) VALUES (:user_id, :post_id, :direction)');
    if (!$statement) {
     die(var_dump($pdo->errorInfo()));
   }


   $statement->bindParam(':user_id', $_SESSION['user']['user_id'], PDO::PARAM_INT);
   $statement->bindParam(':post_id', $_SESSION['post']['post_id'], PDO::PARAM_INT);
   $statement->bindParam(':direction', $description, PDO::PARAM_INT);
   $statement->execute();

}
  redirect('/home.php');
