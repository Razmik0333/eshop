import { BaseMethods } from "./BaseMethods.js"
import { Links } from "./Links.js"
import { Tag } from "./Tag.js"
import { TagWithTextContent } from "./TagWithTextContent.js"
class CartCard extends BaseMethods{
    constructor(){
        super()
    }
    listGroups = ['wishlist', 'compare','delete']
    insertImgToBlock(obj){
        return new Links('card card-comment',`/product/view/${obj.id}`, '')
        .insertContentOfBlocks({
            'a' : 'cart-link',
            'div' : 'col-4 kl'
        },this.getImg(obj))
    }
    insertLinksToSpan(obj){
        let span = new Tag('input-group-text bg-white cart-buttons').createElems('span')
        this.listGroups.forEach(item => {            
            span.append(this.createLinksAddButtons(item,obj))
        })
        return span
    }
    createCartCostCount(obj1, obj2){
        let span = new TagWithTextContent('input-group-text bg-white text-dark my-2',`${obj2[obj1.id]} x ${obj1.cost}֏`).createElems('span')
        let div  = new Tag('').insertContentOfBlocks({
            'div' : 'input-group-append'
        },span);
        
        return div;
    }
    createDescriptionHeader(obj){
        return new Links('cart-header h5',`/product/view/${obj.id}`,`${obj.descr}`).createElems('a');

    }

    createCartItemBody(obj,obj1){
        let descriptionHeader = this.createDescriptionHeader(obj);
        let createCartCostCount = this.createCartCostCount(obj,obj1);
        let ratingStars = this.ratingStars(obj);
        let desc = new TagWithTextContent('my-2 h5','Համառոտ նկարագրություն').createElems('div');
        let linksToSpan = this.insertLinksToSpan(obj);
        return new Tag('col-7')
        .insertContentsOfBlock('div',[descriptionHeader,createCartCostCount,ratingStars,desc,linksToSpan])

    }
    createCartCard(obj,obj1){
        let cartItemBody = this.createCartItemBody(obj,obj1);
        let imgBlock = this.insertImgToBlock(obj);
        let div = new Tag('row mt-3').insertContentsOfBlock('div',[imgBlock,cartItemBody]);
        let cartCard = new Tag('').insertContentOfBlocks({
            'div' : 'container card-item'
        },div) ;
        return cartCard;
    }

}

