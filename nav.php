<nav class="navbar navbar-expand-lg navbar-light bg-light">
			<a class="navbar-brand" href="home.php">Home</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mr-auto">
					<?php
					if (isset($_SESSION["username"]))
					{
					?>
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Mobil
							</a>
							<div class="dropdown-menu" aria-labelledby="navbarDropdown">
								<a class="dropdown-item" href="mobilbaru.php">Mobil Baru</a>
								<a class="dropdown-item" href="mobilbekas.php">Mobil Bekas</a>
							</div>
						</li>
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Sepeda Motor
							</a>
							<div class="dropdown-menu" aria-labelledby="navbarDropdown">
								<a class="dropdown-item" href="motorbaru.php">Sepeda Motor Baru</a>
								<a class="dropdown-item" href="motorbekas.php">Sepeda Motor Bekas</a>
							</div>
						</li>
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								History
							</a>
							<div class="dropdown-menu" aria-labelledby="navbarDropdown">
								<a class="dropdown-item" href="riwayatmobilbaru.php">History Mobil Baru</a>
								<a class="dropdown-item" href="riwayatuser.php">History Mobil Bekas</a>
								<a class="dropdown-item" href="riwayatmotorbaru.php">History Motor Baru</a>
								<a class="dropdown-item" href="riwayatmotorbekas.php">History Motor Bekas</a>
							</div>
						</li>
						<a class="nav-link" href="berita.php">Berita</a>
						</ul>
						<ul class="navbar-nav mr-auto">
							<li class="nav-item active">
							</li>
						</ul>
						<a class="nav-link disabled" href="#">Selamat Datang : <?php echo $_SESSION["username"];?></a>
						<a class="nav-link" href="logout.php">Logout <span class="sr-only">(current)</span></a>
					<?php
					}
					else {
						?>
						<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Mobil
						</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
							<a class="dropdown-item" href="mobilbaru.php">Mobil Baru</a>
							<a class="dropdown-item" href="mobilbekas.php">Mobil Bekas</a>
						</div>
						</li>
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Sepeda Motor
							</a>
							<div class="dropdown-menu" aria-labelledby="navbarDropdown">
								<a class="dropdown-item" href="motorbaru.php">Sepeda Motor Baru</a>
								<a class="dropdown-item" href="motorbekas.php">Sepeda Motor Bekas</a>
							</div>
						</li>
						<a class="nav-link" href="berita.php">Berita</a>
						</ul>
						<ul class="navbar-nav mr-auto">
							<li class="nav-item active">
							</li>
						</ul>
								<a class="nav-link" href="loginuser.php">Login <span class="sr-only">(current)</span></a>
					<?php
					}
				?>
				
			</div>
		</nav></br>