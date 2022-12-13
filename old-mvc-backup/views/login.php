<!DOCTYPE html>
<html>

<?php require_once APP_ROOT . '/views/html/credentials-header.php'; ?>

<body class="text-center">
    <main class="form-signin w-100 m-auto">
        <form action="login" method="POST">
            <img class="mb-4" src="public/assets/img/logo.png">
            <h1 class="h3 mb-3 fw-normal"><?php echo SITE_NAME?></h1>

            <div class="form-floating">
                <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
                <label for="username">Username</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                <label for="password">Password</label>
            </div>

            <button class="w-100 btn btn-lg btn-primary" type="submit">Login</button>
            <p class="mt-5 mb-3 text-muted">&copy; 2022</p>
        </form>
    </main>
</body>

</html>