window.addEventListener("load", loadPage,false);
async function load(url, obj) {
	let say = await import('./getResult.js');
	return say.getResult(url,obj);
}

function loadPage() {
	let cartItem = document.querySelector('.cart-item');
	
	let cartData;
	let totalPrice = 0;
	load('/list/productCount')
	.then(res => {
		cartData = res;
		load('/list/product')
		.then(res1 =>{
			let cartCount = document.querySelector('.cart-count');
			if (+res1 === 0) {
				cartItem.innerHTML = renderTotalPrice(0) + getBuy('disabled')
				cartCount.innerHTML = 0;
			
			}else{
				totalPrice = getTotalPrice(res, res1);
				let cartTemplate = renderResult(res,res1);
				cartItem.innerHTML = renderTotalPrice(totalPrice) + cartTemplate + getBuy('');
				return res1;
			}
		})
		})
		.then(() => {
			cartItem.addEventListener('click', function (e) {
				e.preventDefault();
				let target = e.target;
				if (target.tagName !== 'BUTTON') return;
				if (target.dataset.delete) {					
					load(`/list/delete/${target.dataset.delete}`).then(res1 => {
						load(`/list/productCount`).then(res => {
							cartData = res;
							let cartCount = document.querySelector('.cart-count');

							if (+res1 === 0 ) {
								cartItem.innerHTML = renderTotalPrice(0) + getBuy('disabled')
								cartCount.innerHTML = 0;

							}else{
								totalPrice = getTotalPrice(res, res1);
                                console.log("🚀 ~ file: list.js ~ line 49 ~ load ~ totalPrice", totalPrice)
								let cartTemplate = renderResult(res,res1);
								cartItem.innerHTML = renderTotalPrice(totalPrice) + cartTemplate + getBuy('')
								cartCount.innerHTML = getCartCount(res);
							}
							
						})
					})
				}
				if (target.dataset.buy && cartData !== 0) {
					document.body.style.overflow = 'hidden';
					let modal = document.querySelector('.modal')
					modal.classList.add('modal-item');
					load('/list/data').then(res => {
						let strData = JSON.stringify(cartData);
						if(res === 0){
							modal.innerHTML = renderDataUser(undefined)
							
						}else{
							modal.innerHTML = renderDataUser(res,strData,totalPrice)
						}
						
					}).then(() =>{
						let form = document.querySelector('.form');
						form.addEventListener('change', function (e) {
							e.preventDefault();
							let target = e.target;
							let value = target.value;
							if (target.classList.contains('name')) {
								if (!checkNameLength(value)) {
									changeColor(target, false, `Անունը պետք է ունենա 2-ից ավելի սիմվոլ`)
					
								}else{
									changeColor(target, true, `Անունը ճիշտ է`);
								}
							}
							else if (target.classList.contains('phone')) {
								if (!checkPhoneLength(value)) {
									
									changeColor(target, false, `Այս դաշտը պարտադիր է`)
									
								}else{
									checkPhone(value) ? 
									changeColor(target, true, `Հեռախոսահամարը կոռեկտ է`) :
									changeColor(target, false, `Հեռախոսահամարը կոռեկտ չէ`) 

								}
							}else{
								form.addEventListener('submit', function (e) {
									let formData = new FormData(form);
									e.preventDefault();
									load('/list/buy', formData).then(res => {
										if (res) {
											load('/list/clear')
											.then(result => {
												if(result){
													let cartCount = document.querySelector('.cart-count');

													modal.innerHTML = getModalWindow('Ձեր պատվերն ընդունված է։Մենք Ձեզ հետ կկապնվենք։');
													let close = document.querySelector('.close');
													close.addEventListener('click', function (e) {
														document.body.style.overflow = '';
														modal.classList.remove('modal-item');
														modal.innerHTML = 'visible';
														cartItem.innerHTML = renderTotalPrice(0) + getBuy('disabled')
														cartCount.innerHTML = 0;													})
												} 
											})
										}
										
									})
									
								})
							}
						})
						
					})
				}
				

			})
		})
}

