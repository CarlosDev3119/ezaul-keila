import { alerts } from "../utils/alerts.adapter.js";

const urlRestaurant = './php/restaurants/restaurant.controller.php';
const urlGenerateReservation = './php/restaurants/generateReservation.controller.php';

const mainRestaurant = async () => {
    const data = await setDataTableRestaurant();
    let restaurantTable = $('#dataTable').DataTable();

    restaurantTable.clear().draw();
    
    
    data.forEach( values => {
        let tableRows = ''
        tableRows += `
            <tr>
                <td>ID:${values.id_restaurant}</td>
                <td>${values.name_restaurant}</td>
                <td>${values.address}</td>
                <td>${values.city_restaurant}</td>
                <td>${values.phone_number}</td>
                <td>${values.name_user}</td>
                <td>${values.actions}</td>
            </tr>
        `
        restaurantTable.rows.add($(tableRows)).draw();
    })

}

const reservar = (idRestaurant) => {
    const data = new FormData();
    data.append('idRestaurant', idRestaurant);
    const isValid = setReservacion(data);
    if(isValid){
        return alerts.confirm('Reservacion exitosa', 'Se ha guardado tu reservación', 'success').then((result) => {
            if(result){
                window.location.href = "./reservaciones.php"
            }
        });
    }

    alerts.confirm('Error', 'Ocurrió un error al realizar tu reservación', 'error')
    
}

const eliminar = async (idRestaurant) => {
    const data = await deleteRestaurant(idRestaurant);

    if(data){
        return alerts.confirm('Eliminación realiza', 'Restaurante eliminado', 'success').then((result) => {
            if(result){
                window.location.href = "./home.php"
            }
        });
    }

    alerts.confirm('Error', 'Ocurrió un error al eliminar el restaurante', 'error')
}


const setReservacion = async(dataId) => {
    try{

        const data = await fetch(urlGenerateReservation, {
            method: 'POST',
            body: dataId
        });

        const resp = await data.json();
        return resp;
        
    }catch(error){
        console.log(error)
    }
}

const generateReservacion = async () => {
    const data = await getReservation();
    let reservationTable = $('#dataTable_Reservation').DataTable();
    
    reservationTable.clear().draw();

    data.forEach( values => {
        let tableRows = ''
        tableRows += `
            <tr>
                <td>ID:${values.id_estancia}</td>
                <td>${values.name_user}</td>
                <td>${values.name_restaurant}</td>
                <td>${values.address_restaurant}</td>
                <td>${values.phone_number_restaurant}</td>
            </tr>
        `
    reservationTable.rows.add($(tableRows)).draw();
        
    })

}

const deleteRestaurant = async (id_restaurant) => {
    try{
        const resp = await fetch(urlRestaurant, {
            method: 'DELETE',
            body: JSON.stringify({id_restaurant})
        });
        const data = await resp.json();
        return data;

    }catch(error){
        throw new Error(error);
    }
}

const getReservation = async () => {
    try{
        const resp = await fetch(urlGenerateReservation);
        const data = await resp.json();
        return data;
    }catch(error){
        throw new Error(error);
    }
}

const setDataTableRestaurant = async () => {

    try{

        const resp = await fetch(urlRestaurant);
        const data = await resp.json();
        return data;

    }catch(error){
        throw new Error(error);

    }

}


export {reservar, mainRestaurant, generateReservacion, eliminar}
