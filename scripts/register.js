let form = document.getElementById('register_form');
let valid=false;
form.addEventListener('submit',(e)=>{
    // e.preventDefault();
    let name = e.target.name.value;
    let email = e.target.email.value;
    let password = e.target.password.value;
    let repassword = e.target.repassword.value;
    if(password!==repassword){
        e.preventDefault();
        alert('Password doesn`t match!');
    }
})