<?php require __DIR__.'/views/header.php'; ?>

<article>


<?php if (isset($_SESSION['user'])): ?>
    <p>Welcome, <?php echo $_SESSION['user']['username']; ?>!</p>
    <p>Here you can post links</p>
<?php endif; ?>
</article>

<article>
    <form action="app/posts/store.php" method="post">
        <div class="form-group">
            <label for="title">Title</label>
            <input class="form-control" type="text" name="title" placeholder="Amazing video" required>
            <small class="form-text text-muted">Please provide a title for your link.</small>
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="link">Link</label>
            <input class="form-control" type="link" name="link" placeholder="https://www.youtube.com/watch?v=yEvRZWP4P-w" required>
            <small class="form-text text-muted">Please provide a adress for your link</small>
        </div><!-- /form-group -->
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" type="text" name="description" placeholder="It´s a music video"></textarea>
            <small class="form-text text-muted">Please provide a description for your link.</small>
        </div>

        <button type="submit" class="btn btn-primary">Post</button>
    </form>
</article>

<?php require __DIR__.'/views/footer.php'; ?>
