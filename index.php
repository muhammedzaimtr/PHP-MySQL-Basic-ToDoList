<?php include 'init.php'; ?>
<!DOCTYPE html>
<html lang="tr">
<head>
	<meta charset="UTF-8">
	<meta name="keywords" content="">
	<meta name="description" content="">
	<meta property="og:title" content="" />
	<meta property="og:url" content="" />
	<meta property="og:image" content="" />
	<meta content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" name="viewport">
	<title>PHP ToDoList</title>
	<link rel="stylesheet" href="assets/css/zerocss.css">
	<link rel="stylesheet" href="assets/css/zerogrid.css">
	<link rel="stylesheet" href="assets/fonts/font-awesome.css">
	<link rel="stylesheet" href="assets/css/main.css">
	<link rel="stylesheet" href="assets/css/sweetalert.css">
</head>
<body>

	<?php

	if ($_GET) {
		$sil = trim(strip_tags($_GET["sil"]));
		if (!$sil == "" ) {
			$siler = $db->prepare("delete from notes where note_no=?");
			$siler->execute([$sil]);
			if ($siler) {
				?>
					<script type="text/javascript">
					swal({
									title: "Başarılı Bir Şekilde Paylaşıldı...",
									type: "success",
									timer: 2000,
									showConfirmButton: false
							},
							function(){
									window.location.reload(true);
							});
					</script>
				<?php
			}else{
				?>
					<script type="text/javascript">
					swal({
									title: "Maalesef işlemi gerçekleştiremiyoruz...",
									type: "warning",
									timer: 2000,
									showConfirmButton: false
							},
							function(){
									window.location.reload(true);
							});
					</script>
				<?php
			}
		}
	}

	?>

	<header>
		<div class="container">
			<div class="row">
			<div class="col-10-sm">
				<p class="header-baslik">
					ToDoList
				</p>
			</div>
			</div>
		</div>
	</header>

	<div class="container">
		<form id="not" method="post">
			<div class="bos"> </div>
			<div class="row">
				<div class="col-9">
						<input type="text" class="text" name="note" placeholder="Not Giriniz..." autocomplete="off">
				</div>
				<div class="col-3">
					<button type="button" onclick="ekle()" class="button">Ekle</button>
				</div>
			</div>
		</form>
	</div>



	<div class="container">
		<div class="bos2"> </div>
		<?php

		$notes = $db->query("select * from notes order by note_no desc", PDO::FETCH_ASSOC);
		$note = $notes->fetchAll();
		if ($note > 0) {
			foreach ($note as $row) {
				?>
				<div class="aralik">
					<div class="row">
						<div class="col-10">
							<p class="note">
								<?=$row["note"]?>
							</p>
						</div>
						<div class="col-2">
							<a href="index.php?sil=<?=$row["note_no"]?>">
								<i id="sil" class="fa fa-trash" aria-hidden="true"></i>
							</a>
						</div>
					</div>
				</div>
				<div class="bos2"> </div>
				<?php
			}
		}else{
			?>
			<div class="aralik">
				<div class="row">
					<div class="col-10">
						<p class="note">
							Not bulunmuyor...
						</p>
					</div>
				</div>
			</div>
			<div class="bos2"> </div>
			<?php
		}
		?>


	</div>

	<script type="text/javascript">

	function ekle() {
		$.ajax({
                type:"post",
                url: "ajax.php",
                data: $('#not').serialize(),
                success: function (msg5) {
                    if(msg5 != 'success'){
                        swal({
                                title: "Maalesef işlemi gerçekleştiremiyoruz...",
                                type: "warning",
                                timer: 2000,
                                showConfirmButton: false
                            },
                            function(){
                                window.location.reload(true);
                            });
                    }else{
                        swal({
                                title: "Başarılı Bir Şekilde Paylaşıldı...",
                                type: "success",
                                timer: 2000,
                                showConfirmButton: false
                            },
                            function(){
                                window.location.reload(true);
                            });
                    }
                }

            });
	}

	</script>


	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/main.js"></script>
	<script src="assets/js/sweetalert.min.js"></script>
</body>
</html>
