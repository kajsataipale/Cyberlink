<?php require __DIR__.'/views/header.php'; ?>

<article>
    <h1>Login</h1>
    <!-- The form sends the inserted information to the login.php page. -->
    <?php if(isset($_SESSION['error'])):?>
      <div class="alert alert-danger" role="alert">
        <?php echo $_SESSION['error']; ?>
      </div>
      <?php unset($_SESSION['error']) ;?>
    <?php endif ;?>
    <!-- Check to see if the $_SESSION['error'] is set, if it is echo it out  -->
    <form action="app/auth/login.php" method="post">
        <div class="form-group">
            <label for="email">Email or Username</label>
            <input class="form-control" type="text" name="email" placeholder="francis@darjeeling.com">
            <small class="form-text text-muted">Please provide your email address.</small>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input class="form-control" type="password" name="password" required>
            <small class="form-text text-muted">Please provide a password (passphrase).</small>
        </div>
        <button type="submit" class="btn btn-info">Login</button>
    </form>
</article>
<?php require __DIR__.'/views/footer.php'; ?>
