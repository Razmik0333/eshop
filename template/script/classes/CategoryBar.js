import { BaseMethods } from "./BaseMethods.js";
import { Input } from './Input.js';
import { Tag } from "./Tag.js";
import { TagWithTextContent } from "./TagWithTextContent.js";
import { Form } from "./Form.js";
import {Links} from "./Links.js";

class CategoryBar extends BaseMethods{
    constructor(url){
        super(url);
    }
    selector = 'menu';
    searchItemMenu = document.querySelector('.search-items')
    createSearchForm(){
        let textFields = this.createTextFiellds() ;
        let searchButton =this.searchButton()
        let burgerMenuIcon = this.createBurgerMenuIcon();
        let formSearch = new Form('search','/search/goods','get')
        .insertContentsOfBlock('form',[textFields,searchButton,burgerMenuIcon]);
        return formSearch;
    }
    createSearchBar(){
        let formSearch = this.createSearchForm();
        let searchItems = new Tag('container position-absolute search-items').createElems('div');
        let searchBar = new Tag('input-group search-zone test')
        .insertContentsOfBlock('div',[formSearch,searchItems]);
        return searchBar;
        
    }

    createCategories(obj){
        let ul = new Tag('navbar-nav mr-auto mt-2 mt-lg-0 category-items').createElems('ul');
        for (const cat in obj) {
            if (Object.hasOwnProperty.call(obj, cat)) {
                const elem = obj[cat];
                let catLink = new Links('nav-link cat-filter',`/category/filter/${elem['alias']}`,`${elem['arm_name']}`).createElems('a');
                let li = new TagWithTextContent('',``).createElems('li');
                let link = Tag.addDatasets(catLink, {
                    'alias' : `${elem['alias']}`
                })
                li.append(link);
                ul.insertAdjacentElement('beforeEnd',li)
            }
        }
        return ul
    }


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
    createCategoryListItem(obj){
        let arrLi = [];
        let ind = 0;
        for (const key in this.listGroups) {
            if (Object.hasOwnProperty.call(this.listGroups, key)) {
                const element = this.listGroups[key];
                let li = new TagWithTextContent('nav-item','').createElems('li');
                let link = new Links('',`/${element}/${key}`,'').createElems('a');
                let span = new TagWithTextContent(`badge badge-light ${element}-count`, `${obj[ind]}`).createElems('span')
                let button = new Tag('').insertContentOfBlocks({
                    'button' : `btn btn-warning ${element}-btn`
                },span);
                link.append(button);
                li.append(link);
                arrLi.push(li);                
            }
            ind++
        }
        return arrLi
    }
    createTextFiellds(){
        return new Input('form-control-sm sm-2 search-field','text')
        .addPlaceholder('Search products...').addName('search-field')
        .createElems('input');
    }
    searchButton(){
        return new Input('btn btn-success my-2 my-sm-0','submit')
        .addName('search')
        .createElems('input');
        
    }
    createBurgerMenuIcon(){
        let burgerMenuIcon = new Input('navbar-toggler','button')
        .createElems('button');
        Tag.addDatasets(burgerMenuIcon,{
            'toggle':'collapse',
            'target': '#navbarSupportedContent-1'

        })
        let span = new Tag('navbar-toggler-icon').createElems('span');
        burgerMenuIcon.append(span);
        return burgerMenuIcon
    }
    createCard(catArray,listCountArray){
        let searchZone = this.createSearchBar();
        let categoryList = this.createCategories(catArray);
        let listArray = this.createCategoryListItem(listCountArray);
        listArray.forEach(item =>{
            categoryList.insertAdjacentElement('beforeEnd',item)
        })
        let categoryBar = new Tag('navbar navbar-expand-lg navbar-light bg-warning pt-5')
        .insertContentsOfBlock('nav',[searchZone,categoryList]);
        return categoryBar;
        
    }
}
export {CategoryBar};
