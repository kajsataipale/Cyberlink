<?php require __DIR__.'/views/header.php'; ?>
<article>

    <?php if (isset($_SESSION['user'])): ?>
        <h1>Welcome, <?php echo $_SESSION['user']['username']; ?>!</h1>
    <?php endif; ?>
    <p>This is the account page.</p>
    <p>Here you can edit your profile and upload a profile picture</p>
</article>
<article>

  <form action="/app/auth/uploadimage.php" method="post" enctype="multipart/form-data">

<div class="form-group">
  <?php  if(!isset($_SESSION['user']['picture'])): ?>
    <img src="images/placeholder.png" class="img-thumbnail" width="200px">
  <?php else : ?>
    <img src="app/imgs/<?php $_SESSION['user']['picture']?>" class="img-thumbnail" width="20%">

  <?php endif;?>

</div class="form-group">
<input type="file" name="picture">
<button type="submitt"> Upload</button>

<div>

</div>

</form>
<p><b><?php echo $_SESSION['user']['username']; ?></b></p>



<p><?php echo $_SESSION['user']['email']; ?></p>


            <label for="email"><i>Biography</i></label>
    <p><b><?php echo $_SESSION['user']['biography']; ?></b></p>

        <a href="/editaccount.php"><button type="submit" class="btn btn-primary">Edit profile</button></a>
    </form>
</article>


<?php require __DIR__.'/views/footer.php'; ?>
