import http from "../utils/http-common";
import setAuthHeaders from "../utils/setAuthHeaders";

class AuthService {

  login(data) {
    setAuthHeaders(this.getToken());
    return http.post("/login", data);
  }

  logout(data) {
    setAuthHeaders(this.getToken());
    return http.post("/logout", data);
  }

  isAuthenticated = () => {
    return localStorage.getItem('jwt');
  }

  getToken = () => {
    return localStorage.getItem('jwt');
  }

}

export default new AuthService();
