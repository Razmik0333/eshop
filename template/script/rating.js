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
            load(`/rating/addRating/${productId}/${productRating}`).then(res => {
                let starCard = document.querySelectorAll('.star-card');
                load(`/rating/product/${productId}`).then(res => {
                    console.log(res.rating);
                    starCard.innerHTML = getRatingStars(res.rating,res.id)
                })
            })

        } 
        

    })

    
}