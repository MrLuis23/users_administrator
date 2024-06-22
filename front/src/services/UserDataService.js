import http from "../utils/http-common";
import setAuthHeaders from "../utils/setAuthHeaders";
import AuthService from "./AuthService";

class UserDataService {
  getAll() {
    setAuthHeaders(AuthService.getToken());
    return http.get("/users");
  }

  get(id) {
    return http.get(`/user/${id}`);
  }

  create(data) {
    return http.post("/user/new", data);
  }

  update(id, data) {
    return http.put(`/user/${id}`, data);
  }

  delete(id) {
    return http.delete(`/user/${id}`);
  }


}

export default new UserDataService();
