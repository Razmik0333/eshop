import { BaseMethods } from "./BaseMethods.js";
import { Links } from "./Links.js";
import { Tag } from "./Tag.js";
import { TagWithTextContent } from "./TagWithTextContent.js";

class SmartSearch extends BaseMethods{
    constructor(url){
        super(url);
     }
    selector = 'search-items';
    menuRoot = document.querySelector('.menu');

    createSmartSearch(obj){
        let ul = new Tag('list-group').createElems('ul');
        for (const key in obj) {
           // console.log(key);
            if (Object.hasOwnProperty.call(obj, key)) {
                const elem = obj[key];
                let li = new TagWithTextContent('list-group-item',``).createElems('li');
                let link = new Links('',`/product/view/${elem['alias']}`,`${elem['arm_name']}`).createElems('a');
               
                li.append(link);
                ul.insertAdjacentElement('beforeEnd',li)
            }
        }
       return ul;
       
    }
    getSearchItems(arr) {
        let ul = new Tag('list-group').createElems('ul');

        arr.forEach(item => {
            let link = new Links('',`/product/view/${item['id']}`,`${item['descr']}`).createElems('a');
            let li = new Tag('list-group-item').createElems('li');
            li.append(link);
            ul.append(li);
        })
        return ul;
    }
}

export {SmartSearch}