import axios from "axios";

const HttpService = axios.create({
  baseURL: "http://localhost:8001/",
  headers: {
    "Content-type": "application/json",
  },
});

export default HttpService;
