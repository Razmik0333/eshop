import { Input } from "../Input.js";
import { Tag } from "../Tag.js";

class ModalWindow {
    constructor(){

    }
    getTemplateWithSurvey() {
        
        let inputYes = new Input('btn btn-primary confirm','button','ԱՅՈ').createElems('input')
        let inputNo = new Input('btn btn-secondary reject','button','ՈՉ').createElems('input');
        inputNo = Tag.addDatasets(inputNo,{
          'dismiss' : 'modal'
        })        
        return new Tag('modal-footer').insertContentsOfBlock('div', [inputNo,inputYes]);
    }
    getModalBody(str){
      let paragraph = new TagWithTextContent('',str).createElems('p');
      return new Tag('modal-body').insertContentsOfBlock('div',[paragraph])
       

    }
    getModalHeader(){
      let title = new TagWithTextContent('modal-title','Ծանուցում').createElems('h5');
      let input = new Input('close','submit'/*×*/).addText('×').createElems('input');
      let header = new Tag('modal-header').insertContentsOfBlock('div',[title,input]);
      return header;
    }
    createModalContent(str,survey){
      let arrNotSurvey = [this.getModalHeader(),this.getModalBody(str)];
      let arrFromSurvey = [this.getModalHeader(),this.getModalBody(str),this.getTemplateWithSurvey()];
      let content = new Tag('modal-content');
      let modalContent = survey === true ?
      content.insertContentsOfBlock('div',arrFromSurvey) :
      content.insertContentsOfBlock('div',arrNotSurvey);

      return modalContent;
      
    }
    createModalWindow(str,bool){
      return new Tag().insertContentOfBlocks({
        'div': "modal-dialog",
        'div': "modal-wind",
      }, this.createModalContent(str,bool));
    }
    insertModalWindow(str){
      let modal = document.querySelector('.modal');
      modal.classList.add('modal-item')
      modal.append(this.createModalWindow(str,false));
    }
    removeModalWindow(){
      let modal = document.querySelector('.modal');
      modal.classList.remove('modal-item');
      modal.innerText = '';

    }
}


export {ModalWindow}
