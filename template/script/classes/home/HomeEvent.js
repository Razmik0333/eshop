import { ProductCard } from "./ProductCard.js";

class ProductEvent extends ProductCard {
    constructor(url){
        super(url);
    }
    selector = `product-item`;

   
    
    list(e){
        //console.log(e.target);
        
    }
    
    addItemsToCart(evt){
        let classList = evt.target.classList;
        let id = evt.target.dataset.id;
        if(classList.contains('cart')){
            let promise = new ProductEvent(`/list/cart/${id}/1`)
            .fetchGet(this.url)
            .then(res => {
                TagWithTextContent.setInnerText('.cart-count',res)
                Input.changeElemColor(evt.target);
                
               // console.log(res);
            }).catch((err) =>{
                //throw new Error(err);
                new ModalWindow().insertModalWindow('Ապրանքը չի ավելացվել զամբյուղ')

                 //
            }).then(() => {
                let m = new ModalEvent();
                m.listenEvent('click',m.closeModalWindow);
            })

        }
        return true;
    }
    addItemsToCompare(evt){
        let classList = evt.target.classList;
        let id = evt.target.dataset.id;
        if(classList.contains('compare')){
            let promise = new ProductEvent(`/items/compare/${id}`)
            .fetchGet(this.url)
            .then(res =>{
                TagWithTextContent.setInnerText('.compare-count',res)
                Input.changeElemColor(evt.target);
            })
        }
    }
    addItemsToWishlist(evt){
        let classList = evt.target.classList;
        let id = evt.target.dataset.id;
        if(classList.contains('wishlist')){
            let promise = new ProductEvent(`/wishlist/add/${id}`)
            .fetchGet(this.url)
            .then(res =>{
                TagWithTextContent.setInnerText('.wishlist-count',res)
                Input.changeElemColor(evt.target);
            })
        }
    }
}

// let v = new ProductEvent('/main');

// v.renderCard().then(() => {
//     //console.log('res');
    
//     v.listenEvent('click',v.addItemsToCart);
//     v.listenEvent('click',v.addItemsToCompare);
//     v.listenEvent('click',v.addItemsToWishlist);
// })


//.then(() => {
    // let w = 
    // .then(res => {

    //     console.log(res);
    // });

    
//})
// let ev = new ProductEvent('/list/product').fetchGet();
// console.log("🚀 ~ file: ProductEvent.js ~ line 24 ~ ev", ev)
//  console.log(v.listenEvent('click',v.addItemsToCart()));