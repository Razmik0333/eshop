<?php 
		require_once ROOT.'/views/parts/header.php';

?>
		<div class="container pt-2">
			<nav class="navbar navbar-expand-lg navbar-light bg-light">
			
				<div class="collapse navbar-collapse" id="navbarText">
					<nav aria-label="breadcrumb ">
						<ol class="breadcrumb bg-light">
							<li class="breadcrumb-item"><a href="/">ԳԼԽԱՎՈՐ</a></li>
							<li class="breadcrumb-item"><a href="/category/<?php echo $productById["category"]?>"><?php echo $productById["arm_name"]?></a></li>
							<li class="breadcrumb-item"><a href="/category/<?php echo $productById["category"]?>/<?php echo $productById["category_id"]?>"><?php echo $selectedCategory["category_arm_name"]?></a></li>
							<li class="breadcrumb-item active" aria-current="page"><?php echo $productById['desc']?></li>
						</ol>
					</nav>					
				</div>
			</nav>
	  	</div>
		<div class="container">
			<div class="row">
				<div class="col-5" >
					<img src="<?php echo Product::getImage($productById['id'])?>" alt="" id="item-img" class="position-relative">
					<input class="btn btn-outline-dark position-absolute" type="button" value="&#x2922;" id="resize">
					<div id="modal" class="modal">
						<span id="close">&times;</span>
						<img src="" class="modal-content" id="modal-img">
						<div id="caption"></div>
					</div>
					<div class="row position-relative row-position">
						<div class="col">					
							<img src="" alt="" id="item-img-1" class="position-absolute down-images">
						</div>	
						<div class="col">
							<img src="" alt="" id="item-img-2" class="position-absolute down-images">
						</div>	
						<div class="col">
							<img src="" alt="" id="item-img-3" class="position-absolute down-images">
						</div>	
						<div class="col">
							<img src="" alt="" id="item-img-4" class="position-absolute down-images">
						</div>
					</div>
				</div>
		
				<div class="col-7 p-1">
					<h4 id="item-name"><?php echo $productById['desc']?></h4>
					<span class="input-group-text mx-auto my-3 d-inline-block star-card" id="item-rating" for="inputGroupSelect02">
						<?php for ($i = 1; $i <= 5; $i++) {
							if ($i <= ceil($productById['rating'])) { ?>
								<a href="/rating/add/<?php echo $productById['id']?>/<?php echo $i?>"  class="fa fa-star stars rating" name="star" data-rating="<?php echo $i?>" data-product="<?php echo $productById['id']?>"  value="<?php echo $i?>"></a>
							<? } else{?>
								<a href="/rating/add/<?php echo $productById['id']?>/<?php echo $i?>"  class="fa fa-star stars rating-empty" name="star" data-rating="<?php echo $i?>" data-product="<?php echo $productById['id']?>"  value="<?php echo $i?>"></a>
							<?php } ?>
						<?php } ?>
					</span>
					<div class="input-group-append">
						<span class="input-group-text bg-dark text-light my-3" id="item-cost" for="inputGroupSelect02"><?php echo $productById['cost'].'&#1423;'?></span>
					</div>
					<div class="input-group-append  mx-auto my-3">
						<a href="/cart/add/<?php echo $productById['id']?>"><input class="btn btn-outline-dark mx-1 add-cart" data-id="<?php echo $productById['id']?>" type="submit" value="&#128722; Add to Cart"></a>
						<input class="btn btn-outline-dark mx-1" type="button" value="&#x2661">
						<a href="/compare/add/<?php echo $productById['id'] ?>">
							<input class="btn btn-outline-dark compare" data-id="<?php echo $productById['id']?>" type="submit" value="&#8644;">
						</a>
						<input class="btn btn-outline-dark mx-1" type="button" value="&#x2709">
					</div>
					<div class="input-group-append  mx-auto my-3">
						<span class="mx-1">Quantity: </span>
						<input class="btn btn-outline mx-1" id="quantity" type="text" value="0">
						<input class="btn btn-outline-dark mx-1" id="minus" type="button" value="-">
						<input class="btn btn-outline-dark mx-1" id="plus" type="button" value="+">
					</div>
					<div class="mx-auto my-5">
						<div class="mx-2 h5">Համառոտ նկարագրություն </div>
						<div class="mx-1" id="content"><?php echo $productById['main']?></div>
						
					</div>
					<div class="mx-auto my-5">
						<div class="mx-1"><span id="available"></span> </div>
						<div class="mx-1"><span id="category"></span> </div>
						
					</div>
					<div class="input-group-append  mx-auto my-2">
						<button type="button" class="btn btn-primary ml-2"><i class="fa fa-facebook mr-1" aria-hidden="true"></i>  Share</button>
						<button type="button" class="btn btn-outline-dark ml-2"><i class="fa fa-google-plus mr-1" aria-hidden="true"></i>Google</button>
						<button type="button" class="btn btn-outline-dark ml-2"><i class="fa fa-twitter mr-1" aria-hidden="true"></i> Tweet</button>
						<button type="button" class="btn btn-outline-dark ml-2"><i class="fa fa-pinterest mr-1" aria-hidden="true"></i>Pinterest</button>
						<button type="button" class="btn btn-outline-dark ml-2"><i class="fa fa-linkedin mr-1" aria-hidden="true"></i>Linkedin</button>

					</div>
				</div>
				</div>
				
			</div>
		<div class="container tab-body tab-item ">

		</div>
		<div class="container position-relative ">
			<div class="row card-other">
				
			</div>
		</div>
<?php 
	require_once ROOT.'/views/parts/footer.php';
?>

