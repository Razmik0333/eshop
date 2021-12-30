import { Pagination } from "../Pagination.js"



let p = new Pagination('/goods/items');
p.listenEvent('load', (e) => {
    p.renderCard().then(res => {
        p.renderFirstData(res);
        p.currentElement = p.paginationRoot.children[1];
        p.prevPage = p.paginationRoot.firstElementChild; 
        p.nextPage = p.paginationRoot.lastElementChild; 
    })
},null)

p.listenEvent('click', (e) => {
    e.preventDefault()
    let target = e.target;
    if (target.classList.contains('disabled')) return 

    if(Number.isInteger(+target.dataset.page)) {
        p.currentElement = target.parentNode;
        p.currentPage = +target.dataset.page;
    }
    if(target.dataset.page == 'previous') {
        p.currentPage --;
        p.currentElement = p.currentElement.previousElementSibling
    };
    if(target.dataset.page == 'next') {
        p.currentPage ++;
        p.currentElement = p.currentElement.nextElementSibling;
    };
    p.changeColor(p.currentElement,'active');
    p.renderData(p.currentData); 
    console.log(p.currentData);
       
    p.changePrevDisabled(p.prevPage,p.currentPage)
    p.changeNextDisabled(p.nextPage,p.currentPage)
},'pagination-items');


