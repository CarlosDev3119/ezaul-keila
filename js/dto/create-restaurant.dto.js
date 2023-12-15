export const createRestaurantDto = (object) => {

    const { name, street, city, phone, dni } = object;

    if(!name) return ['The name is required'];
    if(!street) return ['The street is required'];
    if(!city) return ['The city is required'];
    if(!phone) return ['The phone is required'];

    const createRestaurant_Dto = {
        name, 
        street, 
        city,
        phone,
        dni
    }

    return [undefined, createRestaurant_Dto]
}