<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

if (isset($_POST['email'], $_POST['password'])) {
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $username = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
}
redirect('/../../account.php');
