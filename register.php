<?php require __DIR__.'/views/header.php'; ?>

<article>
    <h1>Register</h1>
    <p>Here´s were you fill in your information</p>
</article>

<article>
  <!-- The form sends the inserted information to the add.php page -->
    <?php if(isset($_SESSION['error'])):?>
      <div class="alert alert-danger" role="alert">
        <?php echo $_SESSION['error']; ?>
      </div>
      <?php unset($_SESSION['error']) ;?>
    <?php endif ;?>
    <form action="app/auth/add.php" method="post">
        <div class="form-group">
            <label for="email">User name</label>
            <input class="form-control" type="name" name="username" placeholder="francisdarjeeling" required>
            <small class="form-text text-muted">Please provide a user name</small>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input class="form-control" type="email" name="email" placeholder="francis@darjeeling.com" required>
            <small class="form-text text-muted">Please provide your email address.</small>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input class="form-control" type="password" name="password" required>
            <small class="form-text text-muted">Please provide the your password (passphrase).</small>
        </div>
        <button type="submit" class="btn btn-info">Submit</button>
    </form>
</article>
<?php require __DIR__.'/views/footer.php'; ?>
