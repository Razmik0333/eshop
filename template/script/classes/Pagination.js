import { ProductCard } from "./home/ProductCard.js";
import { Links } from "./Links.js";
import { Tag } from "./Tag.js";
class Pagination extends ProductCard{
    onPage = 10;
    selector = `product-item`;
    currentElement;
    currentPage = 1;
    currentData = {};
    pageCount = 0;
    nextPage;
    prevPage;
    minCost;
    maxCost;
    selectedHighest = false;
    selectedButton;
    filterCost;
    searchField = document.querySelector('.search-field')
    paginationRoot = document.querySelector('.pagination-items')
    selectedButton = document.querySelector('.highest')
    get minCost(){
        return this.minCost;
    }
    get maxCost(){
        return this.maxCost;
    }
    set minCost(val){
        this.minCost = val;
        return this.minCost;
    }
    set maxCost(val){
        this.maxCost = val;
        return this.maxCost;
    }

    renderFirstData(obj){
        this.pageCount = this.getPageCount(obj)
        let selectorName = this.getSelector();
        this.getArrayFromInteraval(obj).forEach(item => {
            selectorName.append(this.createCard(item));
        })   
        this.renderPagination(this.pageCount);
        this.currentData = obj;
        
    }
    renderData(obj){
        let selectorName = this.getSelector();
        selectorName.innerHTML = ''
        this.getArrayFromInteraval(obj).forEach(item => {
            selectorName.append(this.createCard(item));
        })  
        this.currentData = obj;
 
    }
    
    getPageCount(obj){
        return Math.ceil(obj.length / this.onPage);
    }
    getStart(){
        return (this.currentPage - 1) * this.onPage;  /*1 0, 2 10*/
    }
    getFinal(){
        return this.currentPage * this.onPage - 1 ;  /*1 9, 2 19 3 29 4 39*/
    }
    getArrayFromInteraval(obj){
       return obj.filter((item,ind) =>  ind >= this.getStart() && ind <= this.getFinal());
    }
    checkContainsSelector(elem, sel){
        this.selectedHighest = elem.classList.contains(sel) ? true : false;
        
        return this.selectedHighest
    }
    checkInputsEmpty(){
        this.filterCost = this.minCost && this.maxCost ? true : false;
        return this.filterCost
    }
    renderNextPrevious(str){
        let datasetName = str.toLowerCase();
        let link = new Links(`page-link `,'#',`${str}`).createElems('a');
        Tag.addDatasets(link, {
            'page' : datasetName
        })
        let li = new Tag(`page-item ${(this.currentPage == 1 && str == 'Previous') || this.pageCount ==1 ? 'disabled' : ''}`).createElems('li')
        li.append(link);
        return li;
    }
    renderPages(numbers){
        
        let pageArr = []
        for (let i = 1; i <= numbers; i++) {
            let link = new Links('page-link ','#',`${i}`).createElems('a');
            Tag.addDatasets(link,{
                'page': i
            })
            let li = new Tag(`page-item ${i === this.currentPage ? 'active': ''}` ).createElems('li')
            li.append(link);
            pageArr.push(li)
        }
        return pageArr;
    }
    renderPagination(page_count){ 
        this.paginationRoot.append(this.renderNextPrevious('Previous'));
        let arrPages = this.renderPages(page_count);
        arrPages.forEach(elem => {
            this.paginationRoot.append(elem);
        })
        this.paginationRoot.append(this.renderNextPrevious('Next'));
        return this.paginationRoot;
        
    }
    changeColor(elem, className){
        let child = elem.parentElement.children
        for (const iterator of child) {
            iterator.classList.remove(className)
        }
        elem.classList.add(className)
        return true;        
    }
    

    changePrevDisabled(elem,page){
        if(page == 1){
            elem.classList.add('disabled')
        }else if(page > 1){
            elem.classList.remove('disabled')
        }  
    }
    changeNextDisabled(elem,page){
        if(+page == +this.pageCount){
            elem.classList.add('disabled')
        } if(page < this.pageCount){
            elem.classList.remove('disabled')
        }
    }
    sortArrayByCheap(res){                
        res.sort(function sortArr(obj1, obj2) {                
            if(+obj1.cost < +obj2.cost){
                return -1;
            }
            if(+obj1.cost > +obj2.cost){
                return 1;
            }
            return 0;
        });
        return res
    }
    sortArrayNewest(res){                
        res.sort(function sortArr(obj1, obj2) {                
            if(+obj1.id > +obj2.id){
                return -1;
            }
            if(+obj1.id > +obj2.id){
                return 1;
            }
            return 0;
        });
        return res
    }
    sortArrayByRating(res){                
        res.sort(function sortArr(obj1, obj2) {                
            if(+obj1.rating < +obj2.rating){
                return 1;
            }
            if(+obj1.rating > +obj2.rating){
                return -1;
            }
            return 0;
        });
        return res
    }
    getArrayByHighRatings(obj){
        return this.currentData = obj.filter(item => item.rating >= 4);
    }
    getArrayBetweenPrices(obj,a,b){ 
        return this.currentData = obj.filter(item => item.cost >= a && item.cost <= b);    
    }
    getCurrentData(obj){
        return this.currentData = obj
    }
    changePages(elem){
        for (const iterator of elem.children) {
            if(+iterator.textContent > this.pageCount){
                
                iterator.hidden = true ;
                
            }else{
                
                iterator.hidden = false ;
            }
        }
        return elem

        
    }

    actionFilter(obj,arr){
        if(arr.includes('rating')){
            
            this.getArrayByHighRatings(obj)
        }
        if(arr.includes('cost')){
            this.getArrayBetweenPrices(obj,this.minCost,this.maxCost)
        }
        if(arr.length == 0) this.getCurrentData(obj);
        
        return this.currentData
    }
}
export {Pagination};

// console.log(p.getStart()) // 1 -> 0  // 2 -> 10 // 3 -> 20
