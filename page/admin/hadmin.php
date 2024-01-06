<?php 
// cek jika ada level 2 yang ingin mengakses level 1, akan di redirect ke halaman index utamanya.
if($_SESSION['level'] == 1) {
$id_user = $_GET['id'];

$query = $conn->query("DELETE FROM tb_user WHERE id_user = $id_user") or die(mysqli_error($conn));
if($query) {
	echo "<script>alert('Data User Berhasil dihapus.');window.location='?p=user';</script>";
} else {
	echo "<script>alert('Data User Gagal dihapus.');window.location='?p=user';</script>";
}

} else {
	header("Location: index.php");
	exit;
} 

?>