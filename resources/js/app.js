require("./bootstrap");

import { createApp } from "vue";
import router from "./routes";
import axios from "axios";
// axios.defaults.withCredentials = true;
// all api calls to this url
// axios.defaults.baseURL = "http://127.0.0.1:8000/";

import MainApp from "./components/App.vue";

import { library } from "@fortawesome/fontawesome-svg-core";

import { faPen, faTrash } from "@fortawesome/free-solid-svg-icons";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";

library.add(faPen, faTrash);

const app = createApp(MainApp);
app.component("font-awesome-icon", FontAwesomeIcon);
app.use(router);
// app.use(function (req, res, next) {
//     res.header("Access-Control-Allow-Origin", "*");
//     res.header("Access-Control-Allow-Methods", "GET,HEAD,OPTIONS,POST,PUT");
//     res.header(
//         "Access-Control-Allow-Headers",
//         "Origin, X-Requested-With, Content-Type, Accept, Authorization"
//     );
//     next();
// });

app.mount("#app");
