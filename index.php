<?php require __DIR__.'/views/header.php'; ?>

<article class="row">
  <div class="col-4 .col-md-4">
  <h1><?php echo $config['title']; ?></h1>
    <p> Welcome to <?php echo $config['title']; ?></p>
    <p><p/>
    </div>
    <div class="col-4 col-md-4">
  <h3>New member?</h3>
    <a href="/register.php" ><button type="submit" class="btn btn-info">Create Account</button></a>
  </div>
    <div class="col-4 .col-md-4">
  <h3>Already a member?</h3>
    <a href="/login.php" ><button type="submit" class="btn btn-info">Login</button></a>
  </div>
</article>
<?php require __DIR__.'/views/footer.php'; ?>
