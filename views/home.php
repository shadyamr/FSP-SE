<!DOCTYPE html>
<html>

<?php require_once APP_ROOT . '/views/html/header.php'; ?>
<?php use App\Models\User; ?>

<body class="text-center">
    <main>
        <h2><?php echo SITE_NAME . " BETA"; ?></h2>
        <h5>Welcome, <?php echo $_SESSION['login'];?>!</h5>
        <a href="logout"><button class="btn btn-danger">Logout</button></a>
    </main>
</body>

</html>