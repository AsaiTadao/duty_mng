import VueRouter from "vue-router";
import routes from "./routes";
import store from '../store';
import { showError } from "../helpers/error";

const router = new VueRouter({
    mode: 'history',
    routes,
    base: '/child',
    scrollBehavior: to => {
        if (to.hash) {
            return {selector: to.hash}
        } else {
            return {x: 0, y: 0}
        }
    },
});

// router.beforeEach((to, from, next) => {
//     console.log("xxx");
//     if (to.meta.guards) {
//         console.log("yyy");
//         if (!store.state.session || !store.state.session.info) {
//             return next();
//         }
//         const roleId = store.state.session.info.roleId;
//         console.log({roleId}, to.meta.guards)
//         if (to.meta.guards.includes(roleId))
//             return next();
//         showError("You are not allowed");
//         router.push({name: 'stamp'});
//         return;
//     }

//     return next();
// });
export default router;
