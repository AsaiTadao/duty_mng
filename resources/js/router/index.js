import VueRouter from "vue-router";
import routes from "./routes";
const router = new VueRouter({
    mode: 'history',
    routes,
    scrollBehavior: to => {
        if (to.hash) {
            return {selector: to.hash}
        } else {
            return {x: 0, y: 0}
        }
    },
});

router.beforeEach((to, from, next) => {
    if (to.name === from.name) return next();
    console.log({to});
    return next();
})
export default router;
