<?php require __DIR__.'/views/header.php'; ?>

<article>
    <h1>Login</h1>

    <form action="app/auth/login.php" method="post">
        <div class="form-group">
            <label for="email">Email</label>
            <input class="form-control" type="email" name="email" placeholder="francis@darjeeling.com" required>
            <small class="form-text text-muted">Please provide the your email address.</small>
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="password">Password</label>
            <input class="form-control" type="password" name="password" required>
            <small class="form-text text-muted">Please provide the your password (passphrase).</small>
        </div><!-- /form-group -->

        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</article>


<article>
    <h2>New member?</h2>

        <a href="/register.php" ><button type="submit" class="btn btn-primary">Create</button></a>

</article>

<?php require __DIR__.'/views/footer.php'; ?>
