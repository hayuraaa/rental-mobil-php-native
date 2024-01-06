<?php
session_start();
require_once 'config/functions.php';

if(isset($_SESSION['id_user'])) {
  header("Location: index.php");
  exit;
}

// konfir cookie
if(isset($_COOKIE['id_user']) && isset($_COOKIE['key'])) {
  $idUser = $_COOKIE['id_user'];
  $key = $_COOKIE['key'];

  // cek apakah sama username yang di input dengan di DB ?
  $result = $conn->query("SELECT username FROM tb_user WHERE id_user = '$idUser'") or die(mysqli_error($conn));
  $row = $result->fetch_assoc();
  if($key === hash('sha256', $row['username'])) {
    $_SESSION['level'] = $row['level'];
    $_SESSION['nama'] = $row['nama_user'];
    $_SESSION['id_user'] = $row['id_user'];
  }
}

if(isset($_POST['masuk'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  // cek apakah username ada di DB ??
      $result = $conn->query("SELECT * FROM tb_user WHERE username = '$username'") or die(mysqli_error($conn));
      if($result->num_rows >= 1) {
        $row = $result->fetch_assoc();
    if(password_verify($password, $row['password'])) {
      $_SESSION['level'] = $row['level'];
      $_SESSION['nama'] = $row['nama_user'];
      $_SESSION['id_user'] = $row['id_user'];

      // set cookie
      if(isset($_POST['remember'])) {
        setcookie('id_user', $row['id_user'], time() + 60);
        setcookie('key', hash('sha256', $row['username']), time() + 60);
      }

      header("Location: index.php");
      exit;
    }
  }
  $error = true;

  // jika akun belum terdaftar
  if($result->num_rows === 0) {
    echo "<script>alert('Akun belum terdaftar.');window.location='register.php';</script>";
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
    <title>Halaman Login</title>
    <link href="<?= base_url(); ?>css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
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
                                <br><center><p>Silahkan Masukkan Data</p></center>
                                
                                <div class="card-body">
                                <?php if(isset($error)) : ?>
                                  <div class="alert alert-danger" role="alert">
                                    Password anda salah!.
                                  </div>
                                <?php endif; ?>
                                    <form action="" method="post">
                                        <div class="form-group">
                                            <label class="small mb-1" for="username">Username</label>
                                            <input class="form-control py-4" id="username" name="username" type="text" required placeholder="Masukan username anda" />
                                        </div>
                                        <div class="form-group">
                                            <label class="small mb-1" for="password">Password</label>
                                            <input class="form-control py-4" id="password" name="password" required type="password" placeholder="Masukan password" />
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input" id="remember" name="remember" type="checkbox" />
                                                <label class="custom-control-label" for="remember">Remember password</label>
                                            </div>
                                        </div>
                                </div>
                                <div class="card-footer text-right">
                                    <div class="small">
                                         <p> Belum punya akun?
                                        <a href="register.php">Daftar Disini</a>
                                      <button type="submit" name="masuk" class="btn btn-primary">Masuk</button>

                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <div id="layoutAuthentication_footer">
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Haris (08137774784) &copy; Your Website 2022</div>
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
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="<?= base_url(); ?>js/scripts.js"></script>
</body>
</html>
