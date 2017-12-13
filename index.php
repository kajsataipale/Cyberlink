<?php require __DIR__.'/views/header.php'; ?>

<article>
    <h1><?php echo $config['title']; ?></h1>
    <p>This is the home page.</p>

    <?php if (isset($_SESSION['user'])): ?>
        <p>Welcome, <?php echo $_SESSION['user']['name']; ?>!</p>
    <?php endif; ?>
</article>
<article>
  <h3>New member?</h3>

      <a href="/register.php" ><button type="submit" class="btn btn-primary">Create Account</button></a>

</article>
  <h3>Already a member?</h3>

      <a href="/login.php" ><button type="submit" class="btn btn-primary">Login</button></a>

</article>

</article>
<?php require __DIR__.'/views/footer.php'; ?>
