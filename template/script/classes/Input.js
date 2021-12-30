import { Tag } from "./Tag.js";

class Input extends Tag {
    constructor(className,type){
        super(className);
        this.type = type
        // this.value = value
        
    }
    addText(value){
       this.type ==='button'?  this.value =value: this.innerText = value;
      return this;
    }
    addPlaceholder(placeholder){
      this.placeholder = placeholder;
      return this;
    }
    addName(name){
      this.name = name;
      return this;
    }
    static changeElemColor(elem){ 
      elem.classList.remove('btn-outline-dark')
      elem.classList.add('btn-dark')
  }
    // createAddButtons(obj){
    //     let input = this.createElems('input');
    //     let inputFromDatasets = this.addDatasets(input,obj);
    //     return inputFromDatasets;
    // }
}

export { Input }