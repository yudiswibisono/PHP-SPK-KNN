<?php
	include "conn.php";
	if (!isset($_SESSION["id_admin"]))
	{
		header("location:loginadmin.php");
	}
	
	
	
?>
<!DOCTYPE html>
<?php
//<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
?>

<html>
<head>
	<title>Bootstrap Example</title>
	<style type="text/css">
	body {
	background: url(bg.png) no-repeat fixed;
	   -webkit-background-size: 100% 100%;
	   -moz-background-size: 100% 100%;
	   -o-background-size: 100% 100%;
	   background-size: 100% 100%;
	}
	</style>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<script type="text/javascript" src="js/bootstrap.js"></script>
</head>

		<?
			
		php?>
<body>
	<div class="container">
		<!-- Navigation -->
    <?php
		include "navadmin.php";
	?>
	</div>
			<div class="container">
				<h2 style="text-align: center;">Sistem Penunjang Keputusan Pemilihan Mobil Dan Motor</h2></br>

				
				<div class="panel panel-primary">
					<div class="card card-outline-secondary">
						<div class="card-header"style="background-color: lightgreen; color: black; text-align: center;">
							<h3 class="mb-0">Master Lokasi</h3>
						</div>
						<div class="card-body">
							<table class="table">
							  <thead>
								<tr>
								  <th scope="col">No.</th>
								  <th scope="col">Nama Lokasi</th>
								  <th scope="col">Nama Group Kota</th>
								</tr>
							  </thead>
							  <tbody>
							    <?php
									//$q="select a.id,a.lokasi,b.id_kota,b.nama_kota from lokasi_crawling a left join lokasi b ON a.fk_id_kota = b.id_kota";
									$q="select * from lokasi_crawling order by id,id_kota";
									$res=mysqli_query($conn,$q);
									while ($row=mysqli_fetch_assoc($res))
									{
										?>
										<tr>
										  <td>
											<?php
												echo $row["id"];
											?>
										  </td>
										  <td>
										    <?php
												echo $row["lokasi"];
											?>
										  </td>
										  <td>
										    <div class="col-sm-10">
												<select onchange="ganti(<?php echo $row["id"];?>);" class="form-control" required="" name="namaLokasi" id="namaLokasi<?php echo $row["id"];?>">
												<option>Belum ada group kota</option>
													<?php
														
														$q2="SELECT * from lokasi order by nama_kota";
														
														$res2=mysqli_query($conn,$q2);
														while ($rowCmbBox=mysqli_fetch_assoc($res2))
														{
															$selected="";
															if ($rowCmbBox["id_kota"]===$row['id_kota'])
															{
																$selected="selected";
															}
															?>
															  <option <?php echo $selected;?> value="<?php echo $rowCmbBox["id_kota"];?>">
																<?php
																	echo $rowCmbBox["nama_kota"];
																?>
															  </option>
															<?php
														}
													?>
												</select>
											</div>
										  </td>
										  </tr>
										<?php
									}
									
								?>
							  </tbody>
							</table>

						</div><!--/card-block-->
					</div>
				</div>
			</div>
			
			
	</div>
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script>
	function ganti(id)
	{
		var valx=$("#namaLokasi"+id).val();
		//console.log(val);
		$.ajax({
			  url: "gantilokasi.php",
			  type: 'GET',
			  data: { id:id, val:valx},
			  dataType:'json',
			  success: function(result) {
				alert("Data berhasil dirubah");
			  },
			  error: function(e) {
			  }
		  });
	}
	$(document).ready(function(){
		$(".btnSave").click(function(){
		var currentRow = $(this).closest("tr")[0]; 
		var cells = currentRow.cells;

		 var idKota = cells[0].textContent.trim();
		 var tagIDComboBox = "#namaLokasi" + idKota;
		 var fkIdKota = $(tagIDComboBox).val();
		 
		 $.ajax({
			url: 'updateMasterLokasi.php',
			type: 'POST',
			data: {
				fkIdKota: fkIdKota,
				idKota: idKota
			}
			}).done(function(data){
				alert(data);
			});
			
		});
		
});
</script>
<script type="text/javascript" src="js/bootstrap.js"></script>

	
</html>