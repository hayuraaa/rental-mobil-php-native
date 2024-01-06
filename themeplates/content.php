<h1 class="mt-4">
	<?php 
	if(isset($_GET['p'])) {
		switch ($_GET['p']) {
			case 'user':
				echo "Kelola User";
				break;
			case 'mobil':
				echo "Data Rental Mobil";
				break;
			case 'order':
				echo "Formulir Order";
				break;
			default:
			echo "Beranda";
			break;
		}
	} else {
		echo "Beranda";
	}
	?>
</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
    <li class="breadcrumb-item active">Sidenav Light</li>
</ol>







<div class="row">
	<div class="col-md">

		<?php 
		if(isset($page)) {
			switch ($page) {
				case 'user':
					require_once 'page/admin/admin.php';
					break;
				case 'huser':
					require_once 'page/admin/hadmin.php';
					break;
				case 'mobil':
					require_once 'page/mobil/mobil.php';
					break;
				case 'hmobil':
					require_once 'page/mobil/hmobil.php';
					break;
				case 'order':
					require_once 'page/order/order.php';
					break;
			}
		} else {
			require_once 'index.php';
		}

		?>
	</div>
</div>