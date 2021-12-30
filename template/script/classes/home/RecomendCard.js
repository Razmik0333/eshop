import { BaseMethods } from "../BaseMethods.js";
import { Tag } from "../Tag.js";
import { TagWithTextContent } from "../TagWithTextContent.js";
import { Links } from "../Links.js";
import { Img } from "../Img.js";
class RecomendCard extends BaseMethods{
    constructor(url){
        super(url);
    }
    selector = `product-recomended`;
    // productItem(){
    //     return document.querySelector(`.${this.selector}`)
    // }
    // renderCard(selector){
        
    //     let selectorNAme = document.querySelector(selector)
    //     let promise = this.fetchGet(this.url).then(res =>{
    //         res.forEach(item => {
    //             selectorNAme.append(this.createRecomendCard(item));
                
    //         })
            
    //     })
    //     return selectorNAme
    // }
    getFullDate(obj){
        let month = new Date(+obj.time_add).getMonth() + 1;
        let date = new Date(+obj.time_add).getDate();
        if (month > 0 && month < 9) {
            month = `0${month}`
        }
        if (date > 0 && date < 9) {
            date = `0${date}`
        }
        
        return `${new Date(+obj.time_add).getFullYear()}-${month}-${date}`;
    }
    createRecomendBody(obj){

        let heading5 = new TagWithTextContent("card-title",`${obj.descr}`).createElems('h5');
        let link  = new Links("",`/product/view/${obj.id}`,'').insertContentOfBlocks({
            'a' : ''
        },heading5);
        
        let datePart = new TagWithTextContent('mx-auto',`${this.getFullDate(obj)}`).createElems('span');
        let desc = new TagWithTextContent('card-text',`${obj['descr']}`).createElems('p');
        let recomendCartBody  = new Tag("card-body text-center")
        .insertContentsOfBlock('div',[link,datePart,desc]);
        return recomendCartBody;
    }
    createRecomendCard(obj){
        let cardBody = this.createRecomendBody(obj);
        let recImg = new Img('card-img',`/template/images/${obj.id}.jpg`,`${obj.descr}`).createElems('img');
        let imgSale = new Img('card-img-top sale',`/template/images/other/sale.png`,`${obj.descr}`).createElems('img');
        let recomendCart  = new Tag("col-4 card card-comment")
        .insertContentsOfBlock('div',[recImg,imgSale,cardBody]);
        return recomendCart;
        
    }
    
}

export {RecomendCard}