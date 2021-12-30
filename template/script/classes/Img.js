import { Tag } from "./Tag.js";

class Img extends Tag{
    constructor(className,src,alt){
        super(className)
        this.src = src,
        this.alt = alt
    }
    
}
export {Img};
