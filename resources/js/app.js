require("./bootstrap");

import { createApp } from "vue";
import router from "./routes";
import axios from "axios";

axios.defaults.withCredentials = true;
// all api calls to this url
axios.defaults.baseURL = "http://127.0.0.1:8000/";

import MainApp from "./components/App.vue";

const app = createApp(MainApp);
app.use(router);

app.mount("#app");
