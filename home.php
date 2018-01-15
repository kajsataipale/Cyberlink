<?php require __DIR__.'/views/header.php';

$fetchingUser = $pdo->prepare("SELECT * from users NATURAL JOIN posts WHERE user_id=user_id ORDER BY post_id=post_id DESC");


// if (!$statement) {
//  die(var_dump($pdo->errorInfo()));
// }

// $user = $_SESSION['user']['user_id'];
// $postID = $_POST['post_id'];



// $statement->bindParam(':user_id', $user, PDO::PARAM_INT);
// $statement->bindParam(':post_id', $postID, FILTER_SANITIZE_NUMBER_INT);


//("SELECT posts.*, users.*, (SELECT sum(direction) FROM votes WHERE posts.post_id=votes.post_id) AS sum FROM posts JOIN votes ON posts.post_id=votes.post_id JOIN users ON posts.user_id=users.user_id GROUP BY posts.post_id ORDER BY post_id DESC");

if (!$fetchingUser) {
    die(var_dump($pdo->errorInfo()));
}
// $statement->execute();
// $votes = $statement->fetchAll(PDO::FETCH_ASSOC);

  $fetchingUser->execute();
  $posts = $fetchingUser->fetchAll(PDO::FETCH_ASSOC);


?>
<div class="home row">
  <article class="makepost col-4">
    <?php if (isset($_SESSION['user'])): ?>
        <p>Welcome, <?php echo $_SESSION['user']['username']; ?>!</p>
            <p><?php echo $config['here'].' '. $config['posts']?><p/>
        <a href="/postlinks.php"><button type="submit" class="btn btn-info">Create your own link</button></a>
    <?php endif; ?>
  </article>
  <article class="row">
    <?php foreach ($posts as $post): ?>
      <?php
      $statement = $pdo->prepare('SELECT sum(direction) AS direction from votes  WHERE post_id=:post_id');
      $statement->bindParam(':post_id', $post['post_id']);
      $statement->execute();
      $vote = $statement->fetch(PDO::FETCH_ASSOC);
      ?>
      <div  class="posts col-8">
      <div class="votediv">
        <form action="app/posts/vote.php" method="post">
        <input type="hidden" name="post_id" value="<?php echo $post['post_id']; ?>">
        <input type="submit" name="up" class="votes up" data-vote="1" value="1" src="images/voteup.png">
<?php if(!empty($vote['direction'])):?>
    <?php echo $vote['direction'];?>
  <?php else: echo "0";?>
  <?php endif; ?>

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
</div>

<?php require __DIR__.'/views/footer.php'; ?>
