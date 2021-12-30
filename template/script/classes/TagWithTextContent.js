import { Tag } from "./Tag.js";
class TagWithTextContent extends Tag{
    constructor(classList,innerText){
        super(classList);
        this.innerText = innerText; 
    }
    static setInnerText(tag,value){ 
        let elem = document.querySelector(tag);
        elem.innerText = value;
    }
    
}


export {TagWithTextContent};
