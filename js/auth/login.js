import { LoginUserDto } from "../dto/login-user.dto.js";
import { alerts } from "../utils/alerts.adapter.js";

const urlLogin = './php/auth/auth.controller.php';

(() => {

    const inputEmail    = document.querySelector('#exampleInputEmail');
    const inputPassword = document.querySelector('#exampleInputPassword');
    const btnLogin      = document.querySelector('#btnLogin');

    const main = () => {
        
        btnLogin.addEventListener('click', () =>{
            const response = validateLoginForm()
            if(!response.isValid) return alerts.confirm('Error', response.data, 'warning');
            
            const dataLogin = new FormData();
            dataLogin.append('email', response.data.email);
            dataLogin.append('password', response.data.password);

            fetch(urlLogin, {
                method: 'POST',
                body: dataLogin
            })
            .then(resp => resp.json())
            .then(data => {

                if(data === 1){
                    return alerts.confirm('Success', 'Iniciando sesion', 'success')
                        .then((result) => {
                            if(result){
                                window.location.href="home.php";
                            }
                        });
                }
                return alerts.confirm('Error', 'Usuario o password incorrectos', 'error')

                    
            })

        })

    }

    const validateLoginForm = () => {
        const email = inputEmail.value;
        const password = inputPassword.value;

        const [error, loginUserDto] = LoginUserDto({email, password})

        if(error) return {
            isValid: false,
            data: error
        };

        return {
            isValid: true,
            data: loginUserDto
        };

    }



    main()

})()










