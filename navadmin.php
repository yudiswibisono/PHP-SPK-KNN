<nav class="navbar navbar-expand-lg navbar-light bg-light">
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mr-auto">
					<?php
					if (isset($_SESSION["username"]))
					{
					?>
					<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
						<div class="navbar-nav">
						  <a class="nav-item nav-link active" href="halamanhomeadmin.php">Home <span class="sr-only">(current)</span></a>
						  <a class="nav-item nav-link" href="halamanadmin.php">Ganti Rumus</a>
						  <a class="nav-item nav-link" href="halamanupdatedata.php">Update Data</a>
						  
						  <li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Master Crawling
							</a>
							<div class="dropdown-menu" aria-labelledby="navbarDropdown">
								<a class="nav-item nav-link" href="halamanmasterlokasi.php">Master Lokasi</a>
								  <a class="nav-item nav-link" href="halamanmastertransmisi.php">Master Transmisi</a>
								  <a class="nav-item nav-link" href="halamanmasterbahanbakar.php">Master Bahan Bakar</a>
								  <a class="nav-item nav-link" href="halamanmasterwarna.php">Master Warna</a>
							</div>
						</li>
						</div>
					</div>
						
						</ul>
						<ul class="navbar-nav mr-auto">
							<li class="nav-item active">
							</li>
						</ul>
						<a class="nav-link disabled" href="#">Selamat Datang : <?php echo $_SESSION["username"];?></a>
						<a class="nav-link" href="logoutadmin.php">Logout <span class="sr-only">(current)</span></a>
					<?php
					}
					else {
						?>
						
						</ul>
						<ul class="navbar-nav mr-auto">
							<li class="nav-item active">
							</li>
						</ul>
								<a class="nav-link" href="loginadmin.php">Login <span class="sr-only">(current)</span></a>
					<?php
					}
				?>
				
			</div>
		</nav></br>