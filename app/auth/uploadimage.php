<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';


if (isset($_FILES['picture'])){

   $picture = $_FILES['picture'];
   $info = pathinfo($_FILES['picture']['name']);
   $fileName = $_SESSION['user']['username'].'.'.'png';
   $username= $_SESSION['user']['username'];

  move_uploaded_file($picture['tmp_name'], __DIR__.'/../../images/'.$fileName);

  // store the image name in a variable and then store the image in the images file and insert the image name into the database
  $statement=$pdo->prepare('UPDATE users set image=:picture WHERE username=:username');

  if(!$statement){
    die(var_dump(
      $pdo->errorInfo()
    ));
  }
  $statement->bindParam(':picture', $fileName, PDO::PARAM_STR);
  $statement->bindParam(':username', $username, PDO::PARAM_STR);

    $statement->execute();
}


$statement = $pdo->query('SELECT * FROM users WHERE  username=:username');

      if(!$statement){
        die(var_dump(
          $pdo->errorInfo()
        ));
      }


      $statement->bindParam(':username', $username, PDO::PARAM_STR);
      $statement->execute();


      $user = $statement->fetch(PDO::FETCH_ASSOC);

      redirect('/account.php');