function getCartCount(obj) {
	let count = 0;
	let values = Object.values(obj)
	values.forEach(element => {
		count += element
	});
	return count;
}
function renderDataUser(obj, strData, price) {
	return `
	<form class="text-dark form container" method="POST" action="#">
		<div class="form-col" >
			<div class="form-group col-sm-6">
				<input type="text" class="form-control input-hide" id="inputName4" placeholder="Enter Your Name" name="id" value="${getData(obj,'id')}">
			</div>
			<div class="form-group col-sm-6">
				<input type="text" class="form-control name" id="inputName4" placeholder="Enter Your Name" name="name" value="${getData(obj,'name')}">
				<label for="inputName4">First name</label>
			</div>
			<div class="form-group col-sm-6">
				<input type="phone" class="form-control phone" id="inputPhone4" placeholder="Your phone" name="phone" value="">
				<label for="inputPhone4">Your phone</label>
			</div>
			<div class="form-group col-sm-6 input-hide">
				<input type="hidden" class="form-control" id="inputOrder4" placeholder="Your phone" name="order" value='${strData}'>
				<label for="inputOrder4">Your Order</label>
			</div>
			<div class="form-group col-sm-6 input-hide">
				<input type="hidden" class="form-control disabled" id="inputPrice4" placeholder="All Price" name="price" value='${price}'>
				<label for="inputPrice4">Price</label>
			</div>
			<div class="form-group col-sm-6">
			<textarea class="form-control" name="comment" placeholder="Enter Your Comment" id="exampleFormControlTextarea1" rows="3"></textarea>
		  </div>
		</div>
		<input type="submit" class="btn btn-primary position-relative order" data-order="order" value="Պատվիրել" name="submit"  style="left:15px">
	</form> `;
}
function getData(obj,prop) {
	return obj !== undefined ? obj[prop] : ''
}


function getTotalPrice(obj1,obj2) {
	let totalPrice = 0;
	
	for (const iterator of obj2) {
		totalPrice += iterator['cost'] * obj1[iterator['id']]
	}
	return totalPrice
}
function renderTotalPrice(number) {
	return `<div class="total-price">ԸՆԴՀԱՆՈՒՐ ԱՐԺԵՔԸ ԿԱԶՄՈՒՄ Է ${number} ԴՐԱՄ</div>`

}
function getCartItem(obj1, obj2) {
	let productCard = `
		    <div class="container card-item"> 
				<div class="row mt-3">
					<div class="col-4 kl">
						<a class="cart-link" href="/product/${obj1.id}"><img src="/template/images/${obj1.id}.jpg" alt="${obj1.title}"></a>
					</div>
					<div class="col-7" >
						<a href="/product/view/${obj1.id}" class="cart-header h5"></a>
						<div class="input-group-append">
							<span class="input-group-text bg-white text-dark my-2" id="cart-cost" for="inputGroupSelect02"> ${obj2[obj1.id]} x ${obj1.cost}&#1423;</span>
						</div>
						<span class="input-group-text   my-3 star-card" for="inputGroupSelect02">
							${createRatingStars(obj1.rating)}
						</span>
						<div class="my-2 h5">Համառոտ նկարագրություն </div>
						<div class="mx-1 p-2 cart-description"> </div>
						
						<button class="btn btn-outline-dark" type="button"><i class='fa fa-search'></i></button>
						<a href="/compare/add/${obj1.id}">
							<input class="btn btn-outline-dark compare" data-id="" type="button" value="⇄">												
						</a>
						<input type="hidden" name="delete" value="">
						<a href="/cart/delete/${obj1.id}">
							<button class="btn btn-outline-dark close-item" data-delete="${obj1.id}" type="button">x</button>
						</a>
					</div>
				</div>
				</div>
	`;
	return productCard;
}


function getBuy(str) {
	return `
		<a href="/cart/checkout">
			<button class="btn btn-outline-dark mx-auto ${str} buy" data-buy="1" name="buy">Կատարել գնում</button>
		</a>`
}

function createRatingStars(value) {
	let rating = '';
	for (let i = 1; i <= 5; i++) {
		if (i <= value) {
			rating += `<a href="/rating/add/${i}" class="fa fa-star stars rating-full" name="star" data-rating="${i}" data-product=""  value=""></a><br>`;
		}else{
			rating += `<a href="/rating/add/${i}" class="fa fa-star stars rating-empty" name="star" data-rating="${i}" data-product=""  value=""></a><br>`;
		}
	}
	return rating
}


function renderResult(obj1,obj2){
	let cartTemplate = ``;
	for (const iterator of obj2) {
		cartTemplate += getCartItem(iterator, obj1);
	}
	return cartTemplate;

}