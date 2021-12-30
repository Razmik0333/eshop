async function load(url, obj) {
	let say = await import('./getResult.js');
	return say.getResult(url,obj);
}

//window.addEventListener("load", loadPage,false);

function loadPage()
{	
  let count = 0;
  load('/commodity/product')
	.then(obj => {
    console.log(obj);
    
    let productId = obj ['id'];
    let quantity = document.querySelector('.quantity')
    console.log("🚀 ~ file: view.js ~ line 18 ~ quantity", quantity)
   
      load('/commodity/productCount')
      .then(count => {
           let productItem1 = document.querySelector('.product-item');
           let countForSale = getCountProduct(count, productId);
           productItem1.innerHTML = getProductsById(obj,countForSale);
        }).then(() =>{
            let productQuantity = document.querySelector('.product-quantity')
            quantity.addEventListener('click', function (e) {
            e.preventDefault()
            let target = e.target;
            if (target.tagName === 'SPAN') return;
            if(target.classList.contains('add')){
              productQuantity.value++;
            }
            if(target.classList.contains('sub')){
              productQuantity.value <= 0 ? 0 : productQuantity.value--
            }
            

          })
        })
        
  })
  
  let header = `<nav class="navbar navbar-expand-lg navbar-light bg-light">
			
  <div class="collapse navbar-collapse" id="navbarText">
    <nav aria-label="breadcrumb ">
      <ol class="breadcrumb bg-light">
        <li class="breadcrumb-item"><a href="/">ԳԼԽԱՎՈՐ</a></li>
        <li class="breadcrumb-item"><a href="/category/filter/<?php echo $productById["alias"]?>"><?php echo $productById["arm_name"]?></a></li>
      </ol>
    </nav>					
  </div>
</nav>`;
  
  /*res => {
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
            load(`items/compare/${id}`)
            .then(res => {
              let compareItems = document.querySelector('#compare-items');
              compareItems.innerHTML = res;
              
            })
          })
        })
    })*/
}

function getOtherProducts(obj) {
    let otherItem = `
        <div class="col-3">
            <div class="card " >
                <img class="card-img-top other-card " src="/template/images/${obj.id}.jpg" alt="Card image cap">
                <div class="card-body">
                    <a href="/product/view/${obj.id}">
                        <p class="h6 other-name text-center">${obj.descr}</p>
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

function add(numm) {
  return numm++
}
