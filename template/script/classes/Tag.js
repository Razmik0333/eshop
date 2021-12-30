export class Tag {
    constructor(className){
        this.className = className
    }
    createElems(tag){ 
        let elem = document.createElement(tag);
        for (let prop in this) {
            elem[prop] = this[prop]
        }                                     
        return elem;
    }
   
   static addDatasets(elem,obj){
        for (const key in obj) {
            if (Object.hasOwnProperty.call(obj, key)) {
                elem.dataset[key] = obj[key]; 
            }
        }
        //console.log(Array.from(obj));
        return elem;
    }
    insertContentOfBlocks(arrTag,content){
        let cont = content;
        let elem;
        for (const key in arrTag) {
            if (Object.hasOwnProperty.call(arrTag, key)) {
                elem = this.createElems(key);
                elem.className = arrTag[key];
                elem.appendChild(cont);
                cont = elem
            }
        }
        
        return cont;
    }
    insertContentsOfBlock(sel,arr){
        let tag = this.createElems(sel);
        //console.log(arr);
        
        arr.forEach(element => {
            //console.log(element);
            
            tag.insertAdjacentElement('beforeEnd',element)
        });
        return tag;
    }
    static checkFromTest(sel,content){

        let test = document.querySelector(sel);
        console.log("🚀 ~ file: Tag.js ~ line 49 ~ Tag ~ checkFromTest ~ test", test)
        
        test.append(content)
        
    }
    static correctNumberPages(elem){
        console.dir(elem);
        
        
    }
}




