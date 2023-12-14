const urlRestaurant = './php/restaurants/restaurant.controller.php';
const urlGenerateReservation = './php/restaurants/generateReservation.controller.php';

    
const reservation_btn = document.querySelector('#btn_reservar');

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
    setReservacion(data);
    
}

const setReservacion = async(dataId) => {
    try{

        const data = await fetch(urlGenerateReservation, {
            method: 'POST',
            body: dataId
        });

        const resp = await data.json();
        console.log(resp);
        
    }catch(error){
        console.log(error)
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


export {reservar, mainRestaurant}
