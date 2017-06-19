<?php include ROOT ."/src/Views/layouts/header.php"; ?>
    <h3 class="text-center">Account Kit Information</h3>

    <div>User ID: <?=$_SESSION['fb']['user_id']; ?></div>
    <div>Phone Number: <?=$phone; ?></div>
    <div>Email: <?=$email; ?></div>
    <div>Access Token: <?=$_SESSION['fb']['access_token']; ?></div>
    <div>Refresh Interval: <?=$_SESSION['fb']['refresh_interval']; ?></div>

<?php include ROOT ."/src/Views/layouts/footer.php"; ?>