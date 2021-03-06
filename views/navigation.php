<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <img src="../images/logaCommunity.png" class="logo">
    <?php if (isset($_SESSION['user'])): ?>
      <a class="navbar-brand community" href="/home.php"><?php echo $config['title']; ?></a>
      <?php else: ?>
        <a class="navbar-brand <?php echo $_SERVER['SCRIPT_NAME'] === '/index.php' ? 'active' : ''; ?>" href="/index.php"><?php echo $config['title']; ?></a>
      <?php endif; ?>
    <ul class="navbar-nav">
      <li class="nav-item">
          <?php if (isset($_SESSION['user'])): ?>
              <a class="nav-link" href="/account.php">Account</a>
          <?php else: ?>
              <a class="nav-link <?php echo $_SERVER['SCRIPT_NAME'] === '/register.php' ? 'active' : ''; ?>" href="/register.php">Create Account</a>
          <?php endif; ?>
      </li>
        <li class="nav-item">
            <?php if (isset($_SESSION['user'])): ?>
                <a class="nav-link" href="/app/auth/logout.php">Logout</a>
            <?php else: ?>
                <a class="nav-link <?php echo $_SERVER['SCRIPT_NAME'] === '/login.php' ? 'active' : ''; ?>" href="login.php">Login</a>
            <?php endif; ?>
        </li>

    </ul>
</nav>
