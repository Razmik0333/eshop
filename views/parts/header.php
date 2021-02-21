<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<?php foreach ($fileStyle as $value) {?>
		<link rel="stylesheet" <?php echo $value ?>>
	<?php }?>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

		<?php foreach ($fileScript as $value) {?>
			<?php echo $value;?>
	<?php } ?>
    <!-- Bootstrap CSS -->
    <title>home</title>
  </head>
  <body>
		<!--start of top container-->
		<div class="top container item-col">
			<!--start of top container-->
			<nav class="navbar navbar-expand-lg navbar-light bg-dark">
			  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			  </button>
			  <div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav mr-auto">
						<li class="nav-item active">
							<a class="nav-link text-white" href="/home">ԳԼԽԱՎՈՐ <span class="sr-only">(current)</span></a>
						</li>
						<li class="nav-item active">
							<a class="nav-link text-white" href="/catalog/product/page=1">ՏԵՍԱԿԱՆԻ <span class="sr-only">(current)</span></a>
						</li>
						<li class="nav-item dropdown bg-dark">
							<a class="nav-link dropdown-toggle text-white" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">ԱՐԺՈՒՅԹ</a>
							<div class="dropdown-menu bg-dark menu-items">
								<a class="dropdown-item text-white" href="#">AMD</a>
								<a class="dropdown-item text-white" href="#">USD</a>
								<a class="dropdown-item text-white" href="#">RUB</a>
								<a class="dropdown-item text-white" href="#">GBP</a>
								<a class="dropdown-item text-white" href="#">Other</a>
							</div>
						</li>
						<!-- <li class="nav-item dropdown bg-dark menu-items">
							<a class="nav-link dropdown-toggle text-white" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Language</a>
							<div class="dropdown-menu bg-dark">
								<a class="dropdown-item text-white" href="#">English</a>
								<a class="dropdown-item text-white" href="#">Русский</a>
								<a class="dropdown-item text-white" href="#">Հայերեն</a>
							</div>
						</li> -->
						<li class="nav-item dropdown bg-dark">
							<a class="nav-link text-white" href="/contacts">ՀԵՏԱԴԱՐՁ ԿԱՊ <span class="sr-only">(current)</span></a>
						</li>
						<!-- <li class="nav-item dropdown bg-dark">
							<a class="nav-link dropdown-toggle text-white" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Help</a>
							<div class="dropdown-menu bg-dark menu-items">
								<a class="dropdown-item text-white" href="#">About</a>
								<a class="dropdown-item text-white" href="#">More</a>
							</div>
						</li> -->
					</ul>
					<ul class="nav justify-content-end login-bar">

					</ul>
				</div>
			</nav>
			<div class="modal">
				
			</div>
			<!--end of top container-->
		</div><!--end of top container-->
   		<div class="menu container item-col">
			<nav class="navbar navbar-expand-lg navbar-light bg-warning pt-5">
				<div class="input-group search-zone">
					<form action="/search/goods/page=1" method="post">
						<input class="form-control-sm sm-2" type="search" name="search-field" id="search-field" value=""  placeholder="Search products..." aria-label="Search">
						<button class="btn btn-success my-2 my-sm-0" type="submit" id="search" name="search">Search</button>
						<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-1" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
							<span class="navbar-toggler-icon"></span>
						</button>
					</form>
					<div class="container position-absolute search-items">

					</div>
 				</div>
  				
				<div class="collapse navbar-collapse menu-bar" id="navbarSupportedContent-1">
					<ul class="navbar-nav mr-auto mt-2 mt-lg-0 category-items">
						
				
					</ul>
				</div>
			</nav>
			
  		</div>
		  

		