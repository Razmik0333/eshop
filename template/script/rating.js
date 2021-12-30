async function load(url, obj) {
	let say = await import('./getResult.js');
	return say.getResult(url,obj);
}
window.addEventListener("load", loadPage,false);

function loadPage()
{
    let productItem = document.querySelector('.product-item');
    productItem.addEventListener('click', function(e){
        let target = e.target;
        if(target.dataset.rating){
            e.preventDefault()
            let productId = target.dataset.product
            let productRating = target.dataset.rating
            load(`/rating/addRating/${productId}/${productRating}`).then(rating => {
                //console.log(rating);
                target.parentNode.innerHTML = getRatingStars(rating,productId)

            })

        } 
        

    })

    
}