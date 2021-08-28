import Vue from "vue";
import VueRouter from "vue-router";
import login from "../components/Login.vue";
import createsupplier from "../components/suppliers/create.vue";
import editsupplier from "../components/suppliers/edit.vue";
import supplier from "../components/suppliers/index.vue";
import createemployee from "../components/employee/create.vue";
import editemployee from "../components/employee/edit.vue";
import employee from "../components/employee/index.vue";
import register from "../components/register.vue";
import logout from "../components/logout.vue";
import home from "../components/Home.vue";
import guest from "../middlewares/guest";
import auth from "../middlewares/auth";
import store from "../store/index";

import checkAuth from "../middlewares/auth-check";
import middlewarePipeline from "../router/middlewarePipeline";
Vue.use(VueRouter);

const routes = [
     { name: "login", path: "/", component: login,
      meta: {
                middleware: [guest]
            } },
      { name: "register", path: "/register2", component: register ,
   meta: {
                middleware: [guest]
            },},
               { name: "home", path: "/home", component: home ,
   meta: {
                middleware: [auth, checkAuth]
            },},
               { name: "logout", path: "/logout", component: logout ,
   meta: {
                middleware: [auth, checkAuth]
            },
          },
               { name: "createemployee", path: "/createemployee", component: createemployee,
      meta: {
                middleware: [auth, checkAuth]
            } },
             { name: "employee", path: "/employees", component: employee,
      meta: {
                middleware: [auth, checkAuth]
            } },
              { name: "editemployee", path: "/editemployee/:id", component: editemployee,
      meta: {
                middleware: [auth, checkAuth]
            } },

             { name: "createsupplier", path: "/createsupplier", component: createsupplier,
      meta: {
                middleware: [auth, checkAuth]
            } },
             { name: "supplier", path: "/suppliers", component: supplier,
      meta: {
                middleware: [auth, checkAuth]
            } },
              { name: "editsupplier", path: "/editsupplier/:id", component: editsupplier,
      meta: {
                middleware: [auth, checkAuth]
            } },

];
const router = new VueRouter({
    routes, // short for `routes: routes`
    mode: "history"
});
router.beforeEach((to, from, next) => {
    if (!to.meta.middleware) return next();
    const middleware = to.meta.middleware;
    const context = {
        to,
        from,
        next,
        store
    };
    return middleware[0]({
        ...context,
        next: middlewarePipeline(context, middleware, 1)
    });
});
export default router;