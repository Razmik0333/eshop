
async function load(url, obj) {
	let say = await import('./getResult.js');
	return say.getResult(url,obj);
}
window.addEventListener("load", loadPage,false);

function loadPage()
{
    let categories = document.querySelector('.category-items');
    load('/category/list')
    .then(res => {
        let template = '';
        for (const iterator of res) {	
            template += getCategories(iterator);
        }
        return template;
    }).then(result => {
        load('/category/counts')
        .then(counts => {
            //let arrCount = counts.sp
            let cart = getButtons(counts[0],'cart','list');
            let compare = getButtons(counts[1],'compare','items');
            let wishlist = getButtons(counts[2],'wishlist','page');
            categories.innerHTML = result + cart + compare + wishlist;
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
                <a class="nav-link cat-filter" href="/category/filter/${obj.alias}" data-alias="${obj.alias}">${obj.arm_name}</a>
            </li>`;
    }
    function getSearchItems(arr)
    {
        let	template = `<a href='/product/view/${arr['id']}'><li class="list-group-item">${arr['descr']}  </li></a>`
        return template;
    }
function getButtons(num,type,file){
	return `<li class="nav-item">
	<a href="/${type}/${file}">
		<button type="button" class="btn btn-warning ${type}-btn">
		<span class="badge badge-light ${type}-count" id="${type}-items" >${num}</span>
		</button>
	</a>
	</li>`;
}