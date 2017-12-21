<?php require __DIR__.'/views/header.php';

$statement = $pdo->prepare("SELECT * from users NATURAL JOIN posts WHERE user_id=user_id ORDER BY post_id DESC");

  $statement->execute();
  $posts = $statement->fetchAll(PDO::FETCH_ASSOC);



  $statement = $pdo->prepare('SELECT * from votes WHERE post_id=:post_id');
  if (!$statement) {
   die(var_dump($pdo->errorInfo()));
  }
  $statement->bindParam(':post_id', $_POST['post_id'], FILTER_SANITIZE_NUMBER_INT);
  $statement->execute();

  $votes = $statement->fetchAll(PDO::FETCH_ASSOC);

?>

<?php if (isset($_SESSION['user'])): ?>
    <p>Welcome, <?php echo $_SESSION['user']['username']; ?>!</p>
        <p><?php echo $config['here'].' '. $config['posts']?><p/>
    <a href="/postlinks.php"><button type="submit" class="btn btn-info">Create your own link</button></a>
<?php endif; ?>

  <article>
    <?php foreach ($posts as $post): ?>
      <div  class="posts">
      <div class="votediv">
        <form action="app/posts/vote.php" method="post">
        <input type="hidden" name="post_id" value="<?php echo $post['post_id']; ?>">
        <input type="submit" name="up" class="votes up" data-vote="1" value="1" src="images/voteup.png">
        <?php foreach ($votes as $vote): ?>
        <?php echo $vote['direction'];?>
        <?php endforeach ; ?>
        <input type="submit" name="down" class="votes down" data-vote="-1" value="-1" src="images/votedown.png">
      </form>
      </div>
            <div class="title"> <?php echo "Author: ". $post['username'] ;?></div>
            <div class="title"><?php echo $post['title'] ;?></div>
             <a target="_blank" href=" <?php echo $post['link_url'] ;?> "><?php echo $post['link_url']; ?></a>
            <div class="description"> <?php echo $post['description'] ;?></div>
            <br>

            <?php if ($post['user_id'] == $_SESSION['user']['user_id']): ?>
              <form action="editpost.php" method="post">
               <input type="hidden" name="post_id" value="<?php echo $post['post_id']; ?>">
               <a href="editpost.php"><button type="submit" class="btn btn-info">Edit/Delete</button></a>
           </form>
          <?php endif; ?>
        </div>
    <?php endforeach ; ?>
  </article>


<?php require __DIR__.'/views/footer.php'; ?>
