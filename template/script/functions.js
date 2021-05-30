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

function getModalWindow(str,survey) {
    let template = `<div class="modal-wind" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Ծանուցում</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>${str}</p>
        </div>`;
    let templateWithSurvey = `
      <div class="modal-footer">
        <button type="button" class="btn btn-primary confirm">ԱՅՈ</button>
        <button type="button" class="btn btn-secondary reject" data-dismiss="modal">ՈՉ</button>
      </div>`;
      let templateFooter = `
        </div>
      </div>
    </div>`;
    survey === true ? template += templateWithSurvey + templateFooter : template += templateFooter;
    return template;
}