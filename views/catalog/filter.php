<?php 

	require_once ROOT.'/views/parts/header.php';
	require_once ROOT.'/views/parts/category-items.php';
?>

		<div class="container item-col">			
			<div class="row filters">
				<div class="col-2 item-col">
					<div class="list-group text-center">
						
					</div>
					
					<div class="list-group text-center">
						<div class="text-center p-2">
							Տեսակավորել ըստ
						</div>
						<button class="btn btn-outline-warning dropdown-toggle filter-show" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
						<div class="dropdown-menu ">
							<a class="dropdown-item ratings cheap" data-value="cheap" href="#">ԳԻՆ</a>
							<a class="dropdown-item ratings newest" data-value="newest" href="#">ԹԱՐՄՈՒԹՅԱՆ</a>
							<a class="dropdown-item ratings rating" data-value="rating" href="#">ՎԱՐԿԱՆՇԻ</a>
						</div>
						<br/>
					</div>
					<div class="list-group">
						<div class="text-center p-2">
							Ֆիլտրել ըստ
						</div>
							<div class="text-start p-2 filter-cost">
								Գին
								<input type="text" class="form-control mb-2 mr-sm-2 cost-min" id="inlineFormInputName2" placeholder="<?php echo $cost_min['min']; ?>" name="price-min">
								<input type="text" class="form-control cost-max" id="inlineFormInputGroupUsername2" placeholder="<?php echo $cost_max['max']; ?>" name="price-max">
							</div>
							<div class="text-start p-2">
								<a type="submit" href="" class="btn btn-block btn-outline-warning ratings highest" name="highest" title="4 and more" >&#9733;&#9733;&#9733;&#9733; ԵՎ ԱՎԵԼԻՆ</a><br>
							</div>
						</div>
					</div>
				<div class="col-10">
					<div class="row product-item">
													
					</div>
					<nav aria-label="Page navigation example">
						<ul class="pagination pagination-items">
						
						</ul>
					</nav>
				</div>
				
			</div>
			</div>
			
			
	<?php 
		require_once ROOT.'/views/parts/footer.php';
	?>
