<?php require __DIR__.'/views/header.php'; ?>
<article>
    <h1><?php echo $config['title']; ?></h1>
    <?php if (isset($_SESSION['user'])): ?>
      <p>Welcome, <?php echo $_SESSION['user']['name']; ?>!</p>
    <?php endif; ?>
    <p>This is the account page.</p>
    <p>Here you can edit your profile and upload a profile picture</p>
</article>



<?php require __DIR__.'/views/footer.php'; ?>
