const urlRestaurant = './php/restaurants/restaurant.controller.php';
// const restaurantTable = document.querySelector('#dataRestaurantTable');
(() => {
    
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
                    <td>${values.owner}</td>
                    <td>${values.actions}</td>
                </tr>
            `
            restaurantTable.rows.add($(tableRows)).draw();
        })
        
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

    mainRestaurant();
})();