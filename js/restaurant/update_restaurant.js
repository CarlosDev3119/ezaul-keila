import { alerts } from "../utils/alerts.adapter.js";

const updateController = '../php/restaurants/update.controller.php';

const update_name_restaurant = document.querySelector('#update_name_restaurant');
const update_street_restaurant = document.querySelector('#update_street_restaurant');
const update_city_restaurant = document.querySelector('#update_city_restaurant');
const update_phone_restaurant = document.querySelector('#update_phone_restaurant');
const update_owner_restaurant = document.querySelector('#update_owner_restaurant');
const updateSelectDni = document.querySelector('#updateSelectDni');
const btnUpdate = document.querySelector('#btnUpdate');

export const mainUpdateRestaurant = async () => {
    const location = window.location.search;
    const idRestaurant = new URLSearchParams(location).get('id_restaurant');

    const dataRestaurants = await getDataRestaurant(idRestaurant);
    const dataOwners = await getOwnerRestaurant();
    generateSelect(dataOwners);
    const dni_user = fillInputs(dataRestaurants);

   
    btnUpdate.addEventListener('click', async () => {
        const dataUpdate = startUpdateRestaurant(dni_user);
        const resp = await updateRestaurant(dataUpdate);
        
        if(resp){
            return alerts.confirm('Actualizado correctamente', 'restaurante actualizado', 'success').then((result) => {
                if(result){
                    window.location.href = "../home.php"
                }
            });
        }

        alerts.confirm('Error', 'Ocurrio un error al actualizar', 'error')
    })


}

const fillInputs = (restaurant = []) => {
    const {
        name_restaurant,
        address,
        city_restaurant,
        phone_number,
        name_user,
        dni_user,
    } = restaurant[0];

    update_name_restaurant.value = name_restaurant;
    update_street_restaurant.value = address;
    update_city_restaurant.value = city_restaurant
    update_phone_restaurant.value = phone_number
    update_owner_restaurant.value = name_user

    return dni_user;
}

const generateSelect = (owners = []) => {

    let options = '<option value="default" selected>Selecciona el dueño</option>';
    owners.forEach( ({dni_user, name_user})=> {
        options += `<option value="${dni_user}">${name_user}</option>`
    
    })
    updateSelectDni.innerHTML = options;
       
}

const startUpdateRestaurant = (dni_actual_user) => {
    const location = window.location.search;
    const idRestaurant = new URLSearchParams(location).get('id_restaurant');

    const phone_number_restaurant= update_phone_restaurant.value;
    const dni_user = updateSelectDni.value;

    const dataUpdate = {
        phone_number_restaurant: phone_number_restaurant,
        id_restaurant: idRestaurant
    }
    if(dni_user === 'default'){
        dataUpdate.dni_user = dni_actual_user
    }else{
        dataUpdate.dni_user = dni_user;
    }

    return dataUpdate;
}



const updateRestaurant = async (dataUpdate = {}) => {
    try{

        const resp = await fetch(updateController, {
            method: 'PUT',
            body: JSON.stringify(dataUpdate)
        })

        const data = await resp.json();
        return data;

    }catch(error){
        console.log(error);
    }
}

const getDataRestaurant = async (idRestaurant) => {
    try{
        const response = await fetch(`${updateController}?id_restaurant=${idRestaurant}&type=datarestaurant`);
        const dataRestaurant = await response.json();
        return dataRestaurant;

    }catch(error){
        console.log(error);
    }    
}

const getOwnerRestaurant = async () => {
    try{
        const response = await fetch(`${updateController}?type=dataowners`)
        const dataOwner = await response.json();
        return dataOwner
    }catch(error){
        console.log
    }
}






