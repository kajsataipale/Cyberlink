<?php require __DIR__.'/views/header.php'; ?>
<article>

    <?php if (isset($_SESSION['user'])): ?>
        <h1>Welcome, <?php echo $_SESSION['user']['username']; ?>!</h1>
    <?php endif; ?>
    <p>This is the account page.</p>
    <p>Here you can edit your profile and upload a profile picture</p>
</article>
<article>


    <form action="app/auth/edit.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="email">Username</label>
            <input class="form-control" type="name" name="username" value="<?php echo $_SESSION['user']['username']; ?>">
            <small class="form-text text-muted">Please provide a user name</small>
        </div><!-- /form-group -->
        <div class="form-group">
            <label for="email">Email</label>
            <input class="form-control" type="email" name="email" value="<?php echo $_SESSION['user']['email']; ?>">
            <small class="form-text text-muted">Please provide your email address.</small>
        </div>
        <div class="form-group">
            <label for="email">Biography</label>
            <textarea class="form-control" type="text" name="biography"  ><?php echo $_SESSION['user']['biography']; ?></textarea>
            <small class="form-text text-muted">Please provide your biography</small>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input class="form-control" type="password" name="password" value="<?php echo $_SESSION['user']['password']; ?>">
            <small class="form-text text-muted">Please provide the your password (passphrase).</small>
        </div><!-- /form-group -->
        <!-- <div class="form-group">
        <label for="avatar">Choose a PNG image to upload</label>
        <input type="file" name="avatar" accept=".png" required>
        </div> -->
        <button type="submit" class="btn btn-primary">Save changes</button>
    </form>
</article>


<?php require __DIR__.'/views/footer.php'; ?>
