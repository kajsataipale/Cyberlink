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

      $fetchpost = $pdo->prepare("SELECT * from posts WHERE user_id=:user_id");
      if (!$fetchpost) {
        die(var_dump($pdo->errorInfo()));
      }

      $fetchpost->bindParam(':user_id', $_SESSION['user']['user_id'], PDO::PARAM_INT);
      $fetchpost->execute();
      $posts = $fetchpost->fetchAll(PDO::FETCH_ASSOC);
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
      <div class="form-group col-12 col-md-12">
        <!-- Check to see if their is something in the the image column in the database
          if it is echo out the image, if not echo out the placeholder -->
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
</arcticle>
      <div class="row">
        <!-- If the user has made any post show them here -->
        <?php foreach ($posts as $post): ?>
          <div  class="posts col-12 col-md-12">
            <div class="title"><?php echo $post['title'] ;?></div>
            <a target="_blank" href=" <?php echo $post['link_url'] ;?> "><?php echo $post['link_url']; ?></a>
            <div class="description"> <?php echo $post['description'] ;?></div>
            <?php if ($post['user_id'] == $_SESSION['user']['user_id']): ?>
              <form action="editpost.php" method="post">
               <input type="hidden" name="post_id" value="<?php echo $post['post_id']; ?>">
               <a href="editpost.php"><button type="submit" class="btn btn-info">Edit/Delete</button></a>
           </form>
          <?php endif; ?>
          </div>
        <?php endforeach ; ?>
      </div>


<?php require __DIR__.'/views/footer.php'; ?>
