import { ProductCard } from "./home/ProductCard.js";
class FilterProducts extends ProductCard {
    constructor(url){
        super(url)
    }
    selector = `product-item`;

    geturl(){
        return this.url;
    }

}
export { FilterProducts }