function createRatingStars(value, id) {
	let rating = '';
	for (let i = 1; i <= 5; i++) {
		if (i <= value) {
			rating += `<a href="/rating/add/${i}"  class="fa fa-star stars rating-full" name="star" data-rating="${i}" data-product="${id}"  value=""></a><br>`;
		}else{
			rating += `<a href="/rating/add/${i}" class="fa fa-star stars rating-empty" name="star" data-rating="${i}" data-product="${id}"  value=""></a><br>`;
		}
	}
	return rating
}

function getRatingStars(num,id){
	let rating = createRatingStars(num,id);
	return rating;
}