import { ProductCard } from "./home/ProductCard.js";
class Catalog extends ProductCard {
    constructor(url){
        super(url);
        
    }
    //
    selector = `product-item`;

    static geturl(){
        return this.url;
    }

}
