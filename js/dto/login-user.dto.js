import { regularExps } from "../utils/regex.email.js";

export const LoginUserDto = (object) => {

    const { email, password } = object;

    if(!email) return ['The email is required'];
    if(!regularExps.email.test(email)) return ['the email is invalid'];

    if(!password) return ['Password is requried'];
    if(password.length < 5) return ['Password must be at least 5 characters'];

    const loginUserDto = {
        email,
        password
    }

    return [undefined, loginUserDto]
}


