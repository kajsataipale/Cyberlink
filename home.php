<?php require __DIR__.'/views/header.php';

?>

<?php if (isset($_SESSION['user'])): ?>
    <p>Welcome, <?php echo $_SESSION['user']['username']; ?>!</p>
    <p>Here you can vote up or down links</p>
<?php endif; ?>

<a href="/postlinks.php"><button type="submit" class="btn btn-primary">Create your own link</button></a>





<?php foreach ($posts as $post): ?>
<div>
  <img class="profilepic" src="<?php echo $post['image'] ?>.jpg">
      <div class="title"><?php echo $post['username'] ;?></div>
      <div class="title"><?php echo $post['title'] ;?></div>
      <div class="link"> <?php echo $post['link'] ;?></div>
      <div class="description"> <?php echo $post['description'] ;?></div>
</div>
<?php endforeach ; ?>



<?php require __DIR__.'/views/footer.php'; ?>
