window.addEventListener("load", loadPage,false);
async function load(url, obj) {
	let say = await import('./getResult.js');
	return say.getResult(url,obj);
}

function loadPage() {
    let wishlistItems = document.querySelector('.wishlist-item');
    load('/wishlist/items')
    .then(res => {
        if (typeof res == 'object') {
            let template = '';
            for (const iterator of res) {	
                template += getCardItem(iterator);
                wishlistItems.innerHTML = template
            }
        }
    })
}



function getCardItem(obj){
	let productCard = `
	<div class="col-3 item-col">
		<div class="card">
			<img class="card-img-top item-card" src="/template/images/${obj.id}.jpg" alt="Card image cap">
			${getSaleStatus(obj.discount)}
			<div class="card-body text-center item-body">
				<a href="/product/view/${obj.id}" class="h6 item-name">${obj.descr}</a>
				<div class="col-6">
					<div class="input-group-append">
						<span class="input-group-text my-3 mx-5 star-card" data-productId="${obj.id}">
							${getRatingStars(obj.rating,obj.id)}
						</span>
					</div>
					<nav class=" navbar-expand-lg navbar-light input-group-append home-inputs">
						<div class="collapse navbar-collapse" id="navbarSupportedContent">
							<ul class="navbar-nav mr-auto">
								<li class="nav-link pr-0">
									<a href="/cart/add/${obj.id}/1">
										<input class="btn btn-outline-dark add-cart" data-id="${obj.id}" type="submit" value="🛒">
									</a>
								</li>
								<li class="nav-link pl-0 pr-0">
									<a href="/compare/add/${obj.id}">
										<input class="btn btn-outline-dark compare" data-id="${obj.id}" type="submit" value="&#8644;">
									</a>
								</li>
								<li class="nav-link pl-0 pr-0">
									<a href="/wishlist/add/${obj.id}">
										<input class="btn btn-outline-dark wishlist" data-id="${obj.id}" type="submit" value="&#x2661;">
									</a>
								</li>
								<li class="nav-link pr-0">
									<span class="btn  my-2 my-sm-0 bg-light text-dark item-cost" for="inputGroupSelect02"><del>${obj.cost}&#1423;</del></span>
								</li>
								<li class="nav-link pl-0">
									<span class="btn btn-outline-success my-2 my-sm-0 bg-secondary text-light item-cost" for="inputGroupSelect02">${obj.cost * (1-obj.discount/100)}</span>
								</li>
							</ul>
						</div>
					</nav>
				</div>
			</div>
		</div>
	</div>
`;
	return productCard;
}