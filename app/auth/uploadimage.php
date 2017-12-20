<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';


if (isset($_FILES['picture'])){

   $picture = $_FILES['picture'];
   $info = pathinfo($_FILES['picture']['name']); //Skapar array ur 'name'
   $ext = $info['extension']; //Väljer 'extension' ur 'name'
   $fileName = $_SESSION['user']['username'].'.'.$ext;
   $username= $_SESSION['user']['username'];

  move_uploaded_file($picture['tmp_name'], __DIR__.'/../../images/'.$fileName);


  $statement=$pdo->prepare('UPDATE users set image=:picture WHERE username=:username');

  if(!$statement){
    die(var_dump(
      $pdo->errorInfo()
    ));
  }
  // $statement->bindParam(':id', $_SESSION['user']['user_id'], PDO::PARAM_INT);
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


      // $_SESSION['user'] = [
      //           'picture'=> $user['image'],
      //           'user_id'=> $user['user_id'],
      //           'username' => $user['username'],
      //           'email' => $user['email'],
      //           'biography' => $user['biography'],
      //       ];

      redirect('/account.php');
