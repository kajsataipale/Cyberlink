<?php require __DIR__.'/views/header.php'; ?>

<article>
    <h1>Register</h1>
    <p>New member? Here´s were you fill in your information</p>
</article>

<article>


    <form action="app/auth/login.php" method="post">
        <div class="form-group">
            <label for="email">User name</label>
            <input class="form-control" type="name" name="username" placeholder="francisdarjeeling" required>
            <small class="form-text text-muted">Please provide a user name</small>
        </div><!-- /form-group -->
        <div class="form-group">
            <label for="email">Email</label>
            <input class="form-control" type="email" name="email" placeholder="francis@darjeeling.com" required>
            <small class="form-text text-muted">Please provide your email address.</small>
        </div>
        <div class="form-group">
            <label for="email">Biography</label>
            <textarea class="form-control" type="bio" name="bio" placeholder="I´m a student and I like baseboll.." required></textarea>
            <small class="form-text text-muted">Please provide your biography</small>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input class="form-control" type="password" name="password" required>
            <small class="form-text text-muted">Please provide the your password (passphrase).</small>
        </div><!-- /form-group -->

        <button type="submit" class="btn btn-primary">Submitt</button>
    </form>
</article>
<?php require __DIR__.'/views/footer.php'; ?>
