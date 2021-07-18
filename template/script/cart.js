
async function load(url, obj) {
	let say = await import('./getResult.js');
	return say.getResult(url,obj);
}
window.addEventListener("load", loadPage,false);

function loadPage()
{
	let productItem = document.querySelector('.product-item');
	

	productItem.addEventListener('click', function (e) {
		e.preventDefault();
		let count =0 ;
		let target = e.target;
		let classList = target.classList;
		let id = target.dataset.id;
		let productQ = document.querySelector('.product-quantity');
		count = productQ === null ?  1 :  productQ.value
		let modal = document.querySelector('.modal');
		if(classList.contains('add-cart')){
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
				console.log('wow');
				load(`/list/cart/${id}/${count}`)
				.then(res => {
					console.log(res);
					target.classList.remove('btn-outline-dark')
					target.classList.add('btn-dark')
					let cartItems = document.querySelector('#cart-items');
					cartItems.innerHTML = res;
				})

			}
		}
		if(classList.contains('compare')){
				load('/items/product')
				.then(res => {
					console.log(res);
					if (typeof res == 'object') {
						let arrExist = res.filter(elem => elem['id'] === id);
						if(arrExist.length == 0){
								target.classList.remove('btn-outline-dark')
								target.classList.add('btn-dark')
								load(`/items/compare/${id}`)
									.then(res => {
										console.log(res);
										let compareItems = document.querySelector('#compare-items');
										compareItems.innerHTML = res;
		
							})
						}else if (arrExist.length > 0) {
								target.classList.remove('btn-dark')
								target.classList.add('btn-outline-dark');
								load(`/items/delete/${id}`).then(res =>{
									let compareItems = document.querySelector('#compare-items');
									console.log( res);
									res === 0 ? 0 : res.length;
									compareItems.innerHTML = res;
							})
						}
					}else{
						target.classList.remove('btn-outline-dark')
						target.classList.add('btn-dark')
						load(`/items/compare/${id}`)
						.then(res => {
							console.log(res);
							let compareItems = document.querySelector('#compare-items');
							compareItems.innerHTML = res;
						})
					}
				});
				
		}
		if(classList.contains('wishlist')){

			load('/wishlist/items')
			.then(res => {
				console.log( res);
				if (typeof res == 'object') {
					let arrExist = res.filter(elem => elem['id'] === id);
					console.log( arrExist);
					if(arrExist.length == 0){
						target.classList.remove('btn-outline-dark')
						target.classList.add('btn-dark')
						load(`/wishlist/add/${id}`)
							.then(res => {
								console.log(res);
							   let wishlistItems = document.querySelector('#wishlist-items');
							   wishlistItems.innerHTML = res;
   
					   })
				   }else if (arrExist.length > 0) {
					   target.classList.remove('btn-dark')
					  target.classList.add('btn-outline-dark');
					  load(`/wishlist/delete/${id}`).then(res =>{
						  let wishlistItems = document.querySelector('#wishlist-items');
						  wishlistItems.innerHTML = res.length;
					  })
				  }
				}else{
					target.classList.remove('btn-outline-dark')
					target.classList.add('btn-dark')
					load(`/wishlist/add/${id}`)
						.then(res => {
							console.log(res);
						   let wishlistItems = document.querySelector('#wishlist-items');
						   wishlistItems.innerHTML = res;

				   })
				}

				
			})
		}
	})


}