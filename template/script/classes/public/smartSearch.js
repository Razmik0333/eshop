import { CategoryBar } from "../CategoryBar.js";
import { SmartSearch } from "../SmartSearch.js"

let url = '/goods/search/';
let s = new SmartSearch(url);


s.listenEvent('change', (e) => {
    e.preventDefault();
    
    let target = e.target; 
    s.url = target.value.length > 0 ? url + target.value : ''
    s.renderCard().then(res => {
        let searchItemMenu = s.getSelector()
        let b = s.getSearchItems(res);
        searchItemMenu.classList.add('show'); 
    
        if(searchItemMenu.innerHTML !== ''){
            searchItemMenu.innerHTML = ''
        }
        if (searchItemMenu.innerHTML == '') {
            searchItemMenu.append(b)
        }

        
    })
},'menu');