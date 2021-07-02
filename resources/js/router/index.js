import Vue from "vue";
import VueRouter from "vue-router";
import login from "../components/Login.vue";
import register from "../components/register.vue";
Vue.use(VueRouter);

const routes = [
     { name: "login", path: "/", component: login },
      { name: "register", path: "/register2", component: register },

];
const router = new VueRouter({
    routes, // short for `routes: routes`
    mode: "history"
});
export default router;