<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';



if (isset($_POST['post_id'])) {


$PostId = filter_var($_POST['post_id'], FILTER_SANITIZE_NUMBER_INT);
$user_id= filter_var($_SESSION['user']['user_id'], FILTER_SANITIZE_NUMBER_INT);

if (isset($_POST['up'] )){

  $direction= filter_var($_POST['up'], FILTER_SANITIZE_NUMBER_INT);

} elseif (isset($_POST['down'])){

  $direction= filter_var($_POST['down'], FILTER_SANITIZE_NUMBER_INT);
}





  $statement = $pdo->prepare('INSERT INTO votes (user_id, post_id, direction) VALUES (:user_id, :post_id, :direction)');
    if (!$statement) {
     die(var_dump($pdo->errorInfo()));
   }


   $statement->bindParam(':user_id', $user_id, PDO::PARAM_INT);
   $statement->bindParam(':post_id', $PostId, PDO::PARAM_INT);
   $statement->bindParam(':direction', $direction, PDO::PARAM_INT);
   $statement->execute();

}
   redirect('/home.php');