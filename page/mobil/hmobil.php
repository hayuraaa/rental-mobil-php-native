<?php
// cek jika ada level 2 yang ingin mengakses level 1, akan di redirect ke halaman index utamanya.
if($_SESSION['level'] == 1) { 
$id_mobil = $_GET['id'];

$query = $conn->query("DELETE FROM tb_mobil WHERE id_mobil = $id_mobil") or die(mysqli_error($conn));
if($query) {
	echo "<script>alert('Data Mobil Berhasil dihapus.');window.location='?p=mobil';</script>";
} else {
	echo "<script>alert('Data Mobil Gagal dihapus.');window.location='?p=mobil';</script>";
}

} else {
	header("Location: index.php");
	exit;
} 

?>