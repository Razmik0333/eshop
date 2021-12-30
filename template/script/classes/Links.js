import { Tag } from "./Tag.js";
class Links  extends Tag{
    constructor(className,href,innerText){
        super(className);
        this.href = href
        this.innerText = innerText

    }
}

export { Links }