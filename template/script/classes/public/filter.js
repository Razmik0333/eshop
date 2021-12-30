import { Pagination } from "../Pagination.js"

 
//let p = new Pagination('/category/filter');
let p = new Pagination('/filter/product');
p.listenEvent('load', (e) => {
    p.renderCard().then(res => {  
        p.onPage = 8;  
        p.renderFirstData(res);
        p.currentElement = p.paginationRoot.children[1];
        p.prevPage = p.paginationRoot.firstElementChild; 
        p.nextPage = p.paginationRoot.lastElementChild; 
    })
},null);

p.listenEvent('click', (e) => {
    e.preventDefault();   

    let target = e.target;
    let value = target.dataset.value;
    let filterShow = document.querySelector('.filter-show');

    if(value !== undefined){
        if(value == 'cheap'){
            p.sortArrayByCheap(p.currentData);
        }
        if(value == 'newest'){
            p.sortArrayNewest(p.currentData);
        }
        if(value == 'rating'){
            p.sortArrayByRating(p.currentData);                     
        }
        p.currentPage = 1;
        p.currentElement = p.paginationRoot.children[1];      
        p.renderData(p.currentData);
        p.changeColor(p.currentElement,'active');
        filterShow.innerText = target.innerText;
        p.changePrevDisabled(p.prevPage,p.currentPage);
        p.changeNextDisabled(p.nextPage,p.currentPage);
    }
    
},'sort');
p.listenEvent('change', (e) => {
    e.preventDefault();
    let target = e.target; 
    p.renderCard().then(res => {
        if(target.classList.contains('cost-max')){
            p.maxCost = target.value
        }else if(target.classList.contains('cost-min')){
            p.minCost = target.value
        }
        if(p.checkInputsEmpty()){
            if (p.selectedHighest) {
                p.actionFilter(p.currentData,['cost','rating']);
            }
            else{
                p.actionFilter(p.currentData,['cost'])
            }
        }
        if(p.minCost === '' && p.maxCost === ''){
            p.selectedHighest ? p.actionFilter(res,['rating']) : p.currentData = res
        }
        p.currentElement = p.paginationRoot.children[1];  //page 1      
        p.currentPage = 1;
        p.pageCount = p.getPageCount(p.currentData);
        p.changePages(p.paginationRoot)
        p.renderData(p.currentData);
        p.changeColor(p.currentElement,'active');
        p.changePrevDisabled(p.prevPage,p.currentPage);
        p.changeNextDisabled(p.nextPage,p.currentPage);
    })
},'filter-cost');
p.listenEvent('click', (e) => {
    e.preventDefault();   
    let target = e.target;     
    p.renderCard().then(res => {
        if(target.classList.contains('highest')){
            p.selectedButton = target;
            if (p.checkContainsSelector(p.selectedButton,'selected')) {
                target.classList.remove('selected');
                p.selectedHighest = false;
                if(p.filterCost){
                    p.actionFilter(res,['cost']);
                }else{
                    p.actionFilter(res,[])
                }
            }else{
                target.classList.add('selected');
                p.actionFilter(p.currentData,['rating']); 
                p.selectedHighest = true;
            }
            p.pageCount = p.getPageCount(p.currentData);
            p.currentElement = p.paginationRoot.children[1];  //page 1      
            p.currentPage = 1;
            p.changePages(p.paginationRoot)
            p.renderData(p.currentData);
            p.changeColor(p.currentElement,'active');
            p.changePrevDisabled(p.prevPage,p.currentPage)
            p.changeNextDisabled(p.nextPage,p.currentPage)
        }
    })
},'high-rate');

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
    p.changePrevDisabled(p.prevPage,p.currentPage)
    p.changeNextDisabled(p.nextPage,p.currentPage)
},'pagination-items');
