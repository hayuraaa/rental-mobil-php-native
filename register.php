<?php 
require_once 'config/functions.php'; 

if(isset($_POST['buat'])) {
  if(register($_POST) > 0) {
    echo "<script>alert('Akun berhasil di buat, silahkan login');window.location='login.php';</script>";
  } else {
    echo "<script>alert('Akun gagal di buat!');window.location='register.php';</script>";
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
    <title>Registrasi Akun User</title>
    <link href="<?= base_url(); ?>css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
</head>
<body class="bg-primary">
    <div id="layoutAuthentication">
      <div id="layoutAuthentication_content">
          <main>
              <div class="container">
                  <div class="row justify-content-center">
                      <div class="col-lg-7">
                          <div class="card shadow-lg border-0 rounded-lg mt-5">
                              <div class="card-header"><h3 class="text-center font-weight-light my-4">Buat Akun</h3></div>
                              <div class="card-body">
                                  <form action="" method="post">
                                      <div class="form-group">
                                        <label class="small mb-1" for="nama">Nama Lengkap</label>
                                        <input class="form-control py-4" id="nama" name="nama" type="text" placeholder="Masukan nama" required />
                                      </div>
                                      <div class="form-group">
                                          <label class="small mb-1" for="username">Username</label>
                                          <input class="form-control py-4" id="username" name="username" type="text" placeholder="Masukan username" required />
                                      </div>
                                      <div class="form-row">
                                          <div class="col-md-6">
                                              <div class="form-group">
                                                  <label class="small mb-1" for="password1">Password</label>
                                                  <input class="form-control py-4" name="password1" id="password1" type="password" placeholder="Masukan password" required />
                                              </div>
                                          </div>
                                          <div class="col-md-6">
                                              <div class="form-group">
                                                  <label class="small mb-1" for="password2">Konfirmasi Password</label>
                                                  <input class="form-control py-4" name="password2" id="password2" type="password" placeholder="Confirm password" required />
                                              </div>
                                          </div>
                                      </div>
                                      <div class="form-group">
                                      <div class="form-check">
                                        <input class="form-check-input" type="radio" name="jk" id="jk" value="L">
                                        <label class="form-check-label" for="jk">
                                          Pria
                                        </label>
                                      </div>
                                      <div class="form-check">
                                        <input class="form-check-input" type="radio" name="jk" id="jk" value="P">
                                        <label class="form-check-label" for="jk">
                                          Perempuan
                                        </label>
                                      </div>
                                      </div>
                                      <div class="form-group mt-4 mb-0">
                                        <button type="submit" name="buat" class="btn btn-primary">Buat Akun</button>
                                      </div>
                                  </form>
                              </div>
                              <div class="card-footer text-center">
                                  <div class="small"><a href="login.html">Sudah punya akun? Masuk sekarang!</a></div>
                              </div>
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
                      <div class="text-muted">Copyright &copy; Your Website 2020</div>
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
