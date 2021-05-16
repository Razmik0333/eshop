async function load(url, obj) {
	let say = await import('./getResult.js');
	return say.getResult(url,obj);
}

window.addEventListener("load", loadPage,false);

function loadPage()
{
    let accept;
    let send;
    let end;
    load('/package/data')
    .then(res => {
        let arr;
        let temp1 =``;
        let acceptDiv = document.querySelector('.accept');
        let orderList = document.querySelector('.order-list');
        arr = res;
        let orderTabs = document.querySelector('.order-tabs');

        orderTabs.addEventListener('click',function (e) {
            e.preventDefault();
            let target = e.target;
            if(target.tagName !== 'LI') return;
            let childs = target.parentNode.children;
            for (const iterator of childs) {
                iterator.classList.remove('active-tab');
            }
            target.classList.add('active-tab');
            if(res.length !== 0){
                if(target.dataset.order){
                    arr = res.filter(item => item.user_status == target.dataset.order)

                }else{
                    arr = res;
                }
                if(res.length !== 0){
                    let template = '';
                    for (const user_order of arr) {

                        let str = getIdsStringFromOrder(user_order['user_order']);
                        
                        load(`/package/product/${str}`)
                        .then(result => {
            
                            template += renderCardItem(user_order,result)
                        
                            orderList.innerHTML = template;
                            
                        })
                        
                        
                    }
                }
                else{
                    orderList.innerHTML = 'Պատվերներ Առկա չեն';
    
                } 
                template = '';
            }
            else{
                orderList.innerHTML = 'Պատվերներ Առկա չեն';

            }      


            
        });
        if(res.length !== 0){
            let template = '';
            for (const user_order of arr) {

                let str = getIdsStringFromOrder(user_order['user_order']);
                load(`/package/product/${str}`)
                .then(result => {
                    template += renderCardItem(user_order,result)
                    orderList.innerHTML = template;
                })
            }
        }else{
            orderList.innerHTML = 'Պատվերներ Առկա չեն';

        }
    })
}
function renderCardItem(user_order,result) {
    let template = '';
    template += renderOrderInfo(user_order['user_price']);
    template +=renderOrderList(result);
    return  template;
}
function renderOrderList(obj) {
    let template = '';
    for (const iterator of obj) {
        template += renderOrderProducts(iterator)
    }
    return template;
    //temp1 += template
}

function getIdsStringFromOrder(str) {
    let objOfOrder = JSON.parse(str);
    let arrString = Object.keys(objOfOrder).join(',');
    return arrString;

}
function renderOrderInfo(totalPrice) {
    return `<div class="row bg-light p-1">
    <div class="col-4">
        <p class="mb-0">Պատվերի համարը։</p>
        <p class="mb-0">Պատվերի ժամանակը։</p>
    </div>
    <div class="col-4">
        <p class="mb-0">Օպերատորի Անվանումը։</p>
        <p class="mb-0">Պատվերի արժեք՝ ${totalPrice}&#1423; </p>
    </div>
    <div class="col-4">
        Պատվերի Ընդհանուր Արժեքը։
        <p>Մինչ Պատվերի ավարտը Մնացել է։</p>
    </div>

</div>`
}
function renderOrderProducts(obj) {
    return `<div class="container "> 
            <div class="container border border-danger"> 
                <div class="row mt-3 mb-3 ">
                    <div class="col-4 cart-item kl">
                        <a href="/product/"> <img class="card-img-top"  src="/template/images/${obj['id']}.jpg" alt=""/></a>
                    </div>
                    <div class="col-4" >
                        <h5 class="cart-header h5">${obj.descr}</h5>
                        <div class="input-group-append">
                            <span class="input-group-text bg-white text-dark my-2" id="cart-cost" for="inputGroupSelect02">${obj['cost']}&#1423;</span>
                        </div>
                        <span class="input-group-text my-3 star-card" id="cart-rating" for="inputGroupSelect02">
                        ${createRatingStars(obj.rating)}

                        </span>
                        <div class="my-2 h5">Համառոտ նկարագրություն </div>
                        <div class="mx-1 p-2 cart-description">${obj.main}</div>
                        <button type="submit" class="btn btn-primary my-1 w-50" name="confirm">Հետևել</button><br>
                        <button type="submit" class="btn btn-danger my-1 w-50" name="confirm">Հաստատել</button>
                        
                    </div>
                </div>
            </div>
    </div>`
}