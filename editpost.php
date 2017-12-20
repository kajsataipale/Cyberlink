<?php
require __DIR__.'/views/header.php';

if (isset($_POST['post_id'])) {
  $PostId = filter_var($_POST['post_id'], FILTER_SANITIZE_NUMBER_INT);

$statement = $pdo->prepare("SELECT * from posts NATURAL JOIN users WHERE post_id=:post_id AND user_id=:user_id");
if (!$statement) {
  die(var_dump($pdo->errorInfo()));
}

$statement->bindParam(':post_id', $PostId, PDO::PARAM_INT);
$statement->bindParam(':user_id', $_SESSION['user']['user_id'], PDO::PARAM_INT);
  $statement->execute();
  $post = $statement->fetch(PDO::FETCH_ASSOC);
}

$statement = $pdo->prepare("SELECT * from posts WHERE post_id=:post_id");
if (!$statement) {
  die(var_dump($pdo->errorInfo()));
}

$statement->bindParam(':post_id', $PostId, PDO::PARAM_INT);

  $statement->execute();
  $post = $statement->fetch(PDO::FETCH_ASSOC);
   ?>

<article>


    <form action="app/posts/update.php" method="post">
      <input type="hidden" name="post_id" value="<?php echo $post['post_id']; ?>">

        <div class="form-group">
            <!-- <label for="email">Username</label> -->
          <p><?php echo $_SESSION['user']['username']; ?></p>

        </div><!-- /form-group -->
        <div class="form-group">
            <label for="email">Title</label>
            <input class="form-control" type="text" name="title" value="<?php echo $post['title'] ;?>">
            <small class="form-text text-muted">Please provide a title to your link</small>
        </div>
        <div class="form-group">
            <label for="email">Link</label>
            <input class="form-control" type="text" name="link_url" value="<?php echo $post['link_url'] ;?>">
            <small class="form-text text-muted">Please provide a link adress</small>
        </div>
        <div class="form-group">
            <label for="email">Description</label>
            <input class="form-control" type="text" name="description" value="<?php echo $post['description'] ;?>">
            <small class="form-text text-muted">Please provide a link adress</small>
        </div>


        <button type="submit" class="btn btn-primary">Save changes</button>
    </form>


    <form action="app/posts/delete.php" method="post">
             <input type="hidden" name="post_id" value="<?php echo $post['post_id']; ?>">
             <button type="submit" class="btn btn-danger">Delete</button>
         </form>
</article>
<?php require __DIR__.'/views/footer.php'; ?>
