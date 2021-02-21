//'use strict';

window.addEventListener("load", loadPage,false);
async function load(url, obj) {
	let say = await import('./getResult.js');
	return say.getResult(url,obj);
}

function loadPage() {
    const onePage = 8;
    let page = 1;
    let current = page;
    let position;
    let arr;
    let total;
    let baseArray = [];
    let costMin = 0;
    let costMax = 0;
    let filter;
    let paginationItems = document.querySelector('.pagination-items');
    let child = paginationItems.children;
    let filterCost = document.querySelector('.filter-cost')
    let productItem = document.querySelector('.product-item');
    let filtersShow = document.querySelector('.filter-show');
    if (document.querySelector('.filters') !== null) {
        filter = load(`/filter/product`);

    }else{
        filter = load(`/filter/products`);
    }
    filter.then(res => {
        baseArray = res;
        if(document.querySelector('.filters') !== null){
            let filters = document.querySelector('.filters');
            filters.addEventListener('click', function (e) {
                let target = e.target;
                if (target.tagName !== 'A' || target.classList.contains('item-name')) return;
                e.preventDefault();
                if(target.dataset.value){
                    filtersShow.innerHTML = target.innerHTML;
                    setSelectedClass(target, target.parentElement.children,'selected');
                }
                if(target.dataset.value == 'newest'){
                    res.sort(function sortArr(obj1, obj2) {                
                        if(+obj1.id > +obj2.id){
                            return -1;
                        }
                        if(+obj1.id > +obj2.id){
                            return 1;
                        }
                        return 0;
                    });
                    baseArray = res;   
                }
                else if(target.dataset.value == 'cheap'){
                    res.sort(function sortArr(obj1, obj2) {                
                        if(+obj1.cost < +obj2.cost){
                            return -1;
                        }
                        if(+obj1.cost > +obj2.cost){
                            return 1;
                        }
                        return 0;
                    });
                    baseArray = res;   
    
                }
                else if(target.dataset.value == 'rating'){
                    res.sort(function sortArr(obj1, obj2) {                
                        if(+obj1.rating < +obj2.rating){
                            return 1;
                        }
                        if(+obj1.rating > +obj2.rating){
                            return -1;
                        }
                        return 0;
                    });
                    baseArray = res;   
    
                }
                else if(target.classList.contains('highest')){
                    if(target.classList.contains('selected')){
                        target.classList.remove('selected');
                        baseArray = res;
                        
                    }else{
                        setSelectedClass(target, target.parentElement.children,'selected');
                        baseArray = res.filter(elem => +elem.rating >= 4);
                    }
                }
                total = baseArray.length;  //
                let start = getStart(onePage,page);  // 1 -> 0  // 2 -> 8 // 3 -> 16
    
                let final = getFinal(onePage,page,total);
                if (start === 0) {
                    paginationItems.innerHTML = renderPagination(res, 'first');
                    current = 1;
                }
                
                setSelectedClass(child[page], child, 'active');
                arr = renderStartPage(baseArray,start, final); 
    
                productItem.innerHTML = renderGoods(arr);  //sorting array
                paginationItems.addEventListener('click', generatePage,false);
    
            })
            filterCost.addEventListener('keyup', function (e) {

                let target = e.target;
    
                if(e.target.tagName !== 'INPUT') return;
    
                target.classList.contains('cost-min') ?  costMin = +target.value : costMax = +target.value;
    
                let costBetween = res.filter(elem => +elem.cost >= costMin && +elem.cost <= costMax);   
    
                baseArray = costBetween;
                total = baseArray.length;  //
                let start = getStart(onePage,page);  // 1 -> 0  // 2 -> 8 // 3 -> 16
    
                let final = getFinal(onePage,page,total);
    
                if (start === 0) {
                    paginationItems.innerHTML = renderPagination(baseArray, 'first');
                    current = 1;
                }
                
                setSelectedClass(child[page], child, 'active');
                
                arr = renderStartPage(baseArray,start, final); 
    
                productItem.innerHTML = renderGoods(arr);  //sorting array
                paginationItems.addEventListener('click', generatePage,false);
            })
        } 
        let search = document.querySelector('#search');
        
        search.addEventListener('click', function (e) {
            e.preventDefault();
            let searchField = document.querySelector('#search-field');
            let value = searchField.value;
            if(searchField.value.length > 0){
                let arrHasWord = res.filter((item) => item.main.search(value) !== -1)
                baseArray = arrHasWord;
            }
            total = baseArray.length;  //
            let start = getStart(onePage,page);  // 1 -> 0  // 2 -> 8 // 3 -> 16

            let final = getFinal(onePage,page,total);
            if (start === 0) {
                paginationItems.innerHTML = renderPagination(baseArray, 'first');
                current = 1;
            }
            
            setSelectedClass(child[page], child, 'active');
            arr = renderStartPage(baseArray,start, final); 

            productItem.innerHTML = renderGoods(arr);  //sorting array
            paginationItems.addEventListener('click', generatePage,false);
        })
        
        total = baseArray.length;

        arr = renderStartPage(baseArray,page - 1, onePage - 1);

        paginationItems.addEventListener('click', generatePage,false);  //generate pagination

        function generatePage(e) {
            let target = e.target;
            e.preventDefault();
            
            if (target.tagName !== 'A') return;
            
            if (+target.dataset.page) {
                
                page = +target.dataset.page;
    
                current = page;
                
                let start = getStart(onePage,page);  // 1 -> 0  // 2 -> 8 // 3 -> 16

                let final = getFinal(onePage,page,total);
               
                let arr = renderStartPage(baseArray, start,final);

                if (page === 1 || start === 0) {

                    paginationItems.innerHTML = renderPagination(baseArray, 'first');
                }
                else if (page === Math.ceil(total / onePage)) {
                    paginationItems.innerHTML = renderPagination(baseArray, 'last');
                }
                else{
                    paginationItems.innerHTML = renderPagination(baseArray,'other');
                }
                
                setSelectedClass(child[page], child, 'active');
                
                productItem.innerHTML = renderGoods(arr);
            }
            if (target.dataset.position) {
                position = target.dataset.position;
                
                position === 'prev' ? --current : ++current;
                
                current > Math.ceil(total / onePage) ?  current = 1 : false; 
                
                if (current === 1) {
                    paginationItems.innerHTML = renderPagination(baseArray, 'first');
                }
    
                else if (current === Math.ceil(total / onePage)) {
                    paginationItems.innerHTML = renderPagination(baseArray, 'last');
                }
               
                let start = getStart(onePage,current);
    
                let final = getFinal(onePage,current,total);
           
                let arr = renderStartPage(baseArray, start, final);

                setSelectedClass(child[current], child, 'active');

                productItem.innerHTML = renderGoods(arr);
            }
           e.stopPropagation()
        }
        paginationItems.innerHTML = renderPagination(baseArray,'first');

        
        setSelectedClass(child[1], child, 'active');
        
        productItem.innerHTML = renderGoods(arr);
         
    })
}

