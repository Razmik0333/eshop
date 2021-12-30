import {CategoryBar} from "../CategoryBar.js";

let categories = new CategoryBar('/category/list');
let lists = new CategoryBar('/category/counts');


categories.renderCard().then(category => {
    lists.renderCard().then(list => {
        lists.getSelector().append(categories.createCard(category,list))
        
    })
    
})

