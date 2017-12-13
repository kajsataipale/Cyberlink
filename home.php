<?php require __DIR__.'/views/header.php'; ?>

<?php if (isset($_SESSION['user'])): ?>
    <p>Welcome, <?php echo $_SESSION['user']['name']; ?>!</p>
<?php endif; ?>
<?php require __DIR__.'/views/footer.php'; ?>
