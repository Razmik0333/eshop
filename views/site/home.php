 <?php 
	require_once ROOT.'/views/parts/header.php';

?>

	<div class="container">
		<div class="row">
			<div class="col-4 max-discount-item">
				
			</div>
			<div class="col-8 mt-3">
				<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
					<ol class="carousel-indicators">
						<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
						<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
						<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
					</ol>
					<div class="carousel-inner">
						<div class="carousel-item active">
							<img class="d-block w-100" src="./template/images/glass.png" alt="First slide">
						</div>
						<div class="carousel-item">
							<img class="d-block w-100" src="./template/images/laser.png" alt="Second slide">
						</div>
						<div class="carousel-item">
							<img class="d-block w-100" src="./template/images/ploter.png" alt="Third slide">
						</div>
					</div>
					<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
						<span class="carousel-control-prev-icon" aria-hidden="true"></span>
						<span class="sr-only">Previous</span>
					</a>
					<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
						<span class="carousel-control-next-icon" aria-hidden="true"></span>
						<span class="sr-only">Next</span>
					</a>
				</div>
			</div>
		</div>
	</div>
	<div class="container parent position-relative mt-5">
		<div class="row">
			<div class="col">
				<div class="header1 d-flex align-items-center justify-content-center position-absolute"><i class="fa fa-truck"></i> </div>
				<div class="second d-flex align-items-center justify-content-center position-absolute text1">FREE SHIPPING <br/> ALL ORDER</div>
			</div>
			<div class="col">
				<div class="header2 d-flex align-items-center justify-content-center position-absolute"> <i class="fa fa-headphones"></i></div>
				<div class="third d-flex align-items-center justify-content-center position-absolute text1">24/7 CUSTOMER <br/> SUPPORT</div>
			</div>
			<div class="col">
				<div class="header3 d-flex align-items-center justify-content-center position-absolute"><i class="fa fa-mail-reply-all"></i></div>
				<div class="fourth d-flex align-items-center justify-content-center position-absolute text1">MONEY BACK<br/> GUARANTEE</div>
			</div>
			<div class="col">
				<div class="header4 d-flex align-items-center justify-content-center position-absolute"><i class="fa fa-bullhorn"></i></div>
				<div class="five  d-flex align-items-center justify-content-center position-absolute text1">MEMBER new_cost<br/>FIRST ORDER</div>
			</div>
		</div>
	</div>
	<div class="container mt-1">
		<div class="row">
			<div class="col-6 my_img">
				<img src="images/trchun.jpg" alt="">
			</div>
			<div class="col-6 my-img">
					<img src="images/zardatup.jpg" class="mb-4" alt="">
				</div>
			</div>
		</div>
		
	</div>
	<div class="container">
		<div  class="row justify-content-center">
			<ul class="nav  mt-1">
				<?php //foreach($categoryList  as $key => $category){?>

					<li class="nav-item">
						<a class="nav-link" href="/category/<?php //echo $category['id'];?>/page=1"><?php //echo $category['arm_name'];?></a>
					</li>
				<?php //}?>
			</ul>						
		</div>
		<div class="row product-item">
			
			

		</div>
		<div class="row mt-1 product-recomended">
			
		</div>
		<div class="col">
			<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
				<div class="carousel-inner">
					<div class="carousel-item active">
						<img class="d-inline" src="/template/images/other/Dalter-150x100.png" alt="First slide">
						<img class="d-inline" src="/template/images/other/boss.png" alt="Third slide">
						<img class="d-inline" src="/template/images/other/bresse-bleu-150x100.png" alt="Third slide">
						<img class="d-inline" src="/template/images/other/carozzi-150x100.png" alt="Third slide">
						<img class="d-inline" src="/template/images/other/Dalter-150x100.png" alt="Third slide">
						<img class="d-inline" src="/template/images/other/dior.png" alt="Third slide">
						<img class="d-inline" src="/template/images/other/Discover_Network.png" alt="Third slide">

					</div>
					<div class="carousel-item">
						<img class="d-inline" src="/template/images/other/levis.png" alt="Second slide">
						<img class="d-inline" src="/template/images/other/master_card.png" alt="Second slide">
						<img class="d-inline" src="/template/images/other/paypal.png" alt="Second slide">
						<img class="d-inline" src="/template/images/other/visa.png" alt="Second slide">
						<img class="d-inline" src="/template/images/other/Yamaha.jpg" alt="Second slide">
						<img class="d-inline" src="/template/images/other/american_express.png" alt="Second slide">
						<img class="d-inline" src="/template/images/other/boss.png" alt="Second slide">
					</div>
					
				</div>
				<a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
					<span class="carousel-control-prev-icon" aria-hidden="true"></span>
					<span class="sr-only">Previous</span>
				</a>
				<a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
					<span class="carousel-control-next-icon" aria-hidden="true"></span>
					<span class="sr-only">Next</span>
				</a>
			</div>
		</div>
	</div>
	
<?php 
	require_once ROOT.'/views/parts/footer.php';
?> 
