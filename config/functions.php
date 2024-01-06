<?php
// koneksi
$conn = new mysqli("localhost", "root", "", "rental_mobil") or die(mysqli_error($conn));

// fungsi base_url
function base_url($url = null)
{
  $base_url = "http://localhost/rental-mobil-php-native/";
  if($url != null) {
    return $base_url . $url;
  } else {
    return $base_url;
  }
}

function register($data)
{
  global $conn;
  $nama = htmlspecialchars(strtolower($data['nama']));
  $username = htmlspecialchars(strtolower($data['username']));
  $password1 = $conn->real_escape_string($data['password1']);
  $password2 = $conn->real_escape_string($data['password2']);
  $jk = htmlspecialchars(strtolower($data['jk']));

  if($password1 != $password2) {
    echo "<script>alert('Konfirmasi password tidak sama!');window.location='register.php';</script>";
    return false;
  }

  if(empty($nama && $username && $password1 && $password2 && $jk)) {
    echo "<script>alert('Inputan tidak boleh kosong!');window.location='register.php';</script>";
    return false;
  }

  $password_hash = password_hash($password1, PASSWORD_DEFAULT);
  $query = $conn->query("INSERT INTO tb_user VALUES(null, '$nama', '$username', '$password_hash', '$jk', '2' )");
  return $conn->affected_rows;
}



// ------------------ADMIN-------------------------


function tambahuser($data)
{
  global $conn;
  $nama = htmlspecialchars(strtolower($data['nama']));
  $username = htmlspecialchars(strtolower($data['username']));
  $password = $conn->real_escape_string($data['password']);
  $jk = htmlspecialchars(strtolower($data['jk']));

  if(empty($nama && $username && $password && $jk)) {
    echo "<script>alert('Inputan tidak boleh kosong!');window.location='?p=user';</script>";
    return false;
  }

  $password_hash = password_hash($password, PASSWORD_DEFAULT);
  $query = $conn->query("INSERT INTO tb_user VALUES(null, '$nama', '$username', '$password_hash', '$jk', '2' )");
  return $conn->affected_rows;
}

function ubahuser($data)
{
  global $conn;
  $id_user = htmlspecialchars($data['id']);
  $nama = htmlspecialchars(strtolower($data['nama']));
  $username = htmlspecialchars(strtolower($data['username']));
  $password = $conn->real_escape_string($data['password']);
  $jk = htmlspecialchars(strtolower($data['jk']));

  // if(empty($nama && $username && $password && $jk)) {
  //   echo "<script>alert('Inputan tidak boleh kosong!');window.location='?p=user';</script>";
  //   return false;
  // }

  $password_hash = password_hash($password, PASSWORD_DEFAULT);
  $query = $conn->query("UPDATE tb_user SET nama_user = '$nama', username = '$username', password = '$password_hash', jk_user = '$jk', level = '2' WHERE id_user = $id_user ") or die(mysqli_error($conn));
  return $conn->affected_rows;
}



// -------------------MOBIL-----------------------

function tambahmobil($data)
{
  global $conn;
  $polisi = htmlspecialchars($data['polisi']);
  $merk = htmlspecialchars($data['merk']);
  $tahun = htmlspecialchars($data['tahun']);
  $hrg_mobil = htmlspecialchars($data['hrg_mobil']);

  if(empty($polisi && $merk && $tahun && $hrg_mobil)) {
    echo "<script>alert('Inputan tidak boleh kosong!');window.location='?p=mobil';</script>";
    return false;
  }

  $sqlMobil = $conn->query("INSERT INTO tb_mobil VALUES (null, '$polisi', '$merk', '$tahun', '$hrg_mobil', 'Aktif')") or die(mysqli_error($conn));
  return $conn->affected_rows;
}

function ubahmobil($data)
{
  global $conn;
  $id_mobil = htmlspecialchars($data['id']);
  $polisi = htmlspecialchars($data['polisi']);
  $merk = htmlspecialchars($data['merk']);
  $tahun = htmlspecialchars($data['tahun']);
  $hrg_mobil = htmlspecialchars($data['hrg_mobil']);

  if(empty($polisi && $merk && $tahun && $hrg_mobil)) {
    echo "<script>alert('Inputan tidak boleh kosong!');window.location='?p=mobil';</script>";
    return false;
  }

  $sqlMobil = $conn->query("UPDATE tb_mobil SET no_polisi = '$polisi', merk = '$merk', tahun = '$tahun', hrg_mobil = '$hrg_mobil' WHERE id_mobil = $id_mobil") or die(mysqli_error($conn));
  return $conn->affected_rows;
}


// -----------------ORDER---------------------

function tambahorder($data)
{
  global $conn;
  $id_user = htmlspecialchars($data['id_user']);
  $no_polisi = htmlspecialchars($data['polisi']);
  $ktp = htmlspecialchars($data['ktp']);
  $nama = htmlspecialchars($data['nama']);
  $jk_order = htmlspecialchars($data['jk_order']);
  $alamat = htmlspecialchars($data['alamat']);
  $tujuan = htmlspecialchars($data['tujuan']);
  $telp = htmlspecialchars($data['telp']);
  $tglP = htmlspecialchars($data['tgl_pinjam']);
  $tglK = htmlspecialchars($data['tgl_kembali']);
  $tgl_pinjam = new DateTime($data['tgl_pinjam']);
  $tgl_kembali = new DateTime($data['tgl_kembali']);

  // menghitung selisih peminjam hari
  $selisihHari = $tgl_kembali->diff($tgl_pinjam);
  $x = $selisihHari->d;
  // echo $x;

  // total harga
  $cariHarga = $conn->query("SELECT * FROM tb_mobil WHERE id_mobil = '$no_polisi'") or die(mysqli_error($conn));
  $data = $cariHarga->fetch_assoc();
  $harga = $x * $data['hrg_mobil'];

  $sql = $conn->query("INSERT INTO tb_order VALUES (null, '$no_polisi', '$id_user', '$nama', '$ktp', '$jk_order', '$alamat', '$telp', '$tujuan', '$tglP', '$tglK', '$x', '$harga', 'Pinjam') ") or die(mysqli_error($conn));
  $conn->query("UPDATE tb_mobil SET status_mobil = 'Sewa' WHERE id_mobil = $no_polisi") or die(mysqli_error($conn));
  return $conn->affected_rows;
}

function kembalimobil()
{
  global $conn;
  $id_order = htmlspecialchars($_POST['id_order']);
  $conn->query("UPDATE tb_mobil SET status_mobil = 'Aktif'") or die(mysqli_error($conn));
  $conn->query("DELETE FROM tb_order WHERE id_order = $id_order") or die(mysqli_error($conn));
  return $conn->affected_rows;
}