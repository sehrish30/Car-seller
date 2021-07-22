require("./bootstrap");

import { createApp } from "vue";
import router from "./routes";

import MainApp from "./components/App.vue";

const app = createApp(MainApp);
app.use(router);

app.mount("#app");
