import { BaseMethods } from "./BaseMethods.js";
import { Img } from "./Img.js";
import { Input } from "./Input.js";
import { Tag } from "./Tag.js";
import { TagWithTextContent } from "./TagWithTextContent.js";


class ProductPage extends BaseMethods{
    constructor(url){
        super(url);
    }

    getProductHeader(obj,num){
        let h4 = new TagWithTextContent('item-name',`${obj['descr']}`)
        .createElems('h4')
        let p = new TagWithTextContent('font-weight-normal',`Վաճառվել է ${num}հատ`)
        .createElems('p');
        let span = this.ratingStars(obj);
        return new Tag('mx-auto my-2')
        .insertContentsOfBlock('div', [h4, p, span])
    }
    getCost(obj){
        let span = new TagWithTextContent('input-group-text bg-dark text-light my-3',`${obj['cost']}֏`)
        .createElems('span');
        return new Tag('input-group-append').insertContentsOfBlock('div',[span]);
        
    }
    addLinksToList(obj){
        let div = new Tag('input-group-append  mx-auto my-3')
        .createElems('div');
        let object =  this.listGroups;
        for(const key in  object) {            
           div.append(this.createLinksAddButtons(object[key],obj,true))
       }
       return div;
    }
    getItemsChange(){
        let span = new TagWithTextContent('mx-1','Quantity: ').createElems('span');
        let productQuantity= new Input('btn btn-outline mx-1 product-quantity','button').addText('0').createElems('input')
        let add = new Input('btn btn-outline-dark mx-1 sub','button').addText('-').createElems('input')
        let sub = new Input('btn btn-outline-dark mx-1 add','button').addText('+').createElems('input')
        return new Tag('input-group-append  mx-auto my-3').insertContentsOfBlock('div',[span,productQuantity,add,sub])
        
    
    }
    addToQuantity(obj){
      return  new Tag('quantity')
        .insertContentsOfBlock('div',[this.addLinksToList(obj),this.getItemsChange()]);

    }
    createDescription(obj){
        let descHeader = new TagWithTextContent('mx-2 h5','Համառոտ նկարագրություն')
        .createElems('div')
        let descContent = new TagWithTextContent('mx-1',`${obj['main']}`)
        .createElems('div');
        return new Tag('mx-auto my-5')
        .insertContentsOfBlock('div', [descHeader, descContent])
    }
    createShareButtons(){
        let object = {
            'facebook' : 'Share',
            'google-plus' : 'Google',
            'twitter' : 'Tweet',
            'pinterest' : 'Pinterest',
            'linkedin' : 'Linkedin',
          }
          let div = new Tag('input-group-append  mx-auto my-2').createElems('div');
          for (const key in object) {
                let i = new Tag(`fa fa-${key} mr-1`).createElems('i');
                let button = new Tag(`btn btn-${key === 'facebook'? 'primary' : 'outline-dark'} ml-2`).createElems('button');
                button.append(i);
                button.insertAdjacentText('beforeEnd', object[key])
                div.append(button);
          }
        
       
        return div
    }
    createRightSide(obj){
        let div = new Tag('col-7 p-1').insertContentsOfBlock('div',
        [this.getProductHeader(obj, 6),
             this.getCost(obj),
             this.addToQuantity(obj),
             this.createDescription(obj),
             this.createShareButtons()]
        );
        return div

    }
    createImgPart(obj){
        let img = new Img("item-img position-relative",`/template/images/${obj['id']}.jpg`,`${obj['descr']}`)
        .createElems('img');  
        let input = new Input('btn btn-outline-dark position-absolute resize', 'button')
        .addText('⤢')
        .createElems('input')   
        return new Tag('img-part').insertContentsOfBlock('div',[img, input])

    }
    createLeftSide(obj){
        let imgPart = this.createImgPart(obj);
        let div = new Tag('').insertContentOfBlocks({
            'div' : 'col-5 prod-id'
        },imgPart)
        return div;
    }
    productCard(obj){
        let leftSide = this.createLeftSide(obj);
        let rightSide = this.createRightSide(obj);
        return new Tag('row').insertContentsOfBlock('div', [leftSide, rightSide])

    }
}


let pr = new ProductPage('/commodity/product');

