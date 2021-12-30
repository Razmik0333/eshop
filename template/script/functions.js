async function load(url, data) {
	let say = await import('./getResult.js');
	return say.getResult(url,data);
}
function createRatingStars(value, id) {
	let rating = '';
	for (let i = 1; i <= 5; i++) {
		if (i <= Math.ceil(value)) {
			rating += `<a href="/rating/add/${i}"  class="fa fa-star stars rating-full" name="star" data-rating="${i}" data-product="${id}"  value=""></a><br>`;
		}else{
			rating += `<a href="/rating/add/${i}" class="fa fa-star stars rating-empty" name="star" data-rating="${i}" data-product="${id}"  value=""></a><br>`;
		}
	}
	return rating
}

function getRatingStars(num,id){
	let rating = createRatingStars(num,id);
	return rating;
}

function getModalWindow(str,survey) {
    let template = `<div class="modal-wind" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Ծանուցում</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>${str}</p>
        </div>`;
    let templateWithSurvey = `
      <div class="modal-footer">
        <button type="button" class="btn btn-primary confirm">ԱՅՈ</button>
        <button type="button" class="btn btn-secondary reject" data-dismiss="modal">ՈՉ</button>
      </div>`;
      let templateFooter = `
        </div>
      </div>
    </div>`;
    survey === true ? template += templateWithSurvey + templateFooter : template += templateFooter;
    return template;
}


 function getCountProduct(obj, val) {
//   console.log(obj);
//   let count = 0;
//   obj.forEach((element) => {
//     let arrayOfUserOrders = JSON.parse(element);
//     for (const key in arrayOfUserOrders) {
//         if(key === val) {
//           count+=arrayOfUserOrders[key];
//         }else{
//           continue;
//         }
        
//     }
//   });
   return true
 }
 
function getProductsById(obj, count) {
    return `<div class="row">
    <div class="col-5 prod-id" >
      <div class="img-part">
        <img src="${obj['url']}" alt="" id="item-img" class="position-relative">
        <input class="btn btn-outline-dark position-absolute" type="button" value="&#x2922;" id="resize">
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
      <div class="mx-auto my-2">
        <h4 id="item-name">${obj['descr']}</h4>
        <p class="font-weight-normal">Վաճառվել է ՝${count} հատ </p>

        <span class="input-group-text mx-auto my-3 star-card" id="item-rating" for="inputGroupSelect02">
          ${getRatingStars(obj['rating'],obj['id'])}                        

        </span>
      </div>
      <div class="input-group-append">
        <span class="input-group-text bg-dark text-light my-3" id="item-cost" for="inputGroupSelect02">${obj['cost']}&#1423;</span>
      </div>
      <div class="quantity">
        <div class="input-group-append  mx-auto my-3">
        
          <a href="/cart/add/${obj['id']}">
            <input class="btn btn-outline-dark mx-1 add-cart" data-id="${obj['id']}" type="button" value="&#128722; Add to Cart">
          </a>
          <a href="/cart/add/${obj['id']}">
            <input class="btn btn-outline-dark mx-1 wishlist" data-id="${obj['id']}" type="button" value="&#x2661;">
          </a>
          <a href="/compare/add/${obj['id']}">
            <input class="btn btn-outline-dark compare" data-id="${obj['id']}" type="submit" value="&#8644;">
          </a>
        </div>
        <div class="input-group-append  mx-auto my-3  ">
          <span class="mx-1">Quantity: </span>
          <input class="btn btn-outline mx-1 product-quantity" id="quantity" type="text" value="0">
          <input class="btn btn-outline-dark mx-1 sub" id="minus" type="button" value="-">
          <input class="btn btn-outline-dark mx-1 add" id="plus" type="button" value="+">
        </div>
      
      </div>
      
      <div class="mx-auto my-5">
        <div class="mx-2 h5">Համառոտ նկարագրություն </div>
        <div class="mx-1" id="content">${obj['main']}</div>
        
      </div>
      <div class="input-group-append  mx-auto my-2">
        <button type="button" class="btn btn-primary ml-2"><i class="fa fa-facebook mr-1" aria-hidden="true">   </i>  Share</button>
        <button type="button" class="btn btn-outline-dark ml-2"><i class="fa fa-google-plus mr-1" aria-hidden="true"></i>Google</button>
        <button type="button" class="btn btn-outline-dark ml-2"><i class="fa fa-twitter mr-1" aria-hidden="true"></i> Tweet</button>
        <button type="button" class="btn btn-outline-dark ml-2"><i class="fa fa-pinterest mr-1" aria-hidden="true"></i>Pinterest</button>
        <button type="button" class="btn btn-outline-dark ml-2"><i class="fa fa-linkedin mr-1" aria-hidden="true"></i>Linkedin</button>
        
      </div>
    </div>
    
  </div>`
}

function getSaleStatus(discount) {
	let img = `<img class="card-img-top sale" src="/template/images/other/sale.png" alt="Card image cap">`;
	return +discount > 0 ? img : '';
}

function addToList(obj,selector) {
  // console.log(obj);
  // console.log(selector);
	if(typeof obj === 'object'){
		for (const iterator of selector) {
			let id = iterator.dataset.id
			obj.forEach((elem,index) => {
        if (elem['id'] == id) {
					iterator.classList.remove('btn-outline-dark')
					iterator.classList.add('btn-dark')
				}
			});
		}
	}
	return true;
}