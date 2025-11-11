<?php
session_start();
require_once "includes/config.php";

if(isset($_SESSION['admin_logged_in'])) {
    header("Location: index.php");
    exit;
}

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $hashed_password = md5 ($password);
    $sql = "SELECT id_admin, username, nama_lengkap FROM admin WHERE username= ? AND password = ? ";
    if($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("ss", $username, $hashed_password);
        $stmt->execute();
        $stmt->store_result();

        if($stmt->num_rows == 1) {
            $stmt->bind_result($admin_id, $admin_username, $admin_nama_lengkap);
            $stmt->fetch();
            $_SESSION['admin_logged_in'] = true; 
            $_SESSION['admin_id'] = $admin_id;
            $_SESSION['admin_username'] = $admin_username;
            $_SESSION['admin_nama_lengkap'] = $admin_nama_lengkap; 
            header("Location: index.php");
            exit;  
        } else {
            $pesan = "Username atau password salah";

        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Login - Admin Perpustakaan</title>
        <link href="assets/css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Login</h3></div>
                                    <div class="card-body">
                                        <?php if (!empty($pesan)) : ?>
                                        <div class="alert alert-danger" role="alert">
                                            <?php echo $pesan ?>
                                        </div>
                                        <?php endif ?>
                                        <form action="login.php" method="post">
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="username" name="username" type="text" placeholder="Username"/>
                                                <label for="username">Username</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="password" name="password" type="password" placeholder="Password" />
                                                <label for="password">Password</label>
                                            </div>
                                            <div class="form-check mb-3">
                                                <input class="form-check-input" id="inputRememberPassword" type="checkbox" value="" />
                                                <label class="form-check-label" for="inputRememberPassword">Remember Password</label>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <span class="small">Forgot Password?</span>
                                                <button class="btn btn-primary" type="submit">Login</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Atmaluhur <?= date('Y') ?></div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="assets/js/scripts.js"></script>
    </body>
</html>
