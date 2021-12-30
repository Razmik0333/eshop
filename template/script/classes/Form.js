import { Tag } from "./Tag.js";
class Form extends Tag{
    constructor(className,action,method){
        super(className);
        this.action = action,
        this.method = method
    }
}

export {Form}