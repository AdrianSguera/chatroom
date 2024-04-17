<?php
// Incluir el archivo que contiene la lógica del servidor WebSocket
/*require 'templates/socket.php';

// Iniciar el servidor WebSocket (si aún no está en funcionamiento)
$pidFile = 'socket.pid';
if (!file_exists($pidFile)) {
    $dir = __DIR__;
    $socketFile = $dir . '/socket.php';
    $cmd = "start /B php -q $socketFile";
    exec($cmd, $output);
    file_put_contents($pidFile, $output[0]);
}*/
include("templates/connection.php");
session_start();
if (isset($_POST["username"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    if (login($username, $password)) {
        $_SESSION['username'] = $username;
        header('Location: templates/chat.php');
        exit;
    } else {
        $error = 'Incorrect username or password';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ChatRoom</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <section class="vh-100 gradient-custom">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-dark text-white" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">

                            <div class="mb-md-5 mt-md-4 pb-5">

                                <h2 class="fw-bold mb-2 text-uppercase">Welcome</h2>
                                <p class="text-white-50 mb-5">Please enter your username and password!</p>
                            <form action="" method="post">
                                <div data-mdb-input-init class="form-outline form-white mb-4">
                                    <input type="text" name="username" id="typeEmailX" class="form-control form-control-lg" />
                                    <label class="form-label" for="typeEmailX">Username</label>
                                </div>

                                <div data-mdb-input-init class="form-outline form-white mb-4">
                                    <input type="password" name="password" id="typePasswordX" class="form-control form-control-lg" />
                                    <label class="form-label" for="typePasswordX">Password</label>
                                </div>

                                <p class="small mb-5 pb-lg-2"><a class="text-white-50" href="#!">Forgot password?</a></p>

                                <button data-mdb-button-init data-mdb-ripple-init class="btn btn-outline-light btn-lg px-5" type="submit">Login</button>
                            </form>
                                <?php
                                if (isset($error)) {
                                    echo '<p style="color: red;">'.$error.'</p>';
                                }
                                ?>
                            </div>

                            <div>
                                <p class="mb-0">Don't have an account? <a href="templates/register.php" class="text-white-50 fw-bold">Sign Up</a>
                                </p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>