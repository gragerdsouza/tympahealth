import apiInteraction from "../base";
class DeviceDataService {
  getAllDevice() {
    return apiInteraction.get("/devices");
  }
  getDevice(id) {
    return apiInteraction.get(`/devices/${id}`);
  }
  createDevice(data) {
    return apiInteraction.post("/devices", data);
  }
  updateDevice(id, data) {
    return apiInteraction.put(`/devices/${id}`, data);
  }
  deleteDevice(id) {
    return apiInteraction.delete(`/devices/${id}`);
  }
  searchDevice(keyword) {
    return apiInteraction.get(`/devices?query=${keyword}`);
  }
}
export default new DeviceDataService();