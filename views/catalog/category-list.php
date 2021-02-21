<?php
	require_once ROOT.'/views/parts/header.php';
	require_once ROOT.'/views/parts/category-items.php';
	// var_dump('<pre>');
	// var_dump($categoryFilterLists);
	// var_dump('</pre>');

?>
	
	<div class="container">
		<div class="row">
		<div class="col-3">
					<div class="list-group text-center">
						
					</div>
					<form class="form-inline" method="get" action="<?php echo $_SERVER['REQUEST_URI']?>">
						<a type="submit" href="<?php if(strpos($uri,"?") !== false){echo $uriArr[0];}else{echo $uri;}?>?<?php if(strpos($uri,"?") !== false){echo $uriArr[1];}else{echo '';}?><?php if($isFavorite == 1){echo '';}elseif($isNew == 1 || $isCheap == 1){echo '&highest=1';}else{echo 'highest=1';}?>" class="btn btn-block btn-outline-warning ratings <?php if($isFavorite == 1){echo 'active';}?>"name="highest" title="4 and more" >&#9733;&#9733;&#9733;&#9733; ԵՎ ԱՎԵԼԻՆ</a><br>
						<a type="submit" href="<?php if(strpos($uri,"?") !== false){echo $uriArr[0];}else{echo $uri;}?>?newest=1" class="btn btn-block btn-outline-warning ratings <?php if($isNew == 1){echo 'active';}?>" name="newest"  >ՑՈՒՑԱԴՐԵԼ ՆՈՐԵՐԸ</a>
						<a type="submit" href="<?php if(strpos($uri,"?") !== false){echo $uriArr[0];}else{echo $uri;}?>?cheap=1" class="btn btn-block btn-outline-warning ratings <?php  if($isCheap == 1){ echo 'active';}?>" name="cheap"  >ԳԻՆ &#1423;</a>
					</form>
					<form class="form-inline" method="get" action="<?php echo $_SERVER['REQUEST_URI']?>">
					<input type="text" class="form-control mb-2 mr-sm-2" id="inlineFormInputName2" placeholder="min" name="price-min">
						<input type="text" class="form-control" id="inlineFormInputGroupUsername2" placeholder="max" name="price-max">
						<button type="submit" class="btn btn-block btn-outline-warning ratings " > &#1423;</button>
					</form>
				</div>

			<div class="col-9"> 
		<?php foreach($categoryFilterProducts as  $categoryFilterProduct) { ?>
				<div class="row mt-3 ">
					<div class="col-4  kl">
						<a class="cart-item " href="/product/<?php echo $categoryFilterProduct['id']?>"><img  src="<?php echo Product::getImage($categoryFilterProduct['id'])?>?>" alt="<?php $categoryFilterProduct['title']?>"></a>
						<?php if(intval($categoryFilterProduct['discount']) < intval($categoryFilterProduct['cost'])){ ?>
							<img class="card-img-top sale sale-list" src="/template/images/other/sale.png" alt="Card image cap"/>
						<?php }?>
					</div>
					<div class="col-7 " >
						<a href="/product/<?php echo $categoryFilterProduct['id']?>" class="cart-header h5"><?php echo $categoryFilterProduct['description']?></a>
						<span class="input-group-text   my-3 star-card head-rating" for="inputGroupSelect02">
							<?php for ($i = 1; $i <= 5; $i++) {
								if ($i <= ceil($categoryFilterProduct['rating'])) { ?>
									<a href="/rating/add/<?php echo $categoryFilterProduct['id']?>/<?php echo $i?>"  class="fa fa-star stars rating" name="star" data-rating="<?php echo $i?>" data-product="<?php echo $categoryFilterProduct['id']?>"  value="<?php echo $i?>"></a>
								<? } else{?>
									<a href="/rating/add/<?php echo $categoryFilterProduct['id']?>/<?php echo $i?>"  class="fa fa-star stars rating-empty" name="star" data-rating="<?php echo $i?>" data-product="<?php echo $categoryFilterProduct['id']?>"  value="<?php echo $i?>"></a>
								<?php } ?>
							<?php } ?>
						</span>
						<div class="my-2 h5">Համառոտ նկարագրություն </div>
						<div class="mx-1 p-2 cart-description"><?php echo $categoryFilterProduct['main']?> </div>
						
						<a href="/cart/add/<?php echo $categoryFilterProduct['id'] ?>">
							<input class="btn btn-outline-dark add-cart" data-id="<?php echo $categoryFilterProduct['id']?>" type="button" value="🛒">
						</a>						
						<a href="/compare/add/<?php echo $categoryFilterProduct['id'] ?>">
							<input class="btn btn-outline-dark compare" data-id="<?php echo $categoryFilterProduct['id']?>" type="submit" value="&#8644;">
						</a><br/>
						<span class="btn btn-secondary bg-light text-dark item-cost <?php if(intval($categoryFilterProduct['discount']) == intval($categoryFilterProduct['cost'])){ echo 'hidden';}?>" for="inputGroupSelect02"><?php echo $categoryFilterProduct['new_cost'].'&#1423;'?></span>
						<span class="btn btn-secondary bg-secondary text-light item-cost  " for="inputGroupSelect02"><?php if(intval($categoryFilterProduct['discount']) == intval($categoryFilterProduct['cost'])){echo $categoryFilterProduct['cost'].'&#1423;';}else{echo '<del>'.$categoryFilterProduct['cost'].'</del>&#1423;';}?></span>				
						
					</div>
				</div>
			<?php } ?>   
			<?php echo $pagination->getHtml(); ?>
			</div>

		</div>
	
	</div>	
	<?php
		require_once ROOT.'/views/parts/footer.php';
	?>