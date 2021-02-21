window.addEventListener("load", loadPage,false);
async function load(url, obj) {
	let say = await import('./getResult.js');
	return say.getResult(url,obj);
}

function loadPage() {
    let goodsCard = document.querySelector('.goods-card');
    let search = document.querySelector('#search');
        
    search.addEventListener('click', function (e) {
        e.preventDefault();
        let searchField = document.querySelector('#search-field');
        if(searchField.value.length > 0){
            let search = load(`/goods/search/${searchField.value}`)
            .then(res => {
                console.log(res);
                
                let condition = Object.entries(res).length === 0 ? 
                'Արդյունք չի գտնվել' : renderGoods(res) ;
                goodsCard.innerHTML = condition;
            })
        }
    })

}

function getGoodsItem(obj) {
	let productCard = `<div class="col-3">
    <div class="card">
        <img class="card-img-top item-card" src="/template/images/${obj.id}.jpg" alt="${obj.title}">
        ${getSaleStatus(obj.discount)}
        <div class="card-body text-center">
            <a href="/product/view/${obj.id}" class="h6 item-name">${obj.desc}</a>
            <div class="col-6">
                <div class="input-group-append ">
                    <span class="input-group-text my-3 mx-5 star-card" for="inputGroupSelect02">
                        ${createRatingStars(obj.rating)}
                    </span>
                </div>
                <div class="input-group-append">
                    <a href="/cart/add/${obj.id}">
                        <input class="btn btn-outline-dark add-cart" data-id="" type="submit" value="🛒">
                    </a>
                    <input class="btn btn-outline-dark" type="button" value="&#8644;">
                    <span class="input-group-text bg-light text-dark" for="inputGroupSelect02">${obj.new_cost}&#1423;</span>
                    <span class="input-group-text bg-secondary text-light " for="inputGroupSelect02"><del>${obj.cost}&#1423;</del></span>											
                </div>
                </div>
            </div>
        </div>
    </div>`;
	return productCard;
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

function getSaleStatus(discount) {
	let img = `<img class="card-img-top sale" src="/template/images/other/sale.png" alt="Card image cap">`;
	return +discount > 0 ? img : '';
}

function getRatingStars(num){
	let rating = createRatingStars(num);
	return rating;
}

function renderGoods(obj){
    let goodsTemplate = ``;
    //goodsTemplate += getCompareDescription();
    for (const iterator of obj) {
        goodsTemplate += getGoodsItem(iterator)
    }
    return goodsTemplate;
}
