
async function load(url, obj) {
	let say = await import('./getResult.js');
	return say.getResult(url,obj);
}
window.addEventListener("load", loadPage,false);

function loadPage()
{
	let productItem = document.querySelector('.product-item');

	productItem.addEventListener('click', function (e) {
		let count =0 ;
		let target = e.target;
		let classList = target.classList;
		let id = target.dataset.id;
		let productQ = document.querySelector('.product-quantity');
		count = productQ === null ?  1 :  productQ.value
		let modal = document.querySelector('.modal');
		if(classList.contains('add-cart')){
			e.preventDefault();
			if (count == 0) {
				document.body.style.overflow = 'hidden';
            	modal.classList.add('modal-item');
				modal.innerHTML = getModalWindow('Ապրանքի քանակը պետք է լինի 0-ից մեծ', false);
				let close = document.querySelector('.close');
				close.addEventListener('click',function (e) {
					e.preventDefault();
					modal.classList.remove('modal-item')
					
				});
			}else{
				load(`/list/cart/${id}/${count}`)
				.then(res => {
					console.log(res);
					let cartItems = document.querySelector('#cart-items');
					cartItems.innerHTML = res;
				})

			}
		}
		if(classList.contains('compare')){
			e.preventDefault();
			load(`/items/compare/${id}`)
				.then(res => {
					let compareItems = document.querySelector('#compare-items');
					compareItems.innerHTML = res;
				})
		}
		if(classList.contains('wishlist')){
			e.preventDefault();
			load(`/wishlist/list/${id}`)
				.then(res => {
					let wishlistItems = document.querySelector('#wishlist-items');
					wishlistItems.innerHTML = res;
				})
		}
	})


}