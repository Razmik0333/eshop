import
 { Connect } from "./Connect.js";
import { Img } from "./Img.js";
import { Input } from "./Input.js";
import { Links } from "./Links.js";
import { Tag } from "./Tag.js";


class BaseMethods extends Connect {
    constructor(url){
        super(url)
    }
    selector = ``;
    //listGroups = ['cart', 'compare', 'wishlist'];

    listGroups = {
        'list':'cart',
        'items': 'compare',
        'page':'wishlist'
    };
    getSelector(){
        return document.querySelector(`.${this.selector}`)
    }
    renderCard(){        
        let prom = this.fetchGet(this.url).then(res =>{
            
            return res
            
        })
        return prom
    }
    listenEvent(method,callBack,eventSelector){
        console.log(eventSelector);
        
        let selectorName = eventSelector === null ? window : document.querySelector(`.${eventSelector}`);
        if (selectorName !== null) {
            return selectorName.addEventListener(method,callBack,false);
        }
        
        return 
    }
    addContentToTag(content, className,tagName){
        let elem = document.createElement(tagName);
        elem.className = className;
        elem.append(content)
        return elem;
    }
    getListIcon(typeButton , add = false){
        if (typeButton === 'cart') {
            return add === false ? '🛒' :'🛒 Add to Cart';
        }
        else if(typeButton === 'compare'){
            return '⇄';
        }
        else if(typeButton === 'delete'){
            return 'x';
        }
        else{
            return '♡';
        }
    }
    getImg(obj) {
        let img = new Img("card-img-top item-card",`/template/images/${obj['id']}.jpg`,`${obj['descr']}`)
                .createElems('img');       
        return img;
    }
    createAddButtons(obj,type,add){
        let input = new Input(`btn btn-outline-dark ${type}`,'button')
        .addText(this.getListIcon(type,add))
        
        .createElems('input');
            
        let inputFromDatasets = Tag.addDatasets(input,obj);
        return inputFromDatasets;
    }
    createLinksAddButtons(field,obj,add){
        let links;
            
        links = new Links('', `/${field}/add/${obj.id}`,'').createElems('a');
        links.append((this.createAddButtons({
            'id' : obj.id
        },field,add)));
        return links;
    }
    createRatingStars(obj){
        let span = this.ratingStars(obj);
        let div  = new Tag('').insertContentOfBlocks({
            'div' : 'input-group-append'
        },span)
        return div;
    }
    createStarsLinks(val, obj){

        let link = new Links('fa fa-star stars',`/rating/add/${val}`,'');;

        let arr = {
            rating : val,
            product : obj.id
        }
        let el = link.createElems('a');
        return Tag.addDatasets(el,arr)

     }
    ratingStars(obj){
        let rating = obj.rating;
        let span = new Tag('input-group-text my-3 mx-5 star-card')
        .createElems('span');
        Tag.addDatasets(span,{
            productid : obj.id
        })
        for (let i = 1; i <= 5; i++) {
            let a = this.createStarsLinks(i, obj);
            if (i <= Math.ceil(rating)) {
                a.classList.add('rating-full');
                span.append(a);
            }else{
                a.classList.add('rating-empty')
                span.append(a);
            }
        }
        return span
    }
    createCard(){
        return true
    }


    
    
}

export {BaseMethods};

