<?php require __DIR__.'/views/header.php'; ?>
<article>

    <?php if (isset($_SESSION['user'])): ?>
        <h1><?php echo $_SESSION['user']['username']; ?></h1>
    <?php endif; ?>
    <p>This is the account page.</p>
    <p>Here you can edit your profile and upload a profile picture</p>
</article>
  <!-- The form send the information inserted to the edit.php page -->
<article>
  <?php if(isset($_SESSION['error'])):?>
    <div class="alert alert-danger" role="alert">
      <?php echo $_SESSION['error']; ?>
    </div>
    <?php unset($_SESSION['error']) ;?>
  <?php endif ;?>
    <form action="app/auth/edit.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="email">Username</label>
            <input class="form-control" type="name" name="username" value="<?php echo $_SESSION['user']['username']; ?>">
            <small class="form-text text-muted">Please provide a user name</small>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input class="form-control" type="email" name="email" value="<?php echo $_SESSION['user']['email']; ?>">
            <small class="form-text text-muted">Please provide your email address.</small>
        </div>
        <div class="form-group">
            <label for="email">Biography</label>
            <textarea class="form-control" type="text" name="biography"><?php echo $_SESSION['user']['biography']; ?></textarea>
            <small class="form-text text-muted">Please provide your biography</small>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input class="form-control" type="password" name="password">
            <small class="form-text text-muted">Please provide your new password (passphrase).</small>
        </div>
        <button type="submit" class="btn btn-info">Save changes</button>
    </form>
</article>


<?php require __DIR__.'/views/footer.php'; ?>
