export default class Auth {
    userNotAllowed(error){
        if(!error){
            return;
        }
        if(!error.response){
            return;
        }
        if(!error.response.data){
            return;
        }
        if(error.response.data.message == "Unauthenticated."){
            localStorage.removeItem("token");
            window.location.replace("/login");
        }
    }
}