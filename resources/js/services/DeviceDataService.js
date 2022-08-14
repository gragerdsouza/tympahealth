import http from "../http-common";
class DeviceDataService {
  getAll() {
    return http.get("/devices");
  }
  get(id) {
    return http.get(`/devices/${id}`);
  }
  create(data) {
    return http.post("/devices", data);
  }
  update(id, data) {
    return http.put(`/devices/${id}`, data);
  }
  delete(id) {
    return http.delete(`/devices/${id}`);
  }
  search(keyword) {
    return http.get(`/devices?query=${keyword}`);
  }
}
export default new DeviceDataService();