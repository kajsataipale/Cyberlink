<?php require __DIR__.'/views/header.php';

$statement = $pdo->query('SELECT * FROM users WHERE user_id=:user_id');

      if(!$statement){
        die(var_dump(
          $pdo->errorInfo()
        ));
      }


      $statement->bindParam(':user_id', $_SESSION['user']['user_id'] ,PDO::PARAM_INT);
      $statement->execute();


      $user = $statement->fetch(PDO::FETCH_ASSOC);

      $statement = $pdo->prepare("SELECT * from posts WHERE user_id=:user_id");
      if (!$statement) {
        die(var_dump($pdo->errorInfo()));
      }

      $statement->bindParam(':user_id', $_SESSION['user']['user_id'], PDO::PARAM_INT);
        $statement->execute();
        $posts = $statement->fetchAll(PDO::FETCH_ASSOC);




 ?>
<article>

    <?php if (isset($_SESSION['user'])): ?>
        <h1>Welcome, <?php echo $_SESSION['user']['username']; ?>!</h1>
    <?php endif; ?>
    <p>This is the account page.</p>
    <p>Here you can edit your profile and upload a profile picture</p>
</article>
<article class="row">

  <form action="/app/auth/uploadimage.php" method="post" enctype="multipart/form-data">

<div class="form-group col">
  <?php  if(!isset($user['image'])): ?>
    <img src="images/placeholder.png" class="img-thumbnail" width="200px">
  <?php else : ?>
    <img src="<?php echo '/images/'.$user['image']?>" class="img-thumbnail" width="20%">

  <?php endif;?>


  <input type="file" name="picture" accept=".png, .jpg">
  <button type="submit" class="btn btn-info"> Upload</button>
</form>

  <p><b><?php echo $_SESSION['user']['username']; ?></b></p>

  <p><?php echo $_SESSION['user']['email']; ?></p>


    <label for="email"><i>Biography</i></label>
      <p><b><?php echo $_SESSION['user']['biography']; ?></b></p>

    <a href="editaccount.php" class="btn btn-info">Edit profile</a>
</div>

      <div class="col-sm">
        <?php foreach ($posts as $post): ?>
          <div  class="posts">
            <div class="title"><?php echo $post['title'] ;?></div>
            <a target="_blank" href=" <?php echo $post['link_url'] ;?> "><?php echo $post['link_url']; ?></a>
            <div class="description"> <?php echo $post['description'] ;?></div>
          </div>
        <?php endforeach ; ?>
      </div>
      </arcticle>


<?php require __DIR__.'/views/footer.php'; ?>
