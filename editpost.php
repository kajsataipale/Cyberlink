<?php
require __DIR__.'/views/header.php';

$statement = $pdo->prepare("SELECT * from users NATURAL JOIN posts WHERE user_id=user_id ORDER BY post_id DESC");
$statement->bindParam(':post_id', $postId, PDO::PARAM_INT);
$statement->bindParam(':user_id', $_SESSION['user']['user_id'], PDO::PARAM_INT);
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
            <input class="form-control" type="email" name="email" value="<?php echo $post['title'] ;?>">
            <small class="form-text text-muted">Please provide a title to your link</small>
        </div>
        <div class="form-group">
            <label for="email">Link</label>
            <input class="form-control" type="email" name="email" value="<?php echo $post['link_url'] ?>">
            <small class="form-text text-muted">Please provide a link adress</small>
        </div>
        <div class="form-group">
            <label for="email">Description</label>
            <input class="form-control" type="email" name="email" value="<?php echo $post['description'] ;?>">
            <small class="form-text text-muted">Please provide a link adress</small>
        </div>


        <button type="submit" class="btn btn-primary">Save changes</button>
    </form>
</article>
<?php require __DIR__.'/views/footer.php'; ?>
