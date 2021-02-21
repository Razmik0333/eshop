
async function load(url, obj) {
	let say = await import('./getResult.js');
	return say.getResult(url,obj);
}
window.addEventListener("load", loadPage,false);

function loadPage()
{
	let productItem = document.querySelector('.product-item');
	productItem.addEventListener('click', function (e) {
		let classList = e.target.classList;
		let id = e.target.dataset.id;
		if(classList.contains('add-cart')){
			e.preventDefault();
			load(`/list/cart/${id}`)
			.then(res => {
				console.log(res);
				
				let cartItems = document.querySelector('#cart-items');
				cartItems.innerHTML = res;
			})
		}
		if(classList.contains('compare')){
			e.preventDefault();
			load(`/items/compare/${id}`)
				.then(res => {
					let compareItems = document.querySelector('#compare-items');
					compareItems.innerHTML = res;
				})
		}
	})


}