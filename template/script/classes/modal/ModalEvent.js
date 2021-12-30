import { BaseMethods } from "../BaseMethods.js";

class ModalEvent extends BaseMethods{
    constructor(){
        super();
    }
    selector = `modal`;
    closeModalWindow(evt) {
        let target = evt.target;
        let classList = target.classList;
        if(classList.contains('close')){
            new ModalWindow().removeModalWindow()
        }
    }

}

export {ModalEvent}