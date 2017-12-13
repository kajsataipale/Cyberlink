<?php require __DIR__.'/views/header.php'; ?>

<?php if (isset($_SESSION['user'])): ?>
    <p>Welcome, <?php echo $_SESSION['user']['name']; ?>!</p>
    <p>Here you can vote up or down links</p>
<?php endif; ?>

<a href="/postlinks.php"><button type="submit" class="btn btn-primary">Create your own link</button></a>

<?php require __DIR__.'/views/footer.php'; ?>
