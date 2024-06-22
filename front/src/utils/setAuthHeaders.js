import http from "../utils/http-common";

const setAuthHeaders= (token) => {
    if(token){
        http.defaults.headers = {
            Authorization: 'Bearer ' + token,
            "Content-type": "application/json",
            "Accept": "application/json"
        };
    }else{
        delete http.defaults.headers.Authorization;
    }
}

export default setAuthHeaders;