function setSelectedClass(target, child, selector){
    if(child.length !== 0){
        for (const iterator of child) {
            iterator.classList.remove(selector);
        }
        target.classList.toggle(selector);
    }else{
        return false
    }
    return true;
}

function getGoodsItem(obj) {
    let productCard = `
    <div class="col-3 item-col">
        <div class="card text-center">
            <img class="card-img-top item-card" src="/template/images/${obj.id}.jpg" alt="${obj.title}" />
            ${getSaleStatus(obj.discount)}
            <div class="card-body pl-0 pr-0">
                <a href="/product/view/${obj.id}" class="h6 item-name">${obj.desc}</a>
                <div class="col-6 item-col">
                    <div class="input-group-append">
                        <span class="input-group-text my-3 mx-5 star-card" for="inputGroupSelect02">
                            ${createRatingStars(obj.rating)}
                        </span>
                    </div>
                    <div class="input-group-append">
                        <a href="/cart/add/${obj.id}">
                            <input class="btn btn-outline-dark add-cart" data-id="${obj.id}" type="button" value="🛒" />
                        </a>
                        <a href="/compare/add/${obj.id}">
                            <input class="btn btn-outline-dark compare" data-id="${obj.id}" type="submit" value="&#8644;" />
                        </a>												
                        <span class="input-group-text bg-light text-dark" for="inputGroupSelect02">${obj.new_cost}&#1423;</span>
                        <span class="input-group-text bg-secondary text-light " for="inputGroupSelect02"><del>${obj.cost}</del>&#1423;</span>
                    </div>
                </div>
            </div>
        </div>
    </div>`;
	return productCard;
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
    if (obj.length !== 0 ) {
        for (const iterator of obj) {
            goodsTemplate += getGoodsItem(iterator)
        }
    }else{
        goodsTemplate = 'Արդյունքներ չեն ստացվել';
    }
    return goodsTemplate;
}

function renderPagination(arr, position) {
    let paginationTemplate = ``;

    let total = arr.length;

    let onePage = 8;

    let page= Math.ceil(total / onePage);

    if(total > onePage){
        if (position === 'first') {
            paginationTemplate += `<li class="page-item page-link">Previous</li>`
            for (let i = 1; i <= page; i++) {
                paginationTemplate += `<li class="page-item"><a class="page-link pagination-links" href="#" data-page="${i}">${i}</a></li>`;
            }
            paginationTemplate += `<li class="page-item"><a class="page-link" href="#" data-position="next">Next</a></li>`
        }else if(position === 'last'){
            paginationTemplate += `<li class="page-item"><a class="page-link page-overflow" href="#" data-position="prev">Previous</a></li>`
            for (let i = 1; i <= page; i++) {
                paginationTemplate += `<li class="page-item"><a class="page-link pagination-links" href="#" data-page="${i}">${i}</a></li>`;
            }
            paginationTemplate += `<li class="page-item page-link">Next</li>`
        }else if(position === 'other'){
            paginationTemplate += `<li class="page-item"><a class="page-link page-overflow" href="#" data-position="prev">Previous</a></li>`
            for (let i = 1; i <= page; i++) {
                paginationTemplate += `<li class="page-item"><a class="page-link pagination-links" href="#" data-page="${i}">${i}</a></li>`;
            }
            paginationTemplate += `<li class="page-item"><a class="page-link" href="#" data-position="next">Next</a></li>`
        }
    }else if(total <= onePage){
        paginationTemplate = '';
    }
    return paginationTemplate;
}

function renderStartPage(obj, start, final) {
    let arr = [];
    for (let i = start; i <= final; i++) {
        arr.push(obj[i]);
    }
    
    return getNonEmptyElements(arr)
}


function getFinal(onePage,current,total){
    let final = onePage * current < total ?  current * onePage - 1 : total - 1;
    return final;
}

function getStart(onePage, page) {
    return onePage * (page - 1);

}
function getNonEmptyElements(arr) {
    return arr.filter((item) => item !== undefined);
}