

async function load(url, obj) {
	let say = await import('../getResult.js');
	return say.getResult(url,obj);
}
window.addEventListener("load", loadPage,false);

function loadPage()
{
    load('/list/category')
    .then(cat => {
        console.log(cat);
        let productList = document.querySelector('.product-list');
        let modal = document.querySelector('.modal');
        
        productList.addEventListener('click', function (e) {
            e.preventDefault();
            let target = e.target;
            //if(e.target.tagName == 'I') return;
            if (target.classList.contains('create-product')) {
                let template = getForm(cat)

                modal.classList.add('modal-item');
                modal.innerHTML = template;
                let form = document.querySelector('.form');
                console.log(form);
                form.addEventListener('submit', function (e) {
                    e.preventDefault();

                    let formData = new FormData(form);
                    load('/admin/product/create',formData)
                    .then(res =>{
                        if (res) {
                            modal.innerHTML = getModalWindow('Ապրանքը հաջողությամբ ավելացվել է։', false) 
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
            console.log(e.target);
            if (target.classList.contains('update-product')) {
                let id = target.dataset.update;
                load(`/admin/product/item/${id}`)
                .then(prod => {
                    let template = getForm(cat, prod)
                    console.log(prod);
                    modal.classList.add('modal-item');
                    modal.innerHTML = template;
                    let form = document.querySelector('.form');
                    console.log(form);
                    form.addEventListener('submit', function (e) {
                        e.preventDefault();

                        let formData = new FormData(form);
                        load(`/admin/product/update/${id}`,formData)
                        .then(res =>{
                            console.log(res);
                            if (res) {
                                modal.innerHTML = getModalWindow('Ապրանքը հաջողությամբ փոփոխվել է։', false) 
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
            if (target.classList.contains('delete-product')) {
                let id = target.dataset.delete;
                modal.classList.add('modal-item');
                modal.innerHTML = getModalWindow('Դուք ցանկանում եք ջնջել տվյալ ապրանքը՞։',true) 
                modal.addEventListener('click', function (evt) {
                    let modalTarget = evt.target;
                    if (modalTarget.classList.contains('confirm')) {
                        console.log('confirm');
                        load(`/admin/product/delete/${id}`)
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
        })

    
    })

    function getCategoryList(arr, prod ={}) {
        let template = 
        `
        <option value="">
        Ընտրեք կատեգորիան
        </option>
        `;

        if (arr) {
            arr.forEach(element => {

                    template += `<option value="${element['alias']}" ${element['alias'] === prod['alias']? 'selected' : ''}>
                                     ${element['arm_name']}
                                </option>`;
            
            });
            return template;
        }
        return false;
            
    }
    function getForm(cat, prod = {}) {
        
        return `<div class="container">
        <div class="row">
        
            <div class="col-lg-6">
                <div class="login-form">
                    <form action="#" method="post" name="form" enctype="multipart/form-data" class="form">      
                        <p>ԱՆՎԱՆՈՒՄ</p>
                        <input type="text" name="descr" placeholder="" value="${prod['descr']||''}">
                        <p>ԱՐՏԻԿՈՒԼ</p>
                        <input type="text" name="1c_articul" placeholder="" value="${prod['1c_articul']||''}">
                        <p>ԱՐԺԵՔ, $</p>
                        <input type="text" name="cost" placeholder="" value="${prod['cost']||''}">
                        <p>Զեղչ, %</p>
                        <input type="text" name="discount" placeholder="" value="${prod['discount']||''}">
                        <p>ԿԱՏԵԳՈՐԻԱ</p>
                        <select name="alias" id="category">
                            ${getCategoryList(cat,prod)}
                        </select>
                        <p>ԸՆՏՐԵՔ ՆԿԱՐ</p>
                        <input type="file" name="image" placeholder="" value="">
                        <p>ՆԿԱՐԱԳՐՈՒԹՅՈՒՆ</p>
                        <textarea name="main">${prod['main']||''}</textarea>
                        <p>ԱՌԿԱՅՈՒԹՅՈՒՆԸ ՊԱՀԵՍՏՈՒՄ</p>
                        <select name="availabile">
                            <option value="1">ԱՅՈ</option>
                            <option value="0">ՈՉ</option>
                        </select>     
                        <p>ԱՌԱՋԱՐԿՎՈՂ</p>
                        <select name="is_recommended">
                            <option value="1" selected="selected">ԱՅՈ</option>
                            <option value="0">ՈՉ</option>
                        </select>
                        <input type="submit" name="submit" class="btn btn-default create" value="ՊԱՀՊԱՆԵԼ">
                     </form>
                </div>
            </div>
        </div>
    </div>
        `
    }
}