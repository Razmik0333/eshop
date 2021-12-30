import { ProductCard } from "../home/ProductCard.js"

let p = new ProductCard('/main');
p.renderCard().then(res => {
    res.forEach(element => {
        p.getSelector().append(p.createCard(element))
        
    });
    
})
