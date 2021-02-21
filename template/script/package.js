async function load(url, obj) {
	let say = await import('./getResult.js');
	return say.getResult(url,obj);
}

window.addEventListener("load", loadPage,false);

function loadPage()
{
    let orderList = document.querySelector('.order-list');
    load('/package/data')
    .then(res => {
        let temp1 ='';
        for (const user_order of res) {
            let str = getIdsStringFromOrder(user_order['user_order']);
            load(`/package/product/${str}`).then(result => {
                let template = '';
                console.log(user_order);
                template += renderOrderInfo();
                for (const iterator of result) {
                    
                    console.log(iterator);
                    template += renderOrderProducts(iterator)
                }
                
                temp1 += template
                //console.log("🚀 ~ file: package.js ~ line 24 ~ load ~ temp1", temp1)
                
                orderList.innerHTML = temp1
            })
            
            
        }
    })
}
function getIdsStringFromOrder(str) {
    let objOfOrder = JSON.parse(str);
    let arrString = Object.keys(objOfOrder).join(',');
    return arrString;

}
function renderOrderInfo() {
    return `<div class="row bg-light p-1">
    <div class="col-4">
        <p class="mb-0">Պատվերի համարը։</p>
        <p class="mb-0">Պատվերի ժամանակը։</p>
    </div>
    <div class="col-4">
        <p class="mb-0">Օպերատորի Անվանումը։</p>
        <p class="mb-0"></p>
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
                        <h5 class="cart-header h5">${obj.desc}</h5>
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