async function load(url, obj) {
	let say = await import('../getResult.js');
	return say.getResult(url,obj);
}
window.addEventListener("load", loadPage,false);


function loadPage() {
    let categoryList = document.querySelector('.category-list');
    let modal = document.querySelector('.modal');
    categoryList.addEventListener('click', function (e) {
        e.preventDefault();
        let target = e.target;
        if(target.classList.contains('create-category')){
            modal.classList.add('modal-item');
            modal.innerHTML = getForm({});
            let form = document.querySelector('.form');
            console.log(form);
            form.addEventListener('submit', function (e) {
                e.preventDefault();

                let formData = new FormData(form);
                load('/admin/category/create',formData)
                .then(res =>{
                    console.log(res);
                    if (res) {
                        modal.innerHTML = getModalWindow('Կատեգորիան հաջողությամբ ավելացվել է։', false) 
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
        if(target.classList.contains('delete-category')){
            console.log('oopd');
            let id = target.dataset.delete;
            modal.classList.add('modal-item');
                modal.innerHTML = getModalWindow('Դուք ցանկանում եք ջնջել տվյալ Կատեգորիան',true) 
                modal.addEventListener('click', function (evt) {
                    let modalTarget = evt.target;
                    if (modalTarget.classList.contains('confirm')) {
                        console.log('confirm');
                        load(`/admin/category/delete/${id}`)
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
        if(target.classList.contains('update-category')){
            let id = target.dataset.update;
                load(`/admin/category/item/${id}`)
                .then(cat => {
                    console.log(cat);
                    let template = getForm(cat)
                    modal.classList.add('modal-item');
                    modal.innerHTML = template;
                    let form = document.querySelector('.form');
                    console.log(form);
                    form.addEventListener('submit', function (e) {
                        e.preventDefault();

                        let formData = new FormData(form);
                        load(`/admin/category/update/${id}`,formData)
                        .then(res =>{
                            console.log(res);
                            if (res) {
                                modal.innerHTML = getModalWindow('Կատեգորիան հաջողությամբ փոփոխվել է։', false) 
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
    function getForm(cat) {

      return  `<div class="container"> 
                <div class="row text-center">
                    <div class="col-lg-12">
                        <div class="login-form">
                            <form action="#" method="post" class="form">
                                <p class="text-light">ԱԼԻԱՍ</p>
                                <input type="text" name="alias" placeholder="" value="${cat['alias'] || ''} ">
                                <br/><br/>
                                <p class="text-light">ԱՆՎԱՆՈՒՄ</p>
                                <input type="text" name="arm_name" placeholder="" value="${cat['arm_name'] || ''}">
                                <input type="submit" name="submit" class="btn btn-default" value="Сохранить">

                                <br/><br/>
                            </form>

                            
                        </div>
                    </div>
                </div>
            </div>`
    }
}