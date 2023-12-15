import {createRestaurantDto} from '../dto/create-restaurant.dto.js';
import { alerts } from '../utils/alerts.adapter.js';

const create_urlRestaurant = '../php/restaurants/restaurant.controller.php';

const getDniUsersUrl = '../php/restaurants/dni_users.controller.php';
 
(() => {

    //DOM = document object model
    const inputName_restaurant   = document.querySelector('#name_restaurant');
    const inputStreet_restaurant = document.querySelector('#street_restaurant');
    const inputCity_restaurant   = document.querySelector('#city_restaurant');
    const inputPhone_restaurant  = document.querySelector('#phone_restaurant');
    const selectDni              = document.querySelector('#selectDni');
    const btnCreate              = document.querySelector('#btnCreate');

    const main_create_restaurant = async () => {

        const dnis = await getDniUsers();
        let options = '<option selected>Open this select menu</option>';
        dnis.forEach(dni => {
            options += `<option value="${dni.dni_user}">${dni.name_user}</option>`
        });
        
        selectDni.innerHTML = options;


        btnCreate.addEventListener('click', async () =>{
            const response = validateCreate_Restaurant();

            if(!response.isValid) return alerts.confirm('Error', response.data, 'warning');

            const dataCreate_restaurant = new FormData();
            dataCreate_restaurant.append('name', response.data.name);
            dataCreate_restaurant.append('street', response.data.street);
            dataCreate_restaurant.append('city', response.data.city);
            dataCreate_restaurant.append('phone', response.data.phone);
            dataCreate_restaurant.append('dni_user', response.data.dni);
            const resp = await postDniUser(dataCreate_restaurant);

            if(resp){
                return alerts.confirm('Guardado correctamente', 'restaurante creado', 'success').then((result) => {
                    if(result){
                        window.location.href = "../home.php"
                    }
                });
            }

            alerts.confirm('Error', 'Ocurrio un error al guardar', 'error')

            
        });
    }

    //TODO CREAR UNA FUNCION ASYNC QUE HAGA LA PETICION A PHP
    const postDniUser = async (dataCreate_restaurant) => {

        try{
            const data = await fetch(create_urlRestaurant, {
                method: 'POST', 
                body: dataCreate_restaurant
                
            });

            const resp = await data.json();

            return resp

        }catch(error){
            console.log(error);
        }
       
           
        }        
        
    

    const getDniUsers = async () => {
        try{
            const data = await fetch(getDniUsersUrl);
            const dni = await data.json();
            return dni;

        }catch(error){
            console.log(error);

        }
    }



    const validateCreate_Restaurant = () => {
        const name     = inputName_restaurant.value;
        const street   = inputStreet_restaurant.value;
        const city     = inputCity_restaurant.value;
        const phone    = inputPhone_restaurant.value;
        const dni      = selectDni.value;

        const [error, createRestaurant_Dto ] = createRestaurantDto({name, street, city, phone, dni});
        
        if(error) return { 
            isValid: false,
            data: error
        };
        return {
            isValid: true,
            data: createRestaurant_Dto
        }
    } 

    main_create_restaurant();

})();