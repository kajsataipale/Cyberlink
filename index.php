<?php require __DIR__.'/views/header.php'; ?>

<article>
  <h1><?php echo $config['title']; ?></h1>
    <p> Welcome to Cyberlink! </p>
    <p><?php echo $config['here'].' '. $config['posts']?><p/>
  <h3>New <?php echo $config['member'] ?>?</h3>
    <a href="/register.php" ><button type="submit" class="btn btn-info">Create Account</button></a>
  <h3>Already a <?php echo $config['member'] ?>?</h3>
    <a href="/login.php" ><button type="submit" class="btn btn-info">Login</button></a>
</article>
<?php require __DIR__.'/views/footer.php'; ?>
