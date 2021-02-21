window.addEventListener("load", loadPage,false);
async function load(url, obj) {
	let say = await import('./getResult.js');
	return say.getResult(url,obj);
}

function loadPage() {
    let compareItem = document.querySelector('.compare-item');
    load('/items/product')
    .then(res => {
        console.log(res);
        if(res){
            compareItem.innerHTML = renderCompare(res);
        }
    })
    .then(res => {
        let closeItem = document.querySelectorAll('.close-item');
        closeItem.forEach((item) => {
            item.addEventListener('click', function (e) {
                e.preventDefault();
                let id = e.target.dataset.id;
                console.log("id", id)
                let itemDelete = load(`/items/delete/${id}`)
                .then(res => {
                    compareItem.innerHTML = renderCompare(res);
                }).then(() => {
                    load(`/items/delete/${id}`)
                    .then(res => {
                        if(res){
                            compareItem.innerHTML = renderCompare(res);
                        }
                        else{
                            window.open('/')
                        }
                    })
                })
            })
        })
    })
}

function getCompareItem(obj) {
    let compareItem = 
    `<div class="col-3">
        <div class="card text-center" >
            <img class="card-img-top sale-img" src="/template/images/${obj.id}.jpg" alt="Card image cap">
            <a href="/compare/delete/${obj.id}"><button class="btn btn-outline-dark close-item position-absolute" data-id="${obj.id}" type="submit"><i class='fa fa-close'></i></button></a>
            <div class="card-body">
                <h5 class="card-title">${obj.desc}</h5>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">${obj.cost}&#1423;</li>
                <li class="list-group-item">${getAvailableStatus(obj.cost)}</li>
                <li class="list-group-item">${obj.main}</li>
            </ul>
        </div>
    </div>`;
    return compareItem;
}
function getAvailableStatus(num) {
    return +num === 0 ? 'ԱՌԿԱ ՉԷ' : 'ԱՌԿԱ Է';
}

function getCompareDescription() {
    let compareDescription = `			
    <div class="col-3 compare-description">
        <div class="card" >
            <div class="card-body">
                <h5 class="card-title">ՀԱՄԵՄԱՏՎՈՂ ԱՊՐԱՆՔՆԵՐ</h5>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">ԱՆՎԱՆՈՒՄ</li>
                <li class="list-group-item">ԳԻՆԸ</li>
                <li class="list-group-item">ԱՌԿԱՅՈՒԹՅՈՒՆ</li>
                <li class="list-group-item">ՆԿԱՐԱԳՐՈՒԹՅՈՒՆ</li>
            </ul>
        </div>
    </div>`;
    return compareDescription;
}
function renderCompare(obj){
    let compareTemplate = ``;
    compareTemplate += getCompareDescription();
    for (const iterator of obj) {
        compareTemplate += getCompareItem(iterator)
    }
    return compareTemplate;
}