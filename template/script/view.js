async function load(url, obj) {
	let say = await import('./getResult.js');
	return say.getResult(url,obj);
}



window.addEventListener("load", loadPage,false);


function loadPage()
{	
  let cardOtherTemplate = ``;
	load('/feature/product')
	.then(res => {
    let cardOther = document.querySelector('.card-other');
		for (const iterator of res) {
            cardOtherTemplate += getOtherProducts(iterator);
        }
        cardOther.innerHTML = cardOtherTemplate;
    }).then(res => {
        let addToCart = document.querySelectorAll('.add-cart');
        let addToCompare = document.querySelectorAll('.compare');
        addToCart.forEach((elem) => {
          elem.addEventListener('click', function(e){
            e.preventDefault();
            let id = e.target.dataset.id;
            
            load(`/list/cart/${id}`)
            .then(res => {
              console.log(res);
              let cartItems = document.querySelector('#cart-items');
              cartItems.innerHTML = res;
            })
          })
        })
        addToCompare.forEach((elem) => {
          elem.addEventListener('click', function(e){
            e.preventDefault();
            let id = e.target.dataset.id;
            let compareItem = load(`items/compare/${id}`)
            .then(res => {
              let compareItems = document.querySelector('#compare-items');
              compareItems.innerHTML = res;
              
            })
          })
        })
    })
}

function getOtherProducts(obj) {
    let otherItem = `
        <div class="col-3">
            <div class="card " >
                <img class="card-img-top other-card " src="/template/images/${obj.id}.jpg" alt="Card image cap">
                <div class="card-body">
                    <a href="/product/">
                        <p class="h6 other-name text-center">${obj.description}</p>
                    </a>
                    <div class="col-6">
                        <div class="input-group-append ">
						<span class="input-group-text my-3 mx-5 star-card">
							${getRatingStars(obj.rating)}
						</span>
                        </div>
                        <div class="input-group-append">
                            <input class="btn btn-outline-dark" type="button" value="&#x2661">
                            <a href="/compare/add/${obj.id}">
                                <input class="btn btn-outline-dark compare" data-id="${obj.id}" type="submit" value="&#8644;">
                            </a>
                            <span class="input-group-text bg-dark text-light  other-cost" for="inputGroupSelect02">${obj.cost}&#1423;</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>`;
return otherItem;
}
function getRatingStars(num){
	let rating = createRatingStars(num);
	return rating;
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