
async function load(url, obj) {
	let say = await import('./getResult.js');
	return say.getResult(url,obj);
}
window.addEventListener("load", loadPage,false);

function loadPage()
{
    let categories = document.querySelector('.category-items');
    load('/list/category')
    .then(res => {
        let template = '';
        for (const iterator of res) {	
            template += getCategories(iterator);
        }
        return template;
    }).then(result => {
        load('/list/countItems')
        .then(res => {
            let arrCount = res.split(' ');
            let text = getCartCompareButtons(arrCount[0],'cart','list');
            categories.innerHTML = result + text;
            })
        })
        
    let searchField = document.querySelector('#search-field'); 
	searchField.addEventListener('keyup',function () {
		let searchItems = document.querySelector('.search-items');
		if(searchField.value.length > 0){
			load(`/main/search/${searchField.value}`)
			.then(res => {
				let template = '<ul class="list-group">';
				for (const iterator of res) {	
					template += getSearchItems(iterator);
                }
                template+= '</ul>';
                searchItems.innerHTML = template;
                searchItems.style.visibility = 'visible';
                searchItems.style.zIndex = '100000';
            })
		}
		document.body.addEventListener('click', function (e) {
			searchItems.style.visibility = 'hidden';
		})
    });

}

    function getCategories(obj){
        return `<li class="nav-item">
                <a class="nav-link cat-filter" href="/catalog/filter/${obj.alias}" data-alias="${obj.alias}">${obj.arm_name}</a>
            </li>`;
    }
    function getSearchItems(arr)
    {
        let	template = `<a href='/product/view/${arr['id']}'><li class="list-group-item">${arr['desc']}  </li></a>`
        return template;
    }
function getCartCompareButtons(num,type,file){
	return `<li class="nav-item">
	<a href="/${type}/${file}">
		<button type="button" class="btn btn-warning ${type}-btn">
		<span class="badge badge-light ${type}-count" id="${type}-items" >${num}</span>
		</button>
	</a>
	</li>`;
}