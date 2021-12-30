import { RecomendCard } from "../home/RecomendCard.js";

let r = new RecomendCard('/main/recomend')

r.renderCard().then(res => {
    res.forEach(element => {        
        r.getSelector().append(r.createRecomendCard(element))
        
    });
    
})