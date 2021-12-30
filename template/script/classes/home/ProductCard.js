import { BaseMethods } from "../BaseMethods.js";
import { Img } from "../Img.js";
import { Links } from "../Links.js";
import { Tag } from "../Tag.js";
import { TagWithTextContent } from "../TagWithTextContent.js";
class ProductCard extends BaseMethods{
    constructor(url){
       super(url);
    }
   selector = 'product-item';
    getSaleImg(obj) {
        let img = new Img("card-img-top sale","/template/images/other/sale.png","Sale")
                  .createElems('img')
       
        return +obj.discount > 0 ? img : '';
    }


    createButtonsArray(obj){
        let links = [];
        let url;
        this.listGroups.forEach((item) =>{
            url = `/${item}/add/${obj.id}`
            if (!links.includes(url)) {
                links.push(url)
            }
        })
        return links;
    }
    getNewCost(num){
        //let num = 0;
        let span = new TagWithTextContent('btn btn-outline-success my-sm-0',`${num}`).createElems('span');
        
        return  span;
         
    }
    getNum(cost, discount){
        let num = 0
        return  num = discount > 0 ? cost * (1 - discount / 100) : cost;
    }
    addHideClass(span, discount){
        let sp = span;
      
        if (discount == 0 ) {
            sp.classList.add('cost-hidden');
        }
        return sp
    }
    createSpanTemplate(obj, newCost){
        
        let num = 0 ;
        let span ;
        if (newCost) {
            num = this.getNum(obj.cost, obj.discount)
            span = this.getNewCost(`${num}֏`,obj.discount) ;
            span.classList.add('bg-dark', 'text-light');
        }else{
            num = obj.cost
            span = this.getNewCost(``,+obj.discount) ;
            let del = new TagWithTextContent(``,`${num}֏`).createElems('del') ;
            span.append(del)
            span.classList.add('bg-light', 'text-dark');
           span = this.addHideClass(span,obj.discount);
        }
        return span;
     }
    createActionBar(obj){
        let ul = this.addLinksToList(obj);
        let a = [false, true];
        a.forEach(elem =>{
            let li = new Tag(' pr-0').createElems('li');
            elem === false ? li.classList.add('ml-2') : '';
            li.append(this.createSpanTemplate(obj,elem));
            ul.insertAdjacentElement('beforeend',li);
        })
        return ul;
    }

    addLinksToList(obj){
        let ul = new Tag('navbar-nav mr-auto').createElems('ul');   
        for (const key in this.listGroups) {
            if (Object.hasOwnProperty.call(this.listGroups, key)) {
                const element = this.listGroups[key];
                let li = new Tag(' pl-0 pr-0').createElems('li');
                let link = this.createLinksAddButtons(element,obj);
                li.append(link);
                ul.append(li);
            }
        }
        return ul;
    }
    addActionBarToBlock(obj){
        let content = this.createActionBar(obj);
        const tag = new Tag('').insertContentOfBlocks({
            'div': "collapse navbar-collapse",
            'nav' : 'navbar-expand-lg navbar-light input-group-append home-inputs'
        },content);
        return tag;
    }
    
    createColumnItem(obj){
        return  new Tag('col-6')
                .insertContentsOfBlock('div',
                [this.createRatingStars(obj),this.addActionBarToBlock(obj)]);
    }
    createCardBody(obj){
        
        const link = new Links('h6 item-name',`/product/view/${obj.id}`,`${obj.descr}`).createElems('a');
        let columnItem = this.createColumnItem(obj);
       return new Tag('card-body text-center item-body').insertContentsOfBlock('div',[link,columnItem])
    }
    createCard(obj){
        
        let cardBody = this.createCardBody(obj);
        let imgSale = this.getSaleImg(obj);
        let imgProduct = this.getImg(obj);
        let cardObj = new Tag('card');
        let card = imgSale === '' ? 
        
        cardObj.insertContentsOfBlock('div',[imgProduct,cardBody]) :
        
        cardObj.insertContentsOfBlock('div',[imgSale,imgProduct,cardBody]);
        
        let itemCol = new Tag('').insertContentOfBlocks({
            'div': "col-3 item-col  "
        },card);

        return itemCol;  
    }
}

export {ProductCard};