<?php require __DIR__.'/views/header.php';

$statement = $pdo->prepare("SELECT * from users NATURAL JOIN posts WHERE user_id=user_id ORDER BY post_id DESC");

  $statement->execute();
  $posts = $statement->fetchAll(PDO::FETCH_ASSOC);



  $statement = $pdo->prepare('SELECT * from votes WHERE user_id=:user_id AND post_id=:post_id');
  if (!$statement) {
   die(var_dump($pdo->errorInfo()));
  }

  $statement->bindParam(':user_id', $_SESSION['user']['user_id'], PDO::PARAM_INT);
  $statement->bindParam(':post_id', $_POST['post_id'], FILTER_SANITIZE_NUMBER_INT);
  $statement->execute();

  $votes = $statement->fetchAll(PDO::FETCH_ASSOC);

?>

<?php if (isset($_SESSION['user'])): ?>
    <p>Welcome, <?php echo $_SESSION['user']['username']; ?>!</p>
    <p>Here you can see all posts and vote up or down on links</p>
<?php endif; ?>

<a href="/postlinks.php"><button type="submit" class="btn btn-primary">Create your own link</button></a>
  <article>
    <?php foreach ($posts as $post): ?>
      <div class="votediv">
        <form action="app/posts/vote.php" method="post">
        <input type="hidden" name="post_id" value="<?php echo $post['post_id']; ?>">
        <input type="submit" name="up" class="up" data-vote="1" value="1" src="images/voteup.png">
        <?php foreach ($votes as $vote): ?>
        <?php echo $vote['direction'];?>
        <?php endforeach ; ?>
        <input type="submit" name="down" class="votes down" data-vote="-1" value="-1" src="images/votedown.png">
      </form>
      </div>
      <div>
            <div class="title"> <?php echo "Author: ". $post['username'] ;?></div>
            <div class="title"><?php echo $post['title'] ;?></div>
             <a target="_blank" href=" <?php echo $post['link_url'] ;?> "><?php echo $post['link_url']; ?></a>
            <div class="description"> <?php echo $post['description'] ;?></div>
            <br>
      </div>

            <?php if ($post['user_id'] == $_SESSION['user']['user_id']): ?>
              <form action="editpost.php" method="post">
               <input type="hidden" name="post_id" value="<?php echo $post['post_id']; ?>">
               <a href="editpost.php"><button type="submit" class="btn btn-primary">Edit/Delete</button></a>
           </form>
          <?php endif; ?>
    <?php endforeach ; ?>
  </article>


<?php require __DIR__.'/views/footer.php'; ?>
