window.addEventListener("load", loadPage,false);
async function load(url, obj) {
	let say = await import('./getResult.js');
	return say.getResult(url,obj);
}


function loadPage() {
    let user;
    let template = '';
    let cabinet = document.querySelector('.cabinet');
    load('/profile')
    .then(res => {
        user = res;
        console.log("🚀 ~ file: page.js ~ line 12 ~ loadPage ~ cabinet", user)
        template = `<h5>Բարև ${user['name']}</h5>`;
        if(user['role']=='admin'){
            template += `
            <ul class="nav justify-content-start">
                <li class="nav-item">
                    <a class="nav-link" href="/cabinet/edit">ՓՈԽԵԼ ԱՆՁՆԱԿԱՆ ՏՎՅԱԼՆԵՐԸ</a>
                    <a class="nav-link" href="/admin">ՄՈՒՏՔ ԳՈՐԾԵԼ ԱԴՄԻՆ ԷՋ</a>
                </li>
            </ul>`
        }else{
            template += `
            <ul class="nav justify-content-start">
                <li class="nav-item">
                    <a class="nav-link" href="/cabinet/edit">ՓՈԽԵԼ ԱՆՁՆԱԿԱՆ ՏՎՅԱԼՆԵՐԸ</a>
                </li>
            </ul>`
        }
        template += `
`
        cabinet.innerHTML = template;
    })

    load('package/data')
    .then(res => {
        res.forEach(element => {
            console.log(element['user_status']);
        });
    })
   /* .then(res => {
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
    })*/
}