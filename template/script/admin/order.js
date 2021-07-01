

async function load(url, obj) {
	let say = await import('../getResult.js');
	return say.getResult(url,obj);
}
window.addEventListener("load", loadPage,false);

function loadPage()
{
    let orderList = document.querySelector('.order-list');
    let modal = document.querySelector('.modal');
    orderList.addEventListener('click', function (e) {
        e.preventDefault();
        let target = e.target;
        if(target.classList.contains('create-order')){
            modal.classList.add('modal-item');
            modal.innerHTML = getForm();
            let form = document.querySelector('.form');
            console.log(form);
            form.addEventListener('submit', function (e) {
                e.preventDefault();

                let formData = new FormData(form);
                load('/admin/order/create',formData)
                .then(res =>{
                    console.log(res);
                    if (res) {
                        modal.innerHTML = getModalWindow('Պատվերը հաջողությամբ ավելացվել է։', false) 
                    }
                }).then(() => {
                    let close = document.querySelector('.close');
                    close.addEventListener('click',function (e) {
                        e.preventDefault();
                        modal.classList.remove('modal-item')
                        
                    });
                })
            })
        }
        if(target.classList.contains('delete-order')){
            let id = target.dataset.delete;
            modal.classList.add('modal-item');
                modal.innerHTML = getModalWindow('Դուք ցանկանում եք ջնջել տվյալ Պատվերը',true) 
                modal.addEventListener('click', function (evt) {
                    let modalTarget = evt.target;
                    if (modalTarget.classList.contains('confirm')) {
                        console.log('confirm');
                        load(`/admin/order/delete/${id}`)
                        .then(res => {
                            if (res) {
                                console.log(modal);
                                modal.classList.add('modal-item');
                                modal.innerHTML = getModalWindow('Տվյալ Ապրանքը հաջողությամբ ջնջվել է։', false);
 
                            }
                        })
                        .then(() => {
                            if(modalTarget.tagName == 'SPAN') return;
                            if(modalTarget.classList.contains('close')){

                                modal.classList.remove('modal-item'); 
                            }
                        })
                    }
                    if(modalTarget.classList.contains('reject') || modalTarget.classList.contains('close')){
                        console.log(modalTarget);
                        if(modalTarget.tagName == 'SPAN') return;
                        modal.classList.remove('modal-item');    
                    }
                })


        }
        if(target.classList.contains('update-order')){
            let id = target.dataset.update;
            console.log("🚀 ~ file: order.js ~ line 78 ~ id", id)
            load(`/admin/order/item/${id}`)
            .then(res => {
                modal.classList.add('modal-item');
                modal.innerHTML = getUpdateForm(res);
                let form = document.querySelector('.form');
                    console.log(form);
                    form.addEventListener('submit', function (e) {
                        e.preventDefault();

                        let formData = new FormData(form);
                        load(`/admin/order/update/${id}`,formData)
                        .then(res =>{
                            console.log(res);
                            if (res) {
                                modal.innerHTML = getModalWindow('Պատվերը հաջողությամբ փոփոխվել է։', false) 
                            }
                        }).then(() => {
                            let close = document.querySelector('.close');
                            close.addEventListener('click',function (e) {
                                e.preventDefault();
                                modal.classList.remove('modal-item')
                                
                            });
                        })
                    })

            })
            
        }
    })
    function getForm() {
        return `
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="login-form">
                        <form action="#" method="post" class="form">

                            <p class="text-white text-center">ՀԱՃԱԽՈՐԴԻ ԱՆՈՒՆ</p>
                            <input type="text" name="user_name" placeholder="" value="">
                            <p class="text-white text-center">ՀԵՌԱԽՈՍԱՀԱՄԱՐ</p>
                            <input type="text" name="user_phone" placeholder="" value="">
                            <br/><br/>
                            <p class="text-white text-center">ԱՌԱՋԱՐԿՈՒԹՅՈՒՆ</p>
                            <textarea class="text-dark "name="user_comment" style="margin:0 46%"></textarea>
                            <p class="text-white text-center">ՊԱՏՎԵՐ</p>
                            <input type="text" name="user_order" placeholder="" value="">
                            <br/><br/>
                            <p class="text-white text-center">ՊԱՏՎԵՐԻ ԱՐԺԵՔ</p>
                            <input type="text" name="user_price" placeholder="" value="">
                            <br/><br/>
                            <input type="submit" name="submit" class="btn btn-default" value="Сохранить">

                            <br/><br/>
                        </form>
                    </div>
                </div>
            </div>
        </div>`;
    }
        function getUpdateForm(arr) {
            return `
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="login-form text-center ">
                            <form action="#" method="post" class="form">

                                <p>ԱՆՎԱՆՈՒՄ</p>
                                <input type="text" name="user_name" placeholder="" name="user_name" value="${arr['user_name']}">
                                
                    
                                <br/><br/>
                                <p>ՀԵՌԱԽՈՍ</p>
                                <input type="text" name="user_phone" placeholder="" value="${arr['user_phone']}">
                                <p>ՊԱՏՎԵՐԻ ՆԿԱՐՆԵՐԸ</p>
                                <input type="hidden" name="user_order" placeholder="" value='${arr['user_order']}'>
                                ${getProductsItems(arr['user_order'])}
                                <p>ԱՌԱՋԱՐԿՈՒԹՅՈՒՆ</p>
                                <input type="text" name="user_comment" placeholder="" value="${arr['user_comment']}">
                                <br/><br/>
                                <p>ՍՏԱՏՈՒՍ</p>
                                <select name="user_status" id="">
                                   ${renderStatusBar(arr['user_status'])}
                                
                                </select>
                                <input type="submit" name="submit" class="btn btn-default" value="Сохранить">

                                <br/><br/>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
            `
        }


        function renderStatusBar(status) {

            return  `
            <option >Ընտրեք ստատուսը</option>
            <option value="0" ${status == 0 ? 'selected' : ''}>Պատվերն ընդունված է</option>
            <option value="1"${status == 1 ? 'selected' : ''}>Պատվերն ուղարկվել է</option>
            <option value="2"${status == 2 ? 'selected' : ''}>Պատվերն հասել է պատվիրատուին</option>`;
        }
    function getProductsItems(str) {
        let template = '';
        let obj = JSON.parse(str);
        console.log("🚀 ~ file: order.js ~ line 164 ~ getProductsItems ~ arr", obj)
        
        for (const key in obj) {
            if (Object.hasOwnProperty.call(obj, key)) {
                const element = obj[key];
                template +=
                ` <p>ԱՊՐԱՆՔԻ ՔԱՆԱԿ<b> ${element}</b></p>
                <img src="/template/images/${key}.jpg" width="200" alt="" />`
            }
        }

        return template
    }
}   