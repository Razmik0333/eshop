async function load(url, data) {
	let say = await import('./getResult.js');
	return say.getResult(url,data);
}
window.addEventListener("load", loadPage,false);

function loadPage()
{
    let modal = document.querySelector('.modal');
    let cityes = ['Yerevan', 'Gyumri', 'Hrazdan', 'Armavir', 'Sevan', 'Aparan','Meghri'];

    //------------------------------
    let loginBar = document.querySelector('.login-bar'); 

    load(`/guest`).then(res => {
        checkUser(res)
        return res;
        
    }).then((res) =>{
       if (!res) {
        let register = document.querySelector('.register');
        let login = document.querySelector('.login');
        register.addEventListener('click', function (e) {
            e.preventDefault();
            document.body.style.overflow = 'hidden';
            modal.classList.add('modal-item');
            modal.innerHTML = `
            <form class="text-dark form container"   method="POST" action="#">
                <div class="form-col" >
                    <div class="form-group col-sm-6">
                        <input type="text" class="form-control name" id="inputName4" placeholder="Enter Your Name" name="name" value="">
                        <label for="inputName4">First name</label>
                    </div>
                    <div class="form-group col-sm-6">
                        <input type="text" class="form-control login" id="inputLog4" placeholder="Enter Login" name="login" value="">
                        <label for="inputLog4">Login</label>
                    </div>
                    <div class="form-group col-sm-6">
                        <input type="email" class="form-control" id="inputEmail4" placeholder="Email" name="email" value="">
                        <label for="inputEmail4">Email</label>
                    </div>
                    <div class="form-group col-sm-6">
                        <input type="password" class="form-control password" id="inputPassword4" placeholder="Password" name="password" value="">
                        <label for="inputPassword4">Password</label>
                    </div>
                </div>
                <div class="form-group position-relative ">
                    <div class="form-check form-gender">
                        <p class="form-check-label">Select Your Gender</p>
                        <input type="radio" id="male" name="gender" value="male" >
                        <label for="male" style="margin-left:5px">Male</label>
                        <input type="radio" id="female" name="gender" value="female">
                        <label for="female" style="margin-left:5px">Female</label>
                    </div>
                </div>
                <input type="submit" class="btn btn-primary position-relative sign" value="Sign in" name="submit"  style="left:15px">
            </form> `;
            let form = document.querySelector('.form')
            form.addEventListener('change', checkDataForRegister,false);
        
            form.addEventListener('submit', function (e) {
                e.preventDefault();
                let formData = new FormData(form);
                let id;
                load('/register', formData)
                .then((res) =>{
                    id = res;
                    
                    if(res){
                        modal.innerHTML = getModalWindow('Դուք հաջողությամբ գրանցվել եք', false) 
                    }else{
                        modal.innerHTML = getModalWindow('Ներեցեք առկա են տեխնիկական խնդիրներ։Փորձեք մի փոքր ուշ', false)
                    }
                    
                })
                .then(() => {
                    let close = document.querySelector('.close');
                    close.addEventListener('click',function (e) {
                        e.preventDefault();
                        modal.classList.remove('modal-item')
                        
                    });
                })
            })
        })
        login.addEventListener('click', function (e) {
            e.preventDefault();
            document.body.style.overflow = 'hidden';
            modal.classList.add('modal-item');
            modal.innerHTML = `<form class="form text-dark"  method="POST" action="#">
            <div class="form-group col-sm-6">
                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email" name="email" value="">
                <label for="exampleInputEmail1">Email</label>
            </div>
            <div class="form-group col-sm-6">
                <input type="password" class="form-control" id="inputPassword4" placeholder="Password" name="password" value="">
                <label for="inputPassword4">Password</label>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div>
            <button type="submit" name="submit" class="btn btn-primary position-relative" style="left:15px">Sign Up</button>
        </form>`;
            let form = document.querySelector('.form')
            form.addEventListener('change', checkDataForLogin,false);
            form.addEventListener('submit', function (e) {
                e.preventDefault();
                let formData = new FormData(form);
                load('/login', formData)
                .then((res) =>{
                    console.log(res);
                    id = res;
                    if(res === 0){
                        modal.innerHTML = getModalWindow('Ներեցեք առկա են տեխնիկական խնդիրներ։Փորձեք մի փոքր ուշ', false)
                    }else{
                        modal.innerHTML = getModalWindow('Դուք հաջողությամբ մուտք եք գործել համակարգ', false) 
                    }
                    
                }).then(() => {
                    let close = document.querySelector('.close');
                    close.addEventListener('click', function (e) {
                        document.body.style.overflow = '';
                        modal.classList.remove('modal-item');

                        modal.innerHTML = 'visible';
                    })
                }).then(() => {
                    let guest = load('/guest');
                    
                    guest.then(res => {
                        
                        checkUser(res)
                    })
                })
            })
        })
       }
    }
        
    )

    function checkDataForRegister(e) {
        let target = e.target;
        let value = target.value;
        if (target.tagName !== 'INPUT' && target.tagName !== 'SELECT') return; 
        if(target.classList.contains('name')){
            if (!checkNameLength(value)) {
                changeColor(target, false, `Անունը պետք է ունենա 2-ից ավելի սիմվոլ`)

            }else{
                changeColor(target, true, `Անունը ճիշտ է`);
            }
        }
        if(target.classList.contains('login')){
            let login = load(`/register/log/${target.value}`)

            if (!checkNameLength(value)) {
                changeColor(target, false, `Մուտքանունը պետք է ունենա 2-ից ավելի սիմվոլ`)

            }else{
                login.then(res => {
                    if (res === true) {
                        changeColor(target, false,'Մուտքագրված մուտքանունը արդեն գրանցված է');

                    }else{
                        changeColor(target, true,'Մուտքանունը ճիշտ է');
                    }
                })
            }
        }
        if (target.type === 'email') {
            let email = load(`/register/check/${target.value}`)
            if (!checkEmail(target.value)) {
                changeColor(target, false,'Մուտքագրված e-mail-ը բացակայում է @ սիմվոլը');
            }                
            else{
                email.then(res => {
                    if (res === true) {
                        changeColor(target, false,'Մուտքագրված e-mail-ը արդեն գրանցված է');

                    }else{
                        changeColor(target, true,'Մուտքանունը ճիշտ է');
                    }
                })
            }
        }
        if (target.type === 'password') {

            let password = document.querySelector('.password')
            let confirm = document.querySelector('.confirm')
            let pass = password.value;
            let conf = confirm.value;
            
            if (!checkPasswordLength(value)) {
                changeColor(target, false, `Գաղտնաբառը պետք է ունենա 6-ից ավելի սիմվոլ`)

            }else if (!checkLargeLetter(value)) {
                changeColor(target, false, `Գաղտնաբառը պետք է ունենա գոնե 1 մեծատառ սիմվոլ`)
                
            }else if (pass.length !== 0 && conf.length !== 0 ) {
                if (pass === conf) {
                    changeColor(password, true, `Գաղտնաբառը ճիշտ է`)
                    changeColor(confirm, true, `Գաղտնաբառը ճիշտ է`)                         
                    
                }
                else{
                    changeColor(target, false, `Գաղտնաբառերը չեն համընկնում`);
                }
            }
            else{
                changeColor(target, true, `Գաղտնաբառը ճիշտ է`)
            }
        }    

        if(target.classList.contains('city')){
            if(!checkElemAvailable(value,cityes)){
                changeColor(target, false,'Տվյալ քաղաքում առաքում չկա');
            }else{
                changeColor(target, true,'Տվյալ քաղաքում առաքում կա');
            }
            
        }

        if (target.classList.contains('zip')) {
            if (!checkZipLength(value)) {
                changeColor(target, false, `Zip կոդը պետք է ունենա 4 սիմվոլ`)
            }else{
                changeColor(target, true,'Zip կոդը ճիշտ է');
            }
        }
    }
    function checkDataForLogin(e) {
        let target = e.target;
        let value = target.value;
        if (target.tagName !== 'INPUT') return;
        if (target.type === 'email') {
            if (!checkEmail(target.value)) {
                changeColor(target, false,'Մուտքագրված e-mail-ը բացակայում է @ սիմվոլը');
            }                
            else{
                load(`/register/check/${target.value}`)
                .then(res => {
                    if (res === true) {
                        changeColor(target, true,'Մուտքանունը մուտքանունը առկա է');
                    }else{
                        changeColor(target, false,'Մուտքագրված e-mail-ը գրանցված չէ');
                    }
                })
            }
        }
        if (target.type === 'password') {           
            
            if (!checkPasswordLength(value)) {
                changeColor(target, false, `Գաղտնաբառը պետք է ունենա 6-ից ավելի սիմվոլ`)

            }else if (!checkLargeLetter(value)) {
                changeColor(target, false, `Գաղտնաբառը պետք է ունենա գոնե 1 մեծատառ սիմվոլ`)
                
            }else if (value.length !== 0) {             
                changeColor(target, true, `Գաղտնաբառը ճիշտ է`)                    
            }            
        } 
    }

    function checkEmail(str) {
        return str.trim().search('@') !== -1 ? true : false;
    }
    function checkPasswordLength(str) {            
        return str.trim().length >= 6  ? true  : false;
    }

    function checkZipLength(str) {            
        return str.trim().length === 4  ? true  : false;
    }
    function checkLargeLetter(elem) {
        let arr = elem.split('')
        .filter(item => item.codePointAt(0) >= 65 && item.codePointAt(0) <= 90);
        return arr.length > 0 ? true : false;          
    }

    function checkElemAvailable(city, arr) {
        let currentCity
        if (city === undefined)  {
            return false;
        }else{
            currentCity =  arr.filter((item) => item === city)
            return currentCity.length !== 0 ? true : false;
        }
    }   

    
    function checkUser(res) {
        console.log(res);
        if (!res) {

            console.log(res);
            loginBar.innerHTML = 
            `
             <li class="nav-item">
                 <a class="nav-link text-white login" href="/user/login">ՄՈՒՏՔ</a>
             </li>
             <li class="nav-item" >
                 <a class="nav-link text-white register" id="register" href="/user/register">ԳՐԱՆՑՈՒՄ</a>
             </li>
            `
         }else{
             console.log(res);
             loginBar.innerHTML = 
            `
            <li class="nav-item dropdown bg-dark">
                <a class="nav-link dropdown-toggle text-white" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">ԲԱՐև ${res['name']}</a>
                <div class="dropdown-menu bg-dark menu-items">
                    <a class="dropdown-item text-white" href="/cabinet">ԻՄ ԷՋԸ</a>
                    <a class="dropdown-item text-white" href="/order/package">ԻՄ ՊԱՏՎԵՐՆԵՐԸ</a>
                    <a class="dropdown-item text-white" href="/user/logout">ԵԼՔ</a>
                    <a class="dropdown-item text-white" href="#">GBP</a>
                    <a class="dropdown-item text-white" href="#">Other</a>
                </div>
			</li>

            ` 
         }
    }
}
function changeColor(item,condition,comment) {
    if(condition){
        item.style.outline = 'solid  rgb(22, 250, 98) 3px';
        item.nextElementSibling.style.color = 'green';
        item.nextElementSibling.innerHTML = comment;
        return true
    }else{
        item.style.outline = 'solid   rgb(250, 22, 22) 3px';
        item.nextElementSibling.style.color = 'red';
        item.nextElementSibling.innerHTML = comment;
        return false
    }
}

function checkNameLength(str) {            
    return str.trim().length > 2  ? true  : false;
}
function checkPhoneLength(str) {            
    return str.trim().length !== 0  ? true  : false;
}
function checkPhone(str) { 
    let arr = str
    .split('')
    .filter(item => +item.codePointAt(0) < 48 || +item.codePointAt(0) > 57)
    
    
    return arr.length === 0  ? true  : false;
}