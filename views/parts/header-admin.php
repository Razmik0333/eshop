<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<?php foreach ($fileStyle as $value) {?>
			<link rel="stylesheet" <?php echo $value ?>>
		<?php }?>
		<script src="https://use.fontawesome.com/dc298a9238.js"></script>
		<?php foreach ($fileScript as $value) {?>
			<?php echo $value;?>
		<?php } ?>
    <!-- Bootstrap CSS -->
    <title>ԱԴՄԻՆԻՍՏՐԱՏՈՐ</title>
  </head>
  <body>
		<!--start of top container-->
		<div class="top container">
			<!--start of top container-->
			<nav class="navbar navbar-expand-lg navbar-light bg-dark">
			  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			  </button>
			  <div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav mr-auto">
						<li class="nav-item active">
							<a class="nav-link text-white" href="/">ԳԼԽԱՎՈՐ <span class="sr-only">(current)</span></a>
						</li>
					</ul>
					<ul class="nav justify-content-end">
						<li class="nav-item" >
							<a class="nav-link text-white" id="logout" href="/admin">ԱԴՄԻՆԻՍՏՐԱՑԻԱ</a>
						</li>							
					</ul>
				</div>
			</nav>
			<!--end of top container-->
		</div>
   